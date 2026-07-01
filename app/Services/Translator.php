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
     * Return $text translated into $locale (defaults to the current app
     * locale). Returns the original text unchanged for the source locale,
     * empty/untranslatable input, or on any error.
     */
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

        try {
            $cached = TranslationCache::where('locale', $locale)
                ->where('source_hash', $hash)
                ->value('translated_text');

            if ($cached !== null) {
                return static::$memo[$memoKey] = $cached;
            }

            $translated = static::viaDriver($text, $locale);

            // Only persist a genuine, non-empty translation.
            if ($translated !== null && trim($translated) !== '' && $translated !== $text) {
                TranslationCache::updateOrCreate(
                    ['locale' => $locale, 'source_hash' => $hash],
                    ['source_text' => $text, 'translated_text' => $translated],
                );

                return static::$memo[$memoKey] = $translated;
            }
        } catch (Throwable $e) {
            Log::warning('Translation failed, using original text: ' . $e->getMessage());
        }

        // Graceful fallback — cache the miss in-request so we don't retry the API repeatedly on one page.
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

            $res = Http::timeout($timeout)->get($endpoint, $params);
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

        $res = Http::timeout($timeout)->asForm()->post($endpoint, $payload);

        return $res->ok() ? ($res->json('translatedText') ?: null) : null;
    }

    protected static function viaDeepl(string $text, string $target, int $timeout): ?string
    {
        $endpoint = config('translation.deepl.endpoint');
        $key      = config('translation.deepl.api_key');
        if (! $key) {
            return null;
        }

        $res = Http::timeout($timeout)
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
