<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Imports 15 tour packages that were written up but never published.
 *
 * Source: the client's Word tour documents, converted to
 * database/data/new_tours.json. Each record carries a summary, a day-by-day
 * itinerary in the shape the package pages already render, and the FAQs.
 *
 * PURELY ADDITIVE. Eleven of the twenty-six documents describe tours that are
 * already published; those were identified by hand against the live sitemap and
 * are not in the JSON at all. Nothing existing is edited, replaced or removed —
 * a slug that already exists is skipped, so re-running changes nothing.
 *
 * Prices are indicative, derived from published 2026 rates at Safari Soles and
 * Altezza and the market day-rate for mid-range Tanzania safaris. They are a
 * starting point for the team to confirm in Admin, not quoted costs.
 */
return new class extends Migration
{
    public function up(): void
    {
        $file = database_path('data/new_tours.json');

        if (! is_file($file)) {
            return;
        }

        $tours = json_decode((string) file_get_contents($file), true);

        if (! is_array($tours)) {
            return;
        }

        $hasFaqs = [
            'safari_packages'      => Schema::hasColumn('safari_packages', 'faqs'),
            'kilimanjaro_packages' => Schema::hasColumn('kilimanjaro_packages', 'faqs'),
        ];

        foreach ($tours as $t) {
            $table = $t['type'] === 'kilimanjaro' ? 'kilimanjaro_packages' : 'safari_packages';

            if (! Schema::hasTable($table)) {
                continue;
            }

            // Never overwrite a package that already exists under this slug.
            if (DB::table($table)->where('slug', $t['slug'])->exists()) {
                continue;
            }

            $row = [
                'title'       => $t['title'],
                'slug'        => $t['slug'],
                'summary'     => $t['summary'],
                'description' => $t['description'],
                'itinerary'   => json_encode($t['itinerary'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'inclusions'  => json_encode($t['inclusions'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'exclusions'  => json_encode($t['exclusions'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'price'       => $t['price'],
                'days'        => $t['days'],
                'image'       => $t['image'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];

            if ($hasFaqs[$table]) {
                $row['faqs'] = json_encode($t['faqs'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            }

            // Only set columns this table actually has, so a server whose schema
            // is a migration or two behind cannot fail the whole import.
            // "Safari" is the only category the existing safari packages use;
            // match it so the new tours sit in the same filters.
            $optional = [
                'currency'    => 'USD',
                'is_active'   => 1,
                'is_featured' => 0,
                'category'    => $table === 'safari_packages' ? 'Safari' : 'Kilimanjaro',
                'route_name'  => $t['route_name'] ?? $t['title'],   // NOT NULL on kilimanjaro_packages
            ];

            foreach ($optional as $col => $val) {
                if (Schema::hasColumn($table, $col)) {
                    $row[$col] = $val;
                }
            }
            $row = array_filter($row, fn ($v, $k) => Schema::hasColumn($table, $k), ARRAY_FILTER_USE_BOTH);

            DB::table($table)->insert($row);
        }
    }

    public function down(): void
    {
        $file = database_path('data/new_tours.json');

        if (! is_file($file)) {
            return;
        }

        $tours = json_decode((string) file_get_contents($file), true) ?: [];

        // Remove only the exact slugs this migration added.
        foreach ($tours as $t) {
            $table = $t['type'] === 'kilimanjaro' ? 'kilimanjaro_packages' : 'safari_packages';

            if (Schema::hasTable($table)) {
                DB::table($table)->where('slug', $t['slug'])->delete();
            }
        }
    }
};
