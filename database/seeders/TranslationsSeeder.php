<?php

namespace Database\Seeders;

use App\Models\TranslationCache;
use Illuminate\Database\Seeder;

/**
 * Loads the committed, offline translations (database/data/translations.php)
 * into the `translations` cache table — the same table the runtime tr() helper
 * reads. This makes seeded content multilingual with ZERO translation-API
 * calls, so it works in production/CI/offline.
 *
 * Idempotent & non-duplicating: keyed on (locale, source_hash) via
 * updateOrCreate, so re-running never creates duplicate rows. The committed
 * file is treated as the source of truth, so it refreshes any stale value.
 */
class TranslationsSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/translations.php');
        if (! is_file($path)) {
            return;
        }

        $data = require $path;
        $rows = 0;

        foreach ($data as $source => $byLocale) {
            $source = (string) $source;
            $hash   = sha1($source);

            foreach ($byLocale as $locale => $translated) {
                if (trim((string) $translated) === '') {
                    continue;
                }

                TranslationCache::updateOrCreate(
                    ['locale' => $locale, 'source_hash' => $hash],
                    ['source_text' => $source, 'translated_text' => $translated],
                );
                $rows++;
            }
        }

        $this->command?->info("TranslationsSeeder: {$rows} baked translations loaded (idempotent).");
    }
}
