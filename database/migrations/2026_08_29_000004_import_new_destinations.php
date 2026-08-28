<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Adds 14 destinations the site did not previously cover.
 *
 * Bagamoyo, Jambiani, Kendwa, Kilwa Kisiwani, Lake Natron, Mafia Island, Mount
 * Meru, Mto wa Mbu, Nungwi, Nyerere, Olduvai Gorge, Paje, Pemba and Stone Town —
 * mostly coastal, southern and archaeological places where there is far less
 * competition than Serengeti or Ngorongoro.
 *
 * PURELY ADDITIVE. The nine guides covering destinations that already exist
 * (Serengeti, Ngorongoro, Tarangire, Lake Manyara, Ruaha, Mikumi, Arusha NP,
 * Kilimanjaro, Zanzibar) are deliberately not in the JSON, so no existing page
 * is edited. A slug that already exists is skipped, making this safe to re-run.
 *
 * featured_image is intentionally left null: the model already resolves a
 * slug-based fallback, and the team can upload real photography per destination
 * from the admin panel rather than shipping stock imagery.
 */
return new class extends Migration
{
    public function up(): void
    {
        $file = database_path('data/new_destinations.json');

        if (! is_file($file) || ! Schema::hasTable('safari_destinations')) {
            return;
        }

        $rows = json_decode((string) file_get_contents($file), true);

        if (! is_array($rows)) {
            return;
        }

        $order = (int) DB::table('safari_destinations')->max('display_order');

        foreach ($rows as $d) {
            if (DB::table('safari_destinations')->where('slug', $d['slug'])->exists()) {
                continue;
            }

            $row = [
                'name'              => $d['name'],
                'slug'              => $d['slug'],
                'tagline'           => $d['tagline'] ?: null,
                'description'       => $d['description'],
                'short_description' => $d['short_description'],
                'article_html'      => $d['article_html'],
                'faqs'              => json_encode($d['faqs'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'location'          => $d['location'],
                'best_time'         => $d['best_time'],
                'icon'              => $d['icon'],
                'badge'             => $d['badge'],
                'badge_color'       => 'success',   // NOT NULL; only shown when a badge is set
                'is_active'         => 1,
                'is_featured'       => 0,
                'display_order'     => ++$order,
                'created_at'        => now(),
                'updated_at'        => now(),
            ];

            // Tolerate a server whose schema is a migration behind.
            $row = array_filter(
                $row,
                fn ($k) => Schema::hasColumn('safari_destinations', $k),
                ARRAY_FILTER_USE_KEY
            );

            DB::table('safari_destinations')->insert($row);
        }
    }

    public function down(): void
    {
        $file = database_path('data/new_destinations.json');

        if (! is_file($file) || ! Schema::hasTable('safari_destinations')) {
            return;
        }

        foreach (json_decode((string) file_get_contents($file), true) ?: [] as $d) {
            DB::table('safari_destinations')->where('slug', $d['slug'])->delete();
        }
    }
};
