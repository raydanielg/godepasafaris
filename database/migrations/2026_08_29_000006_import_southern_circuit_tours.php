<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Adds 20 tours from the second batch of client documents.
 *
 * Eleven cover the Western and Southern circuits — Katavi, Mahale chimpanzees,
 * Nyerere, Ruaha, Rubondo, Mikumi and Udzungwa — which the site did not sell at
 * all. Those face far less competition than the Serengeti and Ngorongoro
 * itineraries every Arusha operator lists.
 *
 * PURELY ADDITIVE, same rule as the earlier imports: two documents describe
 * tours already published and are excluded at source; any slug that already
 * exists is skipped, so re-running is a no-op.
 *
 * The source documents are internal planning files. Sections headed "Costing
 * Assumptions for Internal Use", the cost/margin price tables and "Planning
 * Note" columns were stripped during conversion — none of that reaches the
 * website. Prices here are derived from the same market research as the first
 * batch and remain the team's to confirm.
 */
return new class extends Migration
{
    public function up(): void
    {
        $file = database_path('data/new_tours_2.json');

        if (! is_file($file) || ! Schema::hasTable('safari_packages')) {
            return;
        }

        $tours = json_decode((string) file_get_contents($file), true);

        if (! is_array($tours)) {
            return;
        }

        foreach ($tours as $t) {
            if (DB::table('safari_packages')->where('slug', $t['slug'])->exists()) {
                continue;
            }

            $row = [
                'title'        => $t['title'],
                'slug'         => $t['slug'],
                'summary'      => $t['summary'],
                'description'  => $t['description'],
                'article_html' => $t['article_html'],
                'itinerary'    => json_encode($t['itinerary'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'inclusions'   => json_encode($t['inclusions'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'exclusions'   => json_encode($t['exclusions'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'faqs'         => json_encode($t['faqs'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'price'        => $t['price'],
                'days'         => $t['days'],
                'image'        => $t['image'],
                'currency'     => 'USD',
                'category'     => 'Safari',
                'is_active'    => 1,
                'is_featured'  => 0,
                'created_at'   => now(),
                'updated_at'   => now(),
            ];

            $row = array_filter(
                $row,
                fn ($k) => Schema::hasColumn('safari_packages', $k),
                ARRAY_FILTER_USE_KEY
            );

            DB::table('safari_packages')->insert($row);
        }
    }

    public function down(): void
    {
        $file = database_path('data/new_tours_2.json');

        if (! is_file($file) || ! Schema::hasTable('safari_packages')) {
            return;
        }

        foreach (json_decode((string) file_get_contents($file), true) ?: [] as $t) {
            DB::table('safari_packages')->where('slug', $t['slug'])->delete();
        }
    }
};
