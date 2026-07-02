<?php

namespace App\Services;

use App\Models\Concerns\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Entity-level orchestration on top of {@see Translator}.
 *
 * "Warming" a record means pre-populating the shared `translations` cache for
 * every one of its translatable strings, in every target locale. Because it
 * delegates to Translator::text() (which upserts on locale+source_hash), the
 * whole operation is idempotent: re-running never duplicates a translation and
 * strings already cached are skipped without hitting the translation API.
 *
 * This is the single integration point used by both the seeders and the
 * `translations:warm` command — no translation logic is duplicated anywhere.
 */
class TranslationWarmer
{
    /**
     * Warm every target locale for a single record.
     *
     * @return int Number of (string × locale) translations produced this call
     *             (0 when already fully cached).
     */
    public static function warm(Model $model, ?array $locales = null): int
    {
        if (! static::isTranslatable($model)) {
            return 0;
        }

        $locales = $locales ?: Translator::targetLocales();

        // Fast idempotency short-circuit: if the record's primary label is
        // already cached in every target locale, assume the record is warm.
        if (static::isWarmed($model, $locales)) {
            return 0;
        }

        $count = 0;
        foreach ($model->translatableStrings() as $string) {
            foreach ($locales as $locale) {
                if (Translator::isCached($string, $locale)) {
                    continue;
                }
                Translator::text($string, $locale);
                $count++;
            }
        }

        return $count;
    }

    /** Warm a collection/iterable of records. Returns total translations produced. */
    public static function warmMany(iterable $models, ?array $locales = null): int
    {
        $total = 0;
        foreach ($models as $model) {
            $total += static::warm($model, $locales);
        }

        return $total;
    }

    /** A record is "warmed" when its primary label exists in every target locale. */
    public static function isWarmed(Model $model, ?array $locales = null): bool
    {
        if (! static::isTranslatable($model)) {
            return true;
        }

        $primary = $model->primaryTranslatableString();
        if ($primary === null) {
            return true;
        }

        foreach ($locales ?: Translator::targetLocales() as $locale) {
            if (! Translator::isCached($primary, $locale)) {
                return false;
            }
        }

        return true;
    }

    protected static function isTranslatable(Model $model): bool
    {
        return in_array(Translatable::class, class_uses_recursive($model), true)
            && ! empty($model::$translatable ?? []);
    }
}
