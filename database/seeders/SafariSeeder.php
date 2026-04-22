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
                    ['day' => 1, 'title' => 'Arrival & Ngorongoro Crater', 'description' => 'Upon arrival at Kilimanjaro International Airport (JRO) or Arusha Airport, your professional safari guide will warmly welcome you. After a safari briefing, depart for Ngorongoro Conservation Area. Descend 600 meters into the crater for an exciting afternoon game drive. This UNESCO World Heritage Site is home to over 25,000 animals including the rare black rhino.', 'image' => 'images/images/360_F_1780607212_D459lFUNqKD0ziQZYUv7SCKFSeHTvpsl.jpg'],
                    ['day' => 2, 'title' => 'Ngorongoro to Central Serengeti', 'description' => 'After breakfast, depart for Central Serengeti via the scenic Malanja Depression. Enjoy en-route game viewing as you traverse the Ngorongoro Highlands. Central Serengeti is famous for its abundant wildlife including lions, leopards, cheetahs, and vast herds of wildebeest and zebras.', 'image' => 'images/images/Serengeti-National-Park-1.jpg'],
                    ['day' => 3, 'title' => 'Central to Northern Serengeti (Migration)', 'description' => 'Depart for Northern Serengeti, the heart of the Great Migration from July to October. This region offers some of Africa\'s most dramatic wildlife spectacles as millions of wildebeest and zebras cross the Mara River, braving crocodile-infested waters.', 'image' => 'images/images/The-Great-Wildebeest-Migration.jpg'],
                    ['day' => 4, 'title' => 'Mara River Crossing', 'description' => 'Full day dedicated to witnessing the dramatic Mara River crossings. Your expert guide will position the vehicle at strategic crossing points. Watch in awe as thousands of wildebeest plunge into the river while Nile crocodiles lie in wait. Also spot lions, hyenas, and other predators following the herds.', 'image' => 'images/images/migration-serengeti.jpg'],
                    ['day' => 5, 'title' => 'Northern Serengeti Exploration', 'description' => 'Explore more of the Northern Serengeti\'s remote areas including the Bologonja Springs and Lobo Valley. These less-visited regions offer excellent predator sightings including lions, cheetahs, and leopards. The landscape here is stunning with granite kopjes and acacia woodlands.', 'image' => 'images/images/lion-6352243_1280.jpg'],
                    ['day' => 6, 'title' => 'Fly Back to Arusha / JRO', 'description' => 'Enjoy a final morning game drive in the Serengeti, then transfer to Kogatende Airstrip for your scheduled flight back to Arusha Airport. From Arusha, connect to your international flight at JRO or extend your stay in Tanzania.', 'image' => 'images/images/jeep-safari-serengeti-national-park-pickup-off-road-cars-african-savannah-tanzania_759575-8551.jpg'],
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
                'itinerary' => [
                    ['day' => 1, 'title' => 'Arusha to Tarangire National Park', 'description' => 'Depart from Arusha after breakfast and drive to Tarangire National Park. This park is famous for its massive elephant herds and iconic baobab trees. Enjoy afternoon game drives along the Tarangire River where wildlife congregates. Watch elephants digging for underground water and spot tree-climbing pythons.', 'image' => 'images/images/Elephants Maryam Laura Moazedi.jpg'],
                    ['day' => 2, 'title' => 'Tarangire to Serengeti via Ngorongoro', 'description' => 'After breakfast, drive to Serengeti National Park via Ngorongoro Conservation Area. Pass through the scenic highlands with panoramic views. Stop at the viewpoint for spectacular crater vistas. Enter Serengeti and enjoy evening game drives as the sun sets over the endless plains.', 'image' => 'images/images/Serengeti-National-Park-1.jpg'],
                    ['day' => 3, 'title' => 'Central Serengeti - Big Five Territory', 'description' => 'Full day game drives in Central Serengeti, known as Seronera. This area has the highest concentration of wildlife year-round. Search for lions, leopards, cheetahs, elephants, and buffalo. Visit the Seronera River where hippos and crocodiles coexist. Perfect for wildlife photography.', 'image' => 'images/images/lion-6352243_1280.jpg'],
                    ['day' => 4, 'title' => 'Serengeti to Northern Serengeti (Kogatende)', 'description' => 'Drive north to Kogatende, the migration hotspot. Pass through the Lobo area with kopje-dotted landscapes. Arrive at the Mara River area where dramatic crossings occur. Your guide will scout for crossing points and position you for the best viewing opportunities.', 'image' => 'images/images/A-guide-to-the-Lobo-Area-in-the-Northern-Serengeti.jpg'],
                    ['day' => 5, 'title' => 'Mara River Crossing Spectacle', 'description' => 'Full day dedicated to witnessing the dramatic Mara River crossings. Watch thousands of wildebeest and zebras gather at the riverbanks, building courage to cross. The tension mounts until the first brave animal jumps in, triggering a mass crossing. Crocodiles, lions, and hyenas wait for opportunities.', 'image' => 'images/images/migration-serengeti.jpg'],
                    ['day' => 6, 'title' => 'Northern Serengeti Game Drives', 'description' => 'Continue exploring the Northern Serengeti\'s remote valleys and woodlands. Visit the Bologonja Springs, a vital water source attracting diverse wildlife. The area is known for large lion prides and frequent leopard sightings. The scenery features rolling hills and granite outcrops.', 'image' => 'images/images/gaming-in-serengeti.jpg'],
                    ['day' => 7, 'title' => 'Northern to Central Serengeti', 'description' => 'Slow drive south with extensive game viewing en route. Pass through different ecosystems - from woodland to grassland. Stop at the Retima Hippo Pool to observe hundreds of hippos. The landscape changes dramatically as you approach the central plains.', 'image' => 'images/images/The-Great-Wildebeest-Migration.jpg'],
                    ['day' => 8, 'title' => 'Serengeti to Ngorongoro Crater', 'description' => 'Morning game drive in the Serengeti then drive to Ngorongoro. Descend 600 meters into the crater for afternoon wildlife viewing. The crater floor hosts the densest concentration of wildlife in Africa including the rare black rhino, lions, elephants, and flamingos at Lake Magadi.', 'image' => 'images/images/360_F_1780607212_D459lFUNqKD0ziQZYUv7SCKFSeHTvpsl.jpg'],
                    ['day' => 9, 'title' => 'Full Day Ngorongoro Crater Adventure', 'description' => 'Full day exploring the Ngorongoro Crater, often called the \'Garden of Eden\'. Visit Lerai Forest for elephant encounters. Watch flamingos at Lake Magadi. Search for the elusive black rhino in the open grasslands. Enjoy a picnic lunch at the hippo pool with stunning views.', 'image' => 'images/images/banner_ngorongoroand-serengeti_safari_elephantflowers_trunk_up-copy.jpg'],
                    ['day' => 10, 'title' => 'Ngorongoro to Arusha - Departure', 'description' => 'Final morning game drive in the crater at sunrise when predators are most active. After breakfast, ascend the crater walls and drive back to Arusha. Stop at Mto wa Mbu village for souvenir shopping. Transfer to Kilimanjaro International Airport for your departure flight.', 'image' => 'images/images/jeep-safari-serengeti-national-park-pickup-off-road-cars-african-savannah-tanzania_759575-8551.jpg'],
                ],
                'inclusions' => ['Professional safari guide', '4x4 safari vehicle', 'Park fees', 'Accommodation', 'Meals', 'Airport transfers'],
                'exclusions' => ['International flights', 'Visa fees', 'Personal expenses', 'Tips'],
            ],
            [
                'title' => '7 Day Tanzania Migration Safari and Ngorongoro Crater',
                'summary' => 'An extended version of our popular 6-day tour, allowing for a more relaxed pace and deeper exploration.',
                'price' => 2800,
                'days' => 7,
                'image' => 'images/images/Serengeti-National-Park-1.jpg',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Arusha to Lake Manyara', 'description' => 'Depart from Arusha and drive to Lake Manyara National Park. This compact park is famous for its tree-climbing lions and massive flocks of flamingos that turn the lake pink. Enjoy afternoon game drives through the groundwater forest and open plains.', 'image' => 'images/images/A-guide-to-the-Lobo-Area-in-the-Northern-Serengeti.jpg'],
                    ['day' => 2, 'title' => 'Lake Manyara to Serengeti', 'description' => 'After breakfast, travel to Serengeti National Park with game drives en route. Pass through Ngorongoro Conservation Area with stunning highland scenery. Enter the Serengeti through Naabi Hill Gate and enjoy evening game drives as wildlife becomes active.', 'image' => 'images/images/Serengeti-National-Park-1.jpg'],
                    ['day' => 3, 'title' => 'Full Day Serengeti Adventure', 'description' => 'Spend a full day exploring the endless plains of Serengeti. Search for the Big Five - lions, leopards, elephants, buffalo, and rhinos. Witness the great migration herds if visiting during migration season. Visit the Seronera River for hippo and crocodile sightings.', 'image' => 'images/images/The-Great-Wildebeest-Migration.jpg'],
                    ['day' => 4, 'title' => 'Serengeti to Ngorongoro', 'description' => 'Enjoy a morning game drive in Serengeti, then drive to Ngorongoro rim for overnight. The lodge perched on the crater rim offers spectacular sunset views over the crater floor. Watch the changing colors as the sun disappears.', 'image' => 'images/images/360_F_1780607212_D459lFUNqKD0ziQZYUv7SCKFSeHTvpsl.jpg'],
                    ['day' => 5, 'title' => 'Ngorongoro Crater Full Day', 'description' => 'Descend 600 meters into Ngorongoro Crater for a full day of game viewing. This Garden of Eden is home to over 25,000 animals including the rare black rhino. Spot lions hunting on the open grasslands and watch elephants in the Lerai Forest.', 'image' => 'images/images/banner_ngorongoroand-serengeti_safari_elephantflowers_trunk_up-copy.jpg'],
                    ['day' => 6, 'title' => 'Ngorongoro to Tarangire', 'description' => 'After breakfast, descend from Ngorongoro highlands and drive to Tarangire National Park. Famous for massive elephant herds and ancient baobab trees. Enjoy an afternoon game drive along the Tarangire River.', 'image' => 'images/images/Elephants Maryam Laura Moazedi.jpg'],
                    ['day' => 7, 'title' => 'Tarangire to Arusha', 'description' => 'Final morning game drive in Tarangire watching elephants and other wildlife. After lunch, drive back to Arusha with drop-off at Kilimanjaro International Airport or your hotel. End of an unforgettable safari!', 'image' => 'images/images/jeep-safari-serengeti-national-park-pickup-off-road-cars-african-savannah-tanzania_759575-8551.jpg'],
                ],
                'inclusions' => ['Professional guide', '4x4 vehicle', 'Park fees', 'Accommodation', 'Meals', 'Transfers'],
                'exclusions' => ['Flights', 'Visa', 'Drinks', 'Tips'],
            ],
            [
                'title' => '7 Day Northern Circuit Tarangire, Serengeti, Ngorongoro and Lake Manyara',
                'summary' => 'The complete northern circuit experience, covering all major national parks in northern Tanzania.',
                'price' => 3240,
                'days' => 7,
                'image' => 'images/images/Elephants Maryam Laura Moazedi.jpg',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Arusha to Tarangire', 'description' => 'Drive to Tarangire National Park. Famous for elephants and baobab trees. Game drive in afternoon.'],
                    ['day' => 2, 'title' => 'Tarangire to Serengeti', 'description' => 'Full day drive to Serengeti with game viewing along the way through Maasai lands.'],
                    ['day' => 3, 'title' => 'Full Day Serengeti', 'description' => 'Explore the Serengeti plains, tracking wildlife and enjoying the vast savannah landscapes.'],
                    ['day' => 4, 'title' => 'Serengeti to Ngorongoro', 'description' => 'Morning game drive, then proceed to Ngorongoro Conservation Area with optional Olduvai Gorge visit.'],
                    ['day' => 5, 'title' => 'Ngorongoro Crater', 'description' => 'Full day crater tour with picnic lunch. High density of wildlife including rhinos.'],
                    ['day' => 6, 'title' => 'Ngorongoro to Lake Manyara', 'description' => 'Drive to Lake Manyara for afternoon game drive. Tree-climbing lions and bird watching.'],
                    ['day' => 7, 'title' => 'Lake Manyara to Arusha', 'description' => 'Morning game drive then return to Arusha. Airport transfer for departure.'],
                ],
                'inclusions' => ['Guide', 'Vehicle', 'Park fees', 'Accommodation', 'Meals'],
                'exclusions' => ['Flights', 'Visa', 'Drinks', 'Tips'],
            ],
            [
                'title' => '3-Day Serengeti Safari: Fly in, Fly out',
                'summary' => 'Maximize your time in the Serengeti with this efficient fly-in safari. Perfect for witnessing the migration highlights.',
                'price' => 2330,
                'days' => 3,
                'image' => 'images/images/SerengetiNationalPark-22.webp',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Fly to Serengeti', 'description' => 'Morning flight from Arusha to Serengeti. Afternoon game drive in Central Serengeti.'],
                    ['day' => 2, 'title' => 'Full Day Serengeti', 'description' => 'Full day game drives exploring the endless plains, tracking the great migration.'],
                    ['day' => 3, 'title' => 'Fly Back to Arusha', 'description' => 'Morning game drive, then fly back to Arusha with amazing aerial views.'],
                ],
                'inclusions' => ['Flights', 'Guide', 'Park fees', 'Accommodation', 'Meals'],
                'exclusions' => ['Visa', 'Drinks', 'Tips'],
            ],
            [
                'title' => '2-Day Zanzibar to Ngorongoro Crater & Tarangire Tour',
                'summary' => 'A perfect weekend getaway from Zanzibar to explore the famous Ngorongoro Crater and Tarangire National Park.',
                'price' => 1375,
                'days' => 2,
                'image' => 'images/images/banner_ngorongoroand-serengeti_safari_elephantflowers_trunk_up-copy.jpg',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Zanzibar to Ngorongoro', 'description' => 'Morning flight to Arusha, then drive to Ngorongoro Crater for afternoon game drive.'],
                    ['day' => 2, 'title' => 'Tarangire to Zanzibar', 'description' => 'Morning game drive in Tarangire, then flight back to Zanzibar.'],
                ],
                'inclusions' => ['Flights', 'Guide', 'Park fees', 'Accommodation', 'Meals'],
                'exclusions' => ['Visa', 'Drinks', 'Tips'],
            ],
            [
                'title' => '9-Day Big 5 Africa Safari Tour (Budget)',
                'summary' => 'A comprehensive budget safari covering the best of Tanzania while keeping costs low through specialized camping.',
                'price' => 2210,
                'days' => 9,
                'image' => 'images/images/gaming-in-serengeti.jpg',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Arusha to Tarangire', 'description' => 'Drive to Tarangire. Afternoon game drive. Budget camping.'],
                    ['day' => 2, 'title' => 'Tarangire to Serengeti', 'description' => 'Full day drive to Serengeti with game viewing.'],
                    ['day' => 3, 'title' => 'Serengeti North', 'description' => 'Game drives in Northern Serengeti following migration.'],
                    ['day' => 4, 'title' => 'Serengeti Central', 'description' => 'Full day in Central Serengeti with abundant wildlife.'],
                    ['day' => 5, 'title' => 'Serengeti to Ngorongoro', 'description' => 'Morning drive, then to Ngorongoro rim.'],
                    ['day' => 6, 'title' => 'Ngorongoro Crater', 'description' => 'Full day crater tour with picnic lunch.'],
                    ['day' => 7, 'title' => 'Ngorongoro to Manyara', 'description' => 'Drive to Lake Manyara for game drive.'],
                    ['day' => 8, 'title' => 'Manyara to Arusha', 'description' => 'Morning drive then return to Arusha town.'],
                    ['day' => 9, 'title' => 'Departure', 'description' => 'Airport transfer for your flight home.'],
                ],
                'inclusions' => ['Guide', 'Camping gear', 'Park fees', 'Meals', 'Transfers'],
                'exclusions' => ['Flights', 'Visa', 'Drinks', 'Tips', 'Accommodation upgrades'],
            ],
            [
                'title' => '8-Day Safari Tarangire, Serengeti, Ngorongoro Crater (Affordable)',
                'summary' => 'An affordable mid-range safari experience focusing on the most iconic northern circuit parks.',
                'price' => 2935,
                'days' => 8,
                'image' => 'images/images/leopards-of-serengeti-1030x343.jpg',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Arusha to Tarangire', 'description' => 'Drive to Tarangire National Park. Game drive.'],
                    ['day' => 2, 'title' => 'Tarangire to Serengeti', 'description' => 'Full day drive to Serengeti with game viewing.'],
                    ['day' => 3, 'title' => 'Serengeti North', 'description' => 'Game drives in Northern Serengeti.'],
                    ['day' => 4, 'title' => 'Northern Serengeti', 'description' => 'Full day exploring migration areas.'],
                    ['day' => 5, 'title' => 'Serengeti Central', 'description' => 'Game drives in Central Serengeti.'],
                    ['day' => 6, 'title' => 'Serengeti to Ngorongoro', 'description' => 'Drive to Ngorongoro rim with crater views.'],
                    ['day' => 7, 'title' => 'Ngorongoro Crater', 'description' => 'Full day crater tour with wildlife viewing.'],
                    ['day' => 8, 'title' => 'Ngorongoro to Arusha', 'description' => 'Return to Arusha with airport drop-off.'],
                ],
                'inclusions' => ['Guide', 'Vehicle', 'Park fees', 'Mid-range accommodation', 'Meals'],
                'exclusions' => ['Flights', 'Visa', 'Drinks', 'Tips'],
            ],
            [
                'title' => '1-Day Lake Manyara National Park Safari Trip',
                'summary' => 'A quick but intense day trip to the home of tree-climbing lions and massive flamingo flocks.',
                'price' => 240,
                'days' => 1,
                'image' => 'images/images/A-guide-to-the-Lobo-Area-in-the-Northern-Serengeti.jpg',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Lake Manyara Day Trip', 'description' => 'Early morning pick-up from Arusha. Full day game drive in Lake Manyara National Park. Famous for tree-climbing lions, elephants, and flamingos. Picnic lunch included. Return to Arusha in evening.'],
                ],
                'inclusions' => ['Guide', 'Vehicle', 'Park fees', 'Lunch', 'Water'],
                'exclusions' => ['Flights', 'Visa', 'Drinks', 'Tips'],
            ],
            [
                'title' => '10-Day Wildebeest Migration Safari with Culture & Acidic Lakes',
                'summary' => 'Beyond the animals: experience the culture of the Hadzabe and the unique scenery of Lake Natron.',
                'price' => 3655,
                'days' => 10,
                'image' => 'images/images/tanzania-migratie-600x407.jpg',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Arusha to Lake Natron', 'description' => 'Drive to Lake Natron. Flamingo viewing and beautiful scenery.'],
                    ['day' => 2, 'title' => 'Lake Natron to Serengeti', 'description' => 'Drive to Northern Serengeti via Loliondo. Game viewing.'],
                    ['day' => 3, 'title' => 'Northern Serengeti', 'description' => 'Full day Mara River area, witnessing migration crossings.'],
                    ['day' => 4, 'title' => 'Northern Serengeti', 'description' => 'Another day exploring migration corridors.'],
                    ['day' => 5, 'title' => 'Northern to Central Serengeti', 'description' => 'Drive south with game viewing en route.'],
                    ['day' => 6, 'title' => 'Central Serengeti', 'description' => 'Full day game drives in Central Serengeti.'],
                    ['day' => 7, 'title' => 'Serengeti to Ngorongoro', 'description' => 'Drive to Ngorongoro with optional Olduvai Gorge visit.'],
                    ['day' => 8, 'title' => 'Ngorongoro Crater', 'description' => 'Full day crater tour with diverse wildlife.'],
                    ['day' => 9, 'title' => 'Hadzabe Culture Visit', 'description' => 'Visit Lake Eyasi to meet the Hadzabe bushmen and learn their traditional ways.'],
                    ['day' => 10, 'title' => 'Return to Arusha', 'description' => 'Drive back to Arusha with airport transfer.'],
                ],
                'inclusions' => ['Guide', 'Vehicle', 'Park fees', 'Accommodation', 'Meals', 'Cultural visits'],
                'exclusions' => ['Flights', 'Visa', 'Drinks', 'Tips'],
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
