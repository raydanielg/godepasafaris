<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            [
                'title' => 'Zanzibar',
                'category' => 'Beach & Islands Ext',
                'description' => 'Zanzibar is a Tanzanian archipelago, located on the eastern coast of Tanzania, Africa in the middle of the Indian Ocean, it is a semi-...',
                'image' => 'images/images/635ZANZIBAR_ISLAND.webp',
                'rate_range' => '$120 to $2820',
                'best_time' => 'June to October',
                'high_season' => 'July to October'
            ],
            [
                'title' => 'Arusha',
                'category' => 'Towns and Cities',
                'description' => 'Arusha city is located in the northern part of the country. The city is well known as the country\'s main safari hub. It is a starting point for the ver...',
                'image' => 'images/images/360_F_1780607212_D459lFUNqKD0ziQZYUv7SCKFSeHTvpsl.jpg',
                'rate_range' => '$2370 to $3240',
                'best_time' => 'It is a year-round touring destination',
                'high_season' => 'July to August'
            ],
            [
                'title' => 'Arusha National Park Safari',
                'category' => 'National Parks',
                'description' => 'Arusha national park is among the best parks in the north of Tanzania. The park is located a few kilometers northeast of Arusha. The main gate i...',
                'image' => 'images/images/photo-1575999502951-4ab25b5ca889.avif',
                'rate_range' => '$420 to $3900',
                'best_time' => 'June - October',
                'high_season' => 'July - August'
            ],
            [
                'title' => 'Mount Kilimanjaro',
                'category' => 'Mountains',
                'description' => 'The highest peak in Africa and the tallest free-standing mountain in the world. Scaling Kilimanjaro is a bucket-list achievement...',
                'image' => 'images/images/4-Kilimanjaro-Jane-at-summit-SC_JW.jpg',
                'rate_range' => '$1500 to $5000',
                'best_time' => 'January - March, June - October',
                'high_season' => 'August - September'
            ],
            [
                'title' => 'Serengeti National Park',
                'category' => 'National Parks',
                'description' => 'Famous for its annual wildebeest migration and incredible lion population. The endless plains of the Serengeti offer the quintessential safari...',
                'image' => 'images/images/Serengeti-National-Park-1.jpg',
                'rate_range' => '$500 to $4500',
                'best_time' => 'June - October',
                'high_season' => 'July - August'
            ]
        ];

        foreach ($destinations as $dest) {
            \App\Models\Destination::create([
                'title' => $dest['title'],
                'slug' => \Illuminate\Support\Str::slug($dest['title']),
                'category' => $dest['category'],
                'description' => $dest['description'],
                'image' => $dest['image'],
                'rate_range' => $dest['rate_range'],
                'best_time' => $dest['best_time'],
                'high_season' => $dest['high_season'],
            ]);
        }
    }
}
