<?php

namespace Database\Seeders;

use App\Models\SafariPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SafariSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'title' => '6 Day Tanzania Migration Safari and Ngorongoro Crater',
                'summary' => 'This 6 day safari in Tanzania offers an incredible wildlife experience in two of Africa\'s most famous safari destinations. Enjoy an exciting game drive in the breathtaking Ngorongoro Crater and search for the Great Migration herds in Serengeti.',
                'price' => 2370,
                'days' => 6,
                'image' => 'images/images/3-Days-Serengeti-Balloon-Safaris.webp',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Arrival to Ngorongoro Crater', 'description' => 'Upon arrival at Kilimanjaro International Airport (JRO) or Arusha Airport, you will be warmly welcomed by your professional safari guide who will brief you about your safari before departing for the Ngorongoro Conservation Area. Descend 600 meters into the crater for an exciting game drive.'],
                    ['day' => 2, 'title' => 'Ngorongoro to Central Serengeti', 'description' => 'After breakfast, depart for Central Serengeti. Enjoy scenic landscapes and wildlife viewing along the way. Central Serengeti is famous for its abundant wildlife and predators.'],
                    ['day' => 3, 'title' => 'Central Serengeti to Northern Serengeti (Migration Area)', 'description' => 'Depart for Northern Serengeti, one of the best locations to witness the dramatic Great Migration. Search for massive herds of wildebeest and zebras.'],
                    ['day' => 4, 'title' => 'Full Day Northern Serengeti to Mara River Crossing', 'description' => 'Full day game drive in Northern Serengeti focusing on the Great Migration and dramatic Mara River crossings.'],
                    ['day' => 5, 'title' => 'Full Day in Northern Serengeti', 'description' => 'Explore more of the Northern Serengeti in search of the migration and other wildlife like lions, cheetahs, and elephants.'],
                    ['day' => 6, 'title' => 'Fly Back to Arusha / JRO', 'description' => 'Transfer to Kogatende Airstrip for your scheduled flight to Arusha Airport.'],
                ],
                'inclusions' => [
                    'Airport pick-up and drop-off (JRO / Arusha)',
                    'Accommodation at chosen lodges or camps',
                    'Meals as indicated in the itinerary',
                    'All park entrance fees',
                    'Ngorongoro Crater service fee',
                    'Transport in a 4x4 safari vehicle with pop-up roof',
                    'Professional English-speaking safari guide',
                    'Game drives as per itinerary',
                    'Drinking water during safari',
                    'Flight from Kogatende to Arusha',
                    'Government taxes and levies'
                ],
                'exclusions' => [
                    'International flights',
                    'Visa fees for Tanzania',
                    'Travel insurance',
                    'Alcoholic and soft drinks (unless specified)',
                    'Personal expenses (laundry, telephone, souvenirs, etc.)',
                    'Optional activities not mentioned in the itinerary',
                    'Tips and gratuities for guide and lodge staff'
                ],
            ],
            [
                'title' => '10 Day Migration and Mara River Crossing Safari',
                'summary' => 'A deep dive into the heart of the migration cycle, spending more time in the most active areas of the Serengeti.',
                'price' => 4500,
                'days' => 10,
                'image' => 'images/images/The-Great-Wildebeest-Migration.jpg',
                'itinerary' => [], // Add dummy for now
                'inclusions' => [],
                'exclusions' => [],
            ],
            [
                'title' => '7 Day Tanzania Migration Safari and Ngorongoro Crater',
                'summary' => 'An extended version of our popular 6-day tour, allowing for a more relaxed pace and deeper exploration.',
                'price' => 2800,
                'days' => 7,
                'image' => 'images/images/Serengeti-National-Park-1.jpg',
                'itinerary' => [],
                'inclusions' => [],
                'exclusions' => [],
            ],
            [
                'title' => '7 Day Northern Circuit Tarangire, Serengeti, Ngorongoro and Lake Manyara',
                'summary' => 'The complete northern circuit experience, covering all major national parks in northern Tanzania.',
                'price' => 3240,
                'days' => 7,
                'image' => 'images/images/Elephants Maryam Laura Moazedi.jpg',
                'itinerary' => [],
                'inclusions' => [],
                'exclusions' => [],
            ]
        ];

        foreach ($packages as $pkg) {
            SafariPackage::create([
                'title' => $pkg['title'],
                'slug' => Str::slug($pkg['title']),
                'summary' => $pkg['summary'],
                'itinerary' => $pkg['itinerary'] ?? [],
                'inclusions' => $pkg['inclusions'] ?? [],
                'exclusions' => $pkg['exclusions'] ?? [],
                'price' => $pkg['price'],
                'image' => $pkg['image'],
                'days' => $pkg['days'],
            ]);
        }
    }
}
