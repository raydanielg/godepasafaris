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
                    ['day' => 1, 'title' => 'Arrival to Ngorongoro Crater', 'description' => 'Upon arrival at Kilimanjaro International Airport (JRO) or Arusha Airport, you will be warmly welcomed by your professional safari guide who will brief you about your safari before departing for the Ngorongoro Conservation Area. Descend 600 meters into the crater for an exciting game drive.', 'image' => 'images/images/360_F_1780607212_D459lFUNqKD0ziQZYUv7SCKFSeHTvpsl.jpg'],
                    ['day' => 2, 'title' => 'Ngorongoro to Central Serengeti', 'description' => 'After breakfast, depart for Central Serengeti. Enjoy scenic landscapes and wildlife viewing along the way. Central Serengeti is famous for its abundant wildlife and predators.', 'image' => 'images/images/Serengeti-National-Park-1.jpg'],
                    ['day' => 3, 'title' => 'Central Serengeti to Northern Serengeti (Migration Area)', 'description' => 'Depart for Northern Serengeti, one of the best locations to witness the dramatic Great Migration. Search for massive herds of wildebeest and zebras.', 'image' => 'images/images/The-Great-Wildebeest-Migration.jpg'],
                    ['day' => 4, 'title' => 'Full Day Northern Serengeti to Mara River Crossing', 'description' => 'Full day game drive in Northern Serengeti focusing on the Great Migration and dramatic Mara River crossings.', 'image' => 'images/images/migration-serengeti.jpg'],
                    ['day' => 5, 'title' => 'Full Day in Northern Serengeti', 'description' => 'Explore more of the Northern Serengeti in search of the migration and other wildlife like lions, cheetahs, and elephants.', 'image' => 'images/images/lion-6352243_1280.jpg'],
                    ['day' => 6, 'title' => 'Fly Back to Arusha / JRO', 'description' => 'Transfer to Kogatende Airstrip for your scheduled flight to Arusha Airport.', 'image' => 'images/images/jeep-safari-serengeti-national-park-pickup-off-road-cars-african-savannah-tanzania_759575-8551.jpg'],
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
            ],
            [
                'title' => '3-Day Serengeti Safari: Fly in, Fly out',
                'summary' => 'Maximize your time in the Serengeti with this efficient fly-in safari. Perfect for witnessing the migration highlights.',
                'price' => 2330,
                'days' => 3,
                'image' => 'images/images/SerengetiNationalPark-22.webp',
                'itinerary' => [],
                'inclusions' => [],
                'exclusions' => [],
            ],
            [
                'title' => '2-Day Zanzibar to Ngorongoro Crater & Tarangire Tour',
                'summary' => 'A perfect weekend getaway from Zanzibar to explore the famous Ngorongoro Crater and Tarangire National Park.',
                'price' => 1375,
                'days' => 2,
                'image' => 'images/images/banner_ngorongoroand-serengeti_safari_elephantflowers_trunk_up-copy.jpg',
                'itinerary' => [],
                'inclusions' => [],
                'exclusions' => [],
            ],
            [
                'title' => '9-Day Big 5 Africa Safari Tour (Budget)',
                'summary' => 'A comprehensive budget safari covering the best of Tanzania while keeping costs low through specialized camping.',
                'price' => 2210,
                'days' => 9,
                'image' => 'images/images/gaming-in-serengeti.jpg',
                'itinerary' => [],
                'inclusions' => [],
                'exclusions' => [],
            ],
            [
                'title' => '8-Day Safari Tarangire, Serengeti, Ngorongoro Crater (Affordable)',
                'summary' => 'An affordable mid-range safari experience focusing on the most iconic northern circuit parks.',
                'price' => 2935,
                'days' => 8,
                'image' => 'images/images/leopards-of-serengeti-1030x343.jpg',
                'itinerary' => [],
                'inclusions' => [],
                'exclusions' => [],
            ],
            [
                'title' => '1-Day Lake Manyara National Park Safari Trip',
                'summary' => 'A quick but intense day trip to the home of tree-climbing lions and massive flamingo flocks.',
                'price' => 240,
                'days' => 1,
                'image' => 'images/images/A-guide-to-the-Lobo-Area-in-the-Northern-Serengeti.jpg',
                'itinerary' => [],
                'inclusions' => [],
                'exclusions' => [],
            ],
            [
                'title' => '10-Day Wildebeest Migration Safari with Culture & Acidic Lakes',
                'summary' => 'Beyond the animals: experience the culture of the Hadzabe and the unique scenery of Lake Natron.',
                'price' => 3655,
                'days' => 10,
                'image' => 'images/images/tanzania-migratie-600x407.jpg',
                'itinerary' => [],
                'inclusions' => [],
                'exclusions' => [],
            ]
        ];

        foreach ($packages as $pkg) {
            SafariPackage::updateOrCreate(
                ['slug' => Str::slug($pkg['title'])],
                [
                    'title' => $pkg['title'],
                    'summary' => $pkg['summary'],
                    'itinerary' => $pkg['itinerary'] ?? [],
                    'inclusions' => $pkg['inclusions'] ?? [],
                    'exclusions' => $pkg['exclusions'] ?? [],
                    'price' => $pkg['price'],
                    'image' => $pkg['image'],
                    'days' => $pkg['days'],
                ]
            );
        }
    }
}
