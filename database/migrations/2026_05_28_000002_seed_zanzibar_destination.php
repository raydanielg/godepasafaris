<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Insert Zanzibar into safari_destinations if it doesn't exist
        $exists = DB::table('safari_destinations')->where('slug', 'zanzibar')->exists();

        if (!$exists) {
            $id = DB::table('safari_destinations')->insertGetId([
                'name'              => 'Zanzibar Island',
                'slug'              => 'zanzibar',
                'tagline'           => 'Spice Island paradise — turquoise waters, coral reefs, and ancient Stone Town',
                'description'       => 'Zanzibar is a semi-autonomous archipelago off the coast of Tanzania, renowned for its stunning white-sand beaches, crystal-clear turquoise waters, vibrant coral reefs, and the UNESCO World Heritage Site of Stone Town. The island blends African, Arab, Indian, and European influences into a unique cultural tapestry. Beyond the beaches, Zanzibar offers spice tours, dolphin watching, snorkelling, kite-surfing, and exploring the historic alleys of Stone Town. It is the perfect complement to a Tanzania safari — trade your binoculars for a snorkel mask and relax in paradise.',
                'short_description' => "White beaches, spice tours, and the historic Stone Town — Zanzibar is Tanzania's island paradise.",
                'location'          => 'Indian Ocean, Tanzania Coast',
                'best_time'         => 'June – October & December – February',
                'icon'              => 'fa-umbrella-beach',
                'badge'             => 'Beach & Culture',
                'badge_color'       => 'info',
                'is_featured'       => 0,
                'is_active'         => 1,
                'display_order'     => 16,
                'highlight_1'       => 'UNESCO World Heritage Stone Town',
                'highlight_2'       => 'Pristine Coral Reefs & Marine Parks',
                'highlight_3'       => 'Spice Plantation Tours',
                'area'              => '2,462 km²',
                'established'       => 'Ancient — 10th Century',
                'wildlife_count'    => '200+ Marine Species',
                'gallery'           => '[]',
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);

            // Insert activities
            $activities = [
                ['name' => 'Beach Relaxation',     'icon' => 'fa-umbrella-beach', 'description' => 'Relax on world-class white sand beaches like Nungwi and Kendwa',        'display_order' => 1],
                ['name' => 'Snorkelling & Diving', 'icon' => 'fa-water',          'description' => 'Explore vibrant coral reefs and marine parks',                           'display_order' => 2],
                ['name' => 'Stone Town Tour',       'icon' => 'fa-mosque',         'description' => 'Walk the historic UNESCO World Heritage Site alleys',                    'display_order' => 3],
                ['name' => 'Spice Plantation Tour', 'icon' => 'fa-seedling',       'description' => 'Discover cloves, vanilla, cinnamon, and cardamom',                      'display_order' => 4],
                ['name' => 'Dolphin Watching',      'icon' => 'fa-fish',           'description' => 'Swim with wild dolphins in Kizimkazi Bay',                              'display_order' => 5],
                ['name' => 'Kite Surfing',          'icon' => 'fa-wind',           'description' => 'World-class kite surfing at Paje Beach',                                'display_order' => 6],
                ['name' => 'Deep Sea Fishing',      'icon' => 'fa-anchor',         'description' => 'Game fishing in the Indian Ocean',                                      'display_order' => 7],
                ['name' => 'Sunset Dhow Cruise',    'icon' => 'fa-ship',           'description' => 'Traditional wooden dhow sunset cruise with dinner',                     'display_order' => 8],
            ];

            foreach ($activities as $activity) {
                DB::table('safari_activities')->insert(array_merge($activity, [
                    'safari_destination_id' => $id,
                    'created_at'            => now(),
                    'updated_at'            => now(),
                ]));
            }
        }

        // Fix the Zanzibar menu link URL on production (may point to /all-tours from an earlier fix)
        DB::table('menu_links')
            ->where('title', 'Zanzibar Island')
            ->orWhere('title', 'Zanzibar Beach & Safari')
            ->update([
                'url'        => '/destinations/zanzibar',
                'title'      => 'Zanzibar Island',
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        $dest = DB::table('safari_destinations')->where('slug', 'zanzibar')->first();
        if ($dest) {
            DB::table('safari_activities')->where('safari_destination_id', $dest->id)->delete();
            DB::table('safari_destinations')->where('slug', 'zanzibar')->delete();
        }
    }
};
