<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SafariDestination;
use App\Models\SafariActivity;

class SafariDestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Serengeti National Park',
                'tagline' => 'Witness the Great Migration',
                'description' => 'The Serengeti is Tanzania\'s oldest and most popular national park, and a world heritage site. Famous for the annual migration of over 1.5 million wildebeest and 250,000 zebra, the park offers arguably the most scintillating game-viewing in Africa. The endless plains span 15,000 square kilometers, offering breathtaking landscapes and incredible predator action.',
                'short_description' => 'Home to the world\'s most spectacular wildlife migration',
                'location' => 'Northern Tanzania',
                'best_time' => 'June - October (Migration), December - March (Calving)',
                'icon' => 'fa-paw',
                'badge' => 'Popular',
                'badge_color' => 'danger',
                'is_featured' => true,
                'display_order' => 1,
                'highlight_1' => 'Great Migration viewing',
                'highlight_2' => 'Big Five encounters',
                'highlight_3' => 'Hot air balloon safaris',
                'area' => '14,763 km²',
                'established' => '1951',
                'wildlife_count' => '4,000+ lions',
                'activities' => [
                    ['name' => 'Game Drives', 'icon' => 'fa-car', 'description' => 'Full-day and half-day safari drives'],
                    ['name' => 'Hot Air Balloon', 'icon' => 'fa-hot-air-balloon', 'description' => 'Sunrise balloon safari with champagne breakfast'],
                    ['name' => 'Walking Safaris', 'icon' => 'fa-walking', 'description' => 'Guided bush walks with rangers'],
                    ['name' => 'Photography Tours', 'icon' => 'fa-camera', 'description' => 'Specialist photography safaris'],
                    ['name' => 'Cultural Visits', 'icon' => 'fa-users', 'description' => 'Maasai village experiences'],
                ]
            ],
            [
                'name' => 'Ngorongoro Crater',
                'tagline' => 'World\'s largest inactive volcano',
                'description' => 'Often called \'Africa\'s Garden of Eden\', the Ngorongoro Crater is the world\'s largest inactive volcanic caldera. This natural wonder is home to approximately 25,000 animals, including the densest known population of lions. The crater\'s walls rise 400-610 meters, creating a self-contained ecosystem with stunning diversity.',
                'short_description' => 'UNESCO World Heritage site with incredible wildlife density',
                'location' => 'Northern Tanzania (Ngorongoro Conservation Area)',
                'best_time' => 'Year-round (best June - October)',
                'icon' => 'fa-mountain',
                'badge' => null,
                'badge_color' => 'secondary',
                'is_featured' => true,
                'display_order' => 2,
                'highlight_1' => 'Highest wildlife density in Africa',
                'highlight_2' => 'Endangered black rhino',
                'highlight_3' => 'Stunning crater views',
                'area' => '260 km²',
                'established' => '1959',
                'wildlife_count' => '25,000+ animals',
                'activities' => [
                    ['name' => 'Crater Game Drives', 'icon' => 'fa-car', 'description' => 'Full-day exploration of the crater floor'],
                    ['name' => 'Crater Rim Walks', 'icon' => 'fa-hiking', 'description' => 'Guided walks along the crater rim'],
                    ['name' => 'Maasai Village Visit', 'icon' => 'fa-users', 'description' => 'Authentic cultural experience'],
                    ['name' => 'Lerai Forest Tracking', 'icon' => 'fa-binoculars', 'description' => 'Elephant and bird watching'],
                    ['name' => 'Olduvai Gorge Tour', 'icon' => 'fa-landmark', 'description' => 'Visit the cradle of mankind'],
                ]
            ],
            [
                'name' => 'Tarangire National Park',
                'tagline' => 'Home to giant elephants',
                'description' => 'Tarangire is famous for its massive elephant herds and iconic baobab trees. During the dry season, the Tarangire River becomes the only water source, attracting enormous concentrations of wildlife. The park offers excellent game viewing with fewer crowds than the northern circuit parks.',
                'short_description' => 'Elephant paradise with iconic baobab landscapes',
                'location' => 'Northern Tanzania (118km from Arusha)',
                'best_time' => 'June - November (Dry season)',
                'icon' => 'fa-tree',
                'badge' => null,
                'badge_color' => 'secondary',
                'is_featured' => false,
                'display_order' => 3,
                'highlight_1' => 'Largest elephant herds in Tanzania',
                'highlight_2' => 'Ancient baobab trees',
                'highlight_3' => 'Excellent bird watching',
                'area' => '2,850 km²',
                'established' => '1970',
                'wildlife_count' => '3,000+ elephants',
                'activities' => [
                    ['name' => 'Game Drives', 'icon' => 'fa-car', 'description' => 'Explore elephant country'],
                    ['name' => 'Walking Safaris', 'icon' => 'fa-walking', 'description' => 'Guided nature walks'],
                    ['name' => 'Bird Watching', 'icon' => 'fa-dove', 'description' => '500+ bird species'],
                    ['name' => 'Night Game Drives', 'icon' => 'fa-moon', 'description' => 'Nocturnal wildlife viewing'],
                    ['name' => 'Fly Camping', 'icon' => 'fa-campground', 'description' => 'Sleep under the stars'],
                ]
            ],
            [
                'name' => 'Lake Manyara',
                'tagline' => 'Tree-climbing lions',
                'description' => 'Nestled at the base of the Rift Valley escarpment, Lake Manyara is a scenic gem. The park is renowned for its unusual tree-climbing lions, vast elephant herds, and the soda lake that attracts thousands of pink flamingos. Its compact size makes it perfect for day trips.',
                'short_description' => 'Scenic park famous for tree-climbing lions',
                'location' => 'Northern Tanzania (126km from Arusha)',
                'best_time' => 'June - October (Dry season)',
                'icon' => 'fa-water',
                'badge' => null,
                'badge_color' => 'secondary',
                'is_featured' => false,
                'display_order' => 4,
                'highlight_1' => 'Famous tree-climbing lions',
                'highlight_2' => 'Thousands of flamingos',
                'highlight_3' => 'Groundwater forest',
                'area' => '330 km²',
                'established' => '1960',
                'wildlife_count' => '400+ bird species',
                'activities' => [
                    ['name' => 'Game Drives', 'icon' => 'fa-car', 'description' => 'Compact park exploration'],
                    ['name' => 'Canoe Safari', 'icon' => 'fa-water', 'description' => 'Paddle on the lake (seasonal)'],
                    ['name' => 'Tree Walk', 'icon' => 'fa-tree', 'description' => 'Elevated walkway through forest'],
                    ['name' => 'Bird Watching', 'icon' => 'fa-binoculars', 'description' => 'Flamingos and pelicans'],
                    ['name' => 'Night Drives', 'icon' => 'fa-moon', 'description' => 'After-dark wildlife viewing'],
                ]
            ],
            [
                'name' => 'Selous Game Reserve',
                'tagline' => 'Africa\'s largest game reserve',
                'description' => 'The Selous is Africa\'s largest game reserve and a UNESCO World Heritage site. Three times larger than the Serengeti, this vast wilderness offers a truly exclusive safari experience. The Rufiji River system creates a unique ecosystem perfect for boat safaris and walking expeditions.',
                'short_description' => 'Untouched wilderness, boat safaris, walking expeditions',
                'location' => 'Southern Tanzania',
                'best_time' => 'June - October',
                'icon' => 'fa-binoculars',
                'badge' => 'Wild',
                'badge_color' => 'warning',
                'is_featured' => true,
                'display_order' => 5,
                'highlight_1' => 'Boat safaris on Rufiji River',
                'highlight_2' => 'Walking safaris permitted',
                'highlight_3' => 'Wild dog viewing',
                'area' => '50,000 km²',
                'established' => '1922',
                'wildlife_count' => 'Largest wild dog population',
                'activities' => [
                    ['name' => 'Boat Safaris', 'icon' => 'fa-ship', 'description' => 'River and lake exploration'],
                    ['name' => 'Game Drives', 'icon' => 'fa-car', 'description' => 'Off-road driving permitted'],
                    ['name' => 'Walking Safaris', 'icon' => 'fa-walking', 'description' => 'Multi-day foot expeditions'],
                    ['name' => 'Fly Camping', 'icon' => 'fa-campground', 'description' => 'Sleep in the wild'],
                    ['name' => 'Fishing', 'icon' => 'fa-fish', 'description' => 'Tiger fish and catfish'],
                ]
            ],
            [
                'name' => 'Ruaha National Park',
                'tagline' => 'Untouched wilderness',
                'description' => 'Tanzania\'s largest national park, Ruaha remains one of the continent\'s best-kept safari secrets. The Great Ruaha River attracts incredible concentrations of wildlife, including 10% of Africa\'s lions. The park offers an authentic, crowd-free wilderness experience.',
                'short_description' => 'Tanzania\'s largest park, remote and wild',
                'location' => 'Central Tanzania',
                'best_time' => 'June - October',
                'icon' => 'fa-safari',
                'badge' => null,
                'badge_color' => 'secondary',
                'is_featured' => false,
                'display_order' => 6,
                'highlight_1' => '10% of Africa\'s lions',
                'highlight_2' => 'Giant baobab forests',
                'highlight_3' => 'Rare antelope species',
                'area' => '20,226 km²',
                'established' => '1964',
                'wildlife_count' => 'Largest elephant herds',
                'activities' => [
                    ['name' => 'Game Drives', 'icon' => 'fa-car', 'description' => 'All-day wilderness drives'],
                    ['name' => 'Walking Safaris', 'icon' => 'fa-walking', 'description' => 'Bush walks with rangers'],
                    ['name' => 'Bird Watching', 'icon' => 'fa-dove', 'description' => '574 bird species'],
                    ['name' => 'Night Drives', 'icon' => 'fa-moon', 'description' => 'Nocturnal predator viewing'],
                    ['name' => 'Cultural Tours', 'icon' => 'fa-users', 'description' => 'Hehe and Barabaig visits'],
                ]
            ],
        ];

        foreach ($destinations as $destData) {
            $activities = $destData['activities'] ?? [];
            unset($destData['activities']);
            
            $destination = SafariDestination::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($destData['name'])],
                $destData
            );
            
            foreach ($activities as $activity) {
                SafariActivity::firstOrCreate(
                    [
                        'safari_destination_id' => $destination->id,
                        'name' => $activity['name']
                    ],
                    $activity
                );
            }
        }
    }
}
