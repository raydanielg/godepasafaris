<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KilimanjaroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'title' => '6 Day Kilimanjaro Trekking Marangu Route',
                'route_name' => 'Marangu Route',
                'days' => 6,
                'price' => 1850,
                'description' => 'The Marangu Route, also known as the "Coca-Cola" route, is the oldest and most established route on Kilimanjaro.',
                'rich_content' => '<p>The Marangu Route is iconic for being the only route that offers hut accommodation, meaning you don\'t have to sleep in tents. It is often considered the easiest path, but don\'t be fooled—the final summit push is still a significant challenge.</p>
                <p>Enjoy beautiful rainforests, alpine meadows, and the unique lunar landscape of the saddle between Mawenzi and Kibo peaks.</p>',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Marangu Gate to Mandara Hut', 'description' => 'Trek through the lush rainforest to reach Mandara Hut at 2,700m.'],
                    ['day' => 2, 'title' => 'Mandara Hut to Horombo Hut', 'description' => 'Leave the forest and enter the moorland zone. Views of Mawenzi peak are spectacular.'],
                    ['day' => 3, 'title' => 'Horombo Hut to Kibo Hut', 'description' => 'Crossing the "Saddle," a high-altitude desert between the two main peaks.'],
                    ['day' => 4, 'title' => 'Summit Day: Kibo Hut to Uhuru Peak', 'description' => 'The final push to the roof of Africa at 5,895m, then descending back to Horombo.'],
                    ['day' => 5, 'title' => 'Horombo Hut to Marangu Gate', 'description' => 'Descending back through the forest to receive your summit certificates.'],
                ],
                'inclusions' => ['Professional English-speaking guides', 'National Park fees', 'Hut accommodation', 'All meals on the mountain', 'Rescue fees'],
                'exclusions' => ['International flights', 'Tips for guides and porters', 'Personal trekking gear', 'Visa fees'],
                'image' => 'images/images/Kilimanjaro.jpg',
            ],
            [
                'title' => '7 Day Kilimanjaro Trekking Machame Route',
                'route_name' => 'Machame Route',
                'days' => 7,
                'price' => 2100,
                'description' => 'Known as the "Whiskey Route," Machame offers stunning scenery and better acclimatization.',
                'rich_content' => '<p>The Machame route is highly recommended for its high success rate and breathtaking views. You will climb high and sleep low, which is the golden rule of altitude acclimatization.</p>',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Machame Gate to Machame Camp', 'description' => 'Beginning the climb in the rainforest.'],
                    ['day' => 2, 'title' => 'Machame Camp to Shira 2 Camp', 'description' => 'Steep climb onto the Shira Plateau.'],
                    ['day' => 3, 'title' => 'Shira 2 to Lava Tower to Barranco Camp', 'description' => 'Acclimatization day climbing to 4,600m then descending to sleep at 3,900m.'],
                    ['day' => 4, 'title' => 'Barranco Camp to Karanga Camp', 'description' => 'Conquering the famous Barranco Wall.'],
                    ['day' => 5, 'title' => 'Karanga Camp to Barafu Camp', 'description' => 'Preparation for the midnight summit push.'],
                    ['day' => 6, 'title' => 'Summit Day: Barafu to Uhuru Peak', 'description' => 'Reaching the summit and descending to Mweka Camp.'],
                    ['day' => 7, 'title' => 'Mweka Camp to Mweka Gate', 'description' => 'Final descent and celebration.'],
                ],
                'inclusions' => ['Professional WFR certified guides', 'High-quality camping equipment', 'Private chemical toilet', 'Oxygen cylinders for emergencies'],
                'exclusions' => ['Personal expenses', 'Travel insurance', 'Alcoholic beverages'],
                'image' => 'images/images/safari soles mountain kilimanjaro.jpg',
            ],
        ];

        foreach ($packages as $pkg) {
            \App\Models\KilimanjaroPackage::create([
                'title' => $pkg['title'],
                'slug' => \Illuminate\Support\Str::slug($pkg['title']),
                'route_name' => $pkg['route_name'],
                'days' => $pkg['days'],
                'price' => $pkg['price'],
                'description' => $pkg['description'],
                'rich_content' => $pkg['rich_content'],
                'itinerary' => $pkg['itinerary'],
                'inclusions' => $pkg['inclusions'],
                'exclusions' => $pkg['exclusions'],
                'image' => $pkg['image'],
            ]);
        }
    }
}
