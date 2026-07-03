<?php

namespace App\Services;

use App\Models\TranslationCache;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Translates dynamic (database) strings at render time and caches each
 * result in the `translations` table so the external API is called at most
 * once per unique string per locale.
 *
 * Design goals:
 *   - Never break a page: any failure (network, quota, missing table)
 *     falls back to returning the original text.
 *   - Cheap on repeat: DB cache + per-request in-memory memoisation.
 */
class Translator
{
    /** Per-request memo: "locale\0hash" => translated string. */
    protected static array $memo = [];

    /**
     * Per-request circuit breaker. As soon as the translation API fails once
     * (connection refused, timeout, quota…), we stop calling it for the rest
     * of the request so a single slow/unreachable API can never stack up
     * dozens of timeouts on one page — every later string returns instantly.
     */
    protected static bool $apiDown = false;

    /**
     * Per-request cache availability. Null = unknown, true = reachable,
     * false = the `translations` table could not be read (e.g. before the
     * migration has run). When false we serve source text and never touch
     * the DB or API again this request.
     */
    protected static ?bool $cacheUp = null;

    /**
     * Return $text translated into $locale (defaults to the current app
     * locale). Returns the original text unchanged for the source locale,
     * empty/untranslatable input, or on any error.
     */
    /**
     * Every supported locale except the source language — i.e. the locales a
     * piece of source text actually needs translating into.
     *
     * @return string[]
     */
    public static function targetLocales(): array
    {
        $source = config('translation.source_locale', 'en');

        return array_values(array_filter(
            array_keys(config('locales.supported', [])),
            fn ($locale) => $locale !== $source,
        ));
    }

    /**
     * Clear the per-request memo and circuit breaker. Call this between units
     * of work in a long-running process (e.g. a queue worker) so a transient
     * API blip on one job doesn't disable translation for the whole worker.
     */
    public static function reset(): void
    {
        static::$memo    = [];
        static::$apiDown = false;
        static::$cacheUp = null;
    }

    /** True if $text already has a cached translation for $locale. */
    public static function isCached(string $text, string $locale): bool
    {
        if (! static::shouldTranslate($text, $locale)) {
            return true; // nothing to translate == nothing missing
        }

        try {
            return TranslationCache::where('locale', $locale)
                ->where('source_hash', sha1($text))
                ->exists();
        } catch (Throwable $e) {
            return true; // cache unreachable — treat as "nothing to do"
        }
    }

    public static function text(?string $text, ?string $locale = null): string
    {
        $text   = (string) $text;
        $locale = $locale ?: App::getLocale();

        if (! static::shouldTranslate($text, $locale)) {
            return $text;
        }

        $hash    = sha1($text);
        $memoKey = $locale . "\0" . $hash;

        if (isset(static::$memo[$memoKey])) {
            return static::$memo[$memoKey];
        }

        // If the cache table was already found unreachable this request, or the
        // API already failed, skip straight to the original text — no DB, no HTTP.
        if (static::$cacheUp === false || static::$apiDown) {
            return static::$memo[$memoKey] = $text;
        }

        // 1) Try the persistent cache. A missing/unreadable table must degrade
        //    gracefully rather than 500 the page (e.g. before `migrate` runs).
        try {
            $cached = TranslationCache::where('locale', $locale)
                ->where('source_hash', $hash)
                ->value('translated_text');

            static::$cacheUp = true;

            if ($cached !== null) {
                return static::$memo[$memoKey] = $cached;
            }
        } catch (Throwable $e) {
            static::$cacheUp = false;
            Log::warning('Translation cache unavailable, serving source text: ' . $e->getMessage());

            return static::$memo[$memoKey] = $text;
        }

        // 2) Cache miss. Unless the live API is explicitly enabled, serve the
        //    source text — the site stays fully self-contained (no API threat).
        if (! config('translation.api_enabled', false)) {
            return static::$memo[$memoKey] = $text;
        }

        // Otherwise ask the engine, then persist a genuine translation.
        try {
            $translated = static::viaDriver($text, $locale);

            if ($translated !== null && trim($translated) !== '' && $translated !== $text) {
                TranslationCache::updateOrCreate(
                    ['locale' => $locale, 'source_hash' => $hash],
                    ['source_text' => $text, 'translated_text' => $translated],
                );

                return static::$memo[$memoKey] = $translated;
            }

            // Nothing usable came back — trip the breaker for this request.
            static::$apiDown = true;
        } catch (Throwable $e) {
            static::$apiDown = true;
            Log::warning('Translation API failed, using original text: ' . $e->getMessage());
        }

        return static::$memo[$memoKey] = $text;
    }

    protected static function shouldTranslate(string $text, string $locale): bool
    {
        if (! config('translation.enabled', true)) {
            return false;
        }
        if ($locale === config('translation.source_locale', 'en')) {
            return false;
        }
        if (trim($text) === '') {
            return false;
        }
        // Skip strings with no letters (numbers, prices, dates, icons…).
        return (bool) preg_match('/\p{L}/u', $text);
    }

    /** Dispatch to the configured translation engine. Returns null on failure. */
    protected static function viaDriver(string $text, string $locale): ?string
    {
        $target = config("translation.locale_map.$locale", $locale);
        $source = config('translation.source_locale', 'en');
        $timeout = (int) config('translation.timeout', 4);

        return match (config('translation.driver', 'mymemory')) {
            'deepl'          => static::viaDeepl($text, $target, $timeout),
            'libretranslate' => static::viaLibre($text, $source, $target, $timeout),
            default          => static::viaMyMemory($text, $source, $target, $timeout),
        };
    }

    /**
     * MyMemory free API. Anonymous requests are limited to ~500 chars each,
     * so long text is translated sentence-by-sentence and re-joined.
     */
    protected static function viaMyMemory(string $text, string $source, string $target, int $timeout): ?string
    {
        $endpoint = config('translation.mymemory.endpoint');
        $email    = config('translation.mymemory.email');

        $out = '';
        foreach (static::chunk($text, 480) as $part) {
            $params = ['q' => $part, 'langpair' => "$source|$target"];
            if ($email) {
                $params['de'] = $email;
            }

            $res = Http::connectTimeout(min($timeout, 3))->timeout($timeout)->get($endpoint, $params);
            if (! $res->ok()) {
                return null;
            }

            $data = $res->json();
            if (($data['responseStatus'] ?? null) != 200) {
                return null; // quota exceeded or invalid pair
            }

            $out .= html_entity_decode($data['responseData']['translatedText'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        return $out !== '' ? $out : null;
    }

    protected static function viaLibre(string $text, string $source, string $target, int $timeout): ?string
    {
        $endpoint = config('translation.libretranslate.endpoint');
        if (! $endpoint) {
            return null;
        }

        $payload = ['q' => $text, 'source' => $source, 'target' => $target, 'format' => 'text'];
        if ($key = config('translation.libretranslate.api_key')) {
            $payload['api_key'] = $key;
        }

        $res = Http::connectTimeout(min($timeout, 3))->timeout($timeout)->asForm()->post($endpoint, $payload);

        return $res->ok() ? ($res->json('translatedText') ?: null) : null;
    }

    protected static function viaDeepl(string $text, string $target, int $timeout): ?string
    {
        $endpoint = config('translation.deepl.endpoint');
        $key      = config('translation.deepl.api_key');
        if (! $key) {
            return null;
        }

        $res = Http::connectTimeout(min($timeout, 3))->timeout($timeout)
            ->withHeaders(['Authorization' => 'DeepL-Auth-Key ' . $key])
            ->asForm()
            ->post($endpoint, ['text' => $text, 'target_lang' => strtoupper(explode('-', $target)[0])]);

        return $res->ok() ? ($res->json('translations.0.text') ?: null) : null;
    }

    /**
     * Split text into <= $max-char pieces without cutting words. Breaks on
     * sentence boundaries first, then whitespace for very long sentences.
     */
    protected static function chunk(string $text, int $max): array
    {
        if (mb_strlen($text) <= $max) {
            return [$text];
        }

        $sentences = preg_split('/(?<=[.!?。！？])\s+/u', $text) ?: [$text];
        $chunks = [];
        $buffer = '';

        foreach ($sentences as $sentence) {
            while (mb_strlen($sentence) > $max) {
                $cut = mb_strrpos(mb_substr($sentence, 0, $max), ' ') ?: $max;
                $chunks[] = trim(mb_substr($sentence, 0, $cut));
                $sentence = trim(mb_substr($sentence, $cut));
            }

            if (mb_strlen($buffer) + mb_strlen($sentence) + 1 > $max) {
                if ($buffer !== '') {
                    $chunks[] = $buffer;
                }
                $buffer = $sentence;
            } else {
                $buffer = $buffer === '' ? $sentence : "$buffer $sentence";
            }
        }

        if ($buffer !== '') {
            $chunks[] = $buffer;
        }

        return $chunks;
    }
}
