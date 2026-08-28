<?php

namespace Database\Seeders;

use App\Models\CulturalExperience;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Seeds Tanzania Mainland's most popular cultural tourism experiences.
 * Idempotent (keyed on slug). Admins manage everything afterwards.
 */
class CulturalSeeder extends Seeder
{
    public function run(): void
    {
        $order = 0;

        foreach ($this->experiences() as $data) {
            $reviews = $data['reviews'] ?? [];
            unset($data['reviews']);

            $data['slug'] = Str::slug($data['name']);
            $data['display_order'] = ++$order;
            $data['is_active'] = true;

            $exp = CulturalExperience::firstOrCreate(['slug' => $data['slug']], $data);

            // Reviews are deliberately NOT seeded. These previously created
            // invented reviewers ("Sophie M.", "David R." …) pre-approved for
            // display, and cultural/show fed them to Google as an
            // aggregateRating — fabricated ratings in structured data breach
            // Google's review policy and risk a manual action, quite apart from
            // publishing invented customer feedback. Real reviews only.
            unset($reviews);

            // Break the activity list into individually editable activity records.
            $lines = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $data['activities'] ?? ''))));
            foreach ($lines as $i => $line) {
                $exp->activityItems()->firstOrCreate(
                    ['name' => $line],
                    ['icon' => 'fa-circle-check', 'display_order' => $i + 1],
                );
            }
        }
    }

    private function experiences(): array
    {
        return [
            [
                'name' => 'Maasai Cultural Experience',
                'region' => 'Arusha · Longido · Ngorongoro',
                'tribe' => 'Maasai',
                'icon' => 'fa-people-group',
                'tagline' => 'Meet East Africa\'s most iconic warrior-herders.',
                'duration' => 'Half day – Full day',
                'best_time' => 'All year',
                'price' => 45,
                'is_featured' => true,
                'description' => 'Spend time in an authentic Maasai boma and discover a semi-nomadic way of life that has endured for centuries. Learn about cattle-herding traditions, the role of warriors (morans), and the community\'s deep knowledge of the land, while your hosts share their music, dress and daily rituals.',
                'highlights' => "Authentic boma (homestead) visit\nAdumu \"jumping\" warrior dance\nHandmade Maasai beadwork\nMaasai medicinal plant walk",
                'activities' => "Traditional dances\nVillage visits (Boma tours)\nBeadwork workshops\nTraditional food experiences",
                'reviews' => [
                    ['name' => 'Sophie M.', 'location' => 'France', 'rating' => 5, 'comment' => 'Unforgettable — the warriors welcomed us like family and the dancing was incredible.'],
                    ['name' => 'David R.', 'location' => 'USA', 'rating' => 5, 'comment' => 'A genuine, respectful cultural exchange. The beadwork workshop was a highlight for my kids.'],
                ],
            ],
            [
                'name' => 'Hadzabe Bushmen Experience',
                'region' => 'Lake Eyasi',
                'tribe' => 'Hadzabe',
                'icon' => 'fa-bow-arrow',
                'tagline' => 'Join one of the world\'s last true hunter-gatherer tribes.',
                'duration' => 'Half day (early morning)',
                'best_time' => 'June – February',
                'price' => 55,
                'is_featured' => true,
                'description' => 'The Hadzabe are among the last hunter-gatherer peoples on earth, living around Lake Eyasi much as their ancestors did. Set out at dawn with the hunters, learn to make fire by hand, and experience a culture with no calendars, chiefs or possessions — only an extraordinary bond with the bush.',
                'highlights' => "Dawn hunt with the tribe\nFire-making by hand\nBow-and-arrow craft\nClick-language interaction",
                'activities' => "Hunting excursions\nTraditional survival techniques\nStorytelling sessions\nCultural interaction programs",
                'reviews' => [
                    ['name' => 'Lukas B.', 'location' => 'Germany', 'rating' => 5, 'comment' => 'The most authentic experience of our whole safari. Humbling and fascinating.'],
                ],
            ],
            [
                'name' => 'Datoga Cultural Experience',
                'region' => 'Lake Eyasi',
                'tribe' => 'Datoga',
                'icon' => 'fa-hammer',
                'tagline' => 'Master blacksmiths and pastoralists of the Rift Valley.',
                'duration' => 'Half day',
                'best_time' => 'June – February',
                'price' => 40,
                'description' => 'Neighbours of the Hadzabe, the Datoga are skilled pastoralists and renowned blacksmiths who forge arrowheads, jewellery and tools from scrap metal using traditional bellows. Visit a homestead to see their craftsmanship and learn about their proud, self-reliant culture.',
                'highlights' => "Live blacksmith demonstration\nHandcrafted brass jewellery\nTraditional homestead visit",
                'activities' => "Blacksmith demonstrations\nTraditional craftsmanship\nLocal community visits",
                'reviews' => [
                    ['name' => 'Elena P.', 'location' => 'Italy', 'rating' => 5, 'comment' => 'Watching them forge arrowheads by hand was amazing. Beautiful jewellery too.'],
                ],
            ],
            [
                'name' => 'Chagga Cultural Tour',
                'region' => 'Mount Kilimanjaro Region',
                'tribe' => 'Chagga',
                'icon' => 'fa-mug-hot',
                'tagline' => 'Coffee, caves and mountain traditions on Kilimanjaro\'s slopes.',
                'duration' => 'Half day – Full day',
                'best_time' => 'All year',
                'price' => 50,
                'is_featured' => true,
                'description' => 'The Chagga people farm the fertile southern slopes of Kilimanjaro and are famous for their coffee, ingenuity and underground defence caves dug generations ago. Tour a family coffee plantation from bean to cup, explore the historic Chagga caves, and taste home-brewed banana beer.',
                'highlights' => "Historic Chagga defence caves\nBean-to-cup coffee tour\nBanana beer tasting\nLush Kilimanjaro foothills",
                'activities' => "Chagga caves\nCoffee plantation tours\nTraditional banana beer making\nLocal food experiences",
                'reviews' => [
                    ['name' => 'Grace W.', 'location' => 'UK', 'rating' => 5, 'comment' => 'Roasting our own coffee and exploring the caves was such a fun, tasty day out.'],
                ],
            ],
            [
                'name' => 'Iraqw Cultural Experience',
                'region' => 'Karatu',
                'tribe' => 'Iraqw',
                'icon' => 'fa-wheat-awn',
                'tagline' => 'Farmers of the highlands near Ngorongoro.',
                'duration' => 'Half day',
                'best_time' => 'All year',
                'price' => 35,
                'description' => 'The Iraqw people of the Karatu highlands are industrious farmers with distinctive architecture and customs. Walk through green villages between Lake Manyara and Ngorongoro, join everyday farming life, and enjoy traditional dances and warm hospitality.',
                'highlights' => "Highland village walk\nHands-on farming activities\nTraditional Iraqw dance",
                'activities' => "Traditional farming activities\nCultural dances\nLocal village tours",
                'reviews' => [
                    ['name' => 'Marco T.', 'location' => 'Switzerland', 'rating' => 4, 'comment' => 'A relaxed, genuine village visit on the way to the Serengeti. Lovely people.'],
                ],
            ],
            [
                'name' => 'Sukuma Cultural Experience',
                'region' => 'Mwanza · Shinyanga',
                'tribe' => 'Sukuma',
                'icon' => 'fa-drum',
                'tagline' => 'Tanzania\'s largest tribe — drums, dance and the famous snake dance.',
                'duration' => 'Half day',
                'best_time' => 'All year',
                'price' => 40,
                'description' => 'Around Lake Victoria live the Sukuma, Tanzania\'s largest ethnic group, celebrated for energetic drumming and the spectacular Bugobogobo snake dance. Visit the Sukuma Museum near Mwanza and witness ceremonies bursting with rhythm, colour and storytelling.',
                'highlights' => "Bugobogobo snake dance\nThunderous traditional drumming\nSukuma living museum",
                'activities' => "Bugobogobo snake dance\nTraditional drumming performances\nLocal ceremonies and storytelling",
                'reviews' => [
                    ['name' => 'Anna K.', 'location' => 'Netherlands', 'rating' => 5, 'comment' => 'The snake dance and drumming were mesmerising. A side of Tanzania few tourists see.'],
                ],
            ],
            [
                'name' => 'Makonde Cultural Experience',
                'region' => 'Southern Tanzania',
                'tribe' => 'Makonde',
                'icon' => 'fa-hand-fist',
                'tagline' => 'World-renowned wood carvers of the south.',
                'duration' => 'Half day',
                'best_time' => 'All year',
                'price' => 40,
                'description' => 'The Makonde are internationally famous for their intricate ebony sculpture, including the flowing "Ujamaa" tree-of-life carvings. Meet master carvers, try your hand at the craft, and explore a rich artistic tradition rooted in myth and community.',
                'highlights' => "Master ebony carvers\nHands-on carving workshop\nUjamaa \"tree of life\" art",
                'activities' => "Wood carving workshops\nTraditional arts and crafts\nCultural exhibitions",
                'reviews' => [
                    ['name' => 'James O.', 'location' => 'Canada', 'rating' => 5, 'comment' => 'Bought a carving straight from the artist. Incredible skill and warm hospitality.'],
                ],
            ],
            [
                'name' => 'Bagamoyo Historical and Cultural Tour',
                'region' => 'Bagamoyo (Coast)',
                'tribe' => 'Swahili Coast',
                'icon' => 'fa-landmark-dome',
                'tagline' => 'Swahili heritage and a poignant slave-trade history.',
                'duration' => 'Full day',
                'best_time' => 'June – February',
                'price' => 45,
                'description' => 'Once a key port of the East African slave and ivory trade and the former capital of German East Africa, Bagamoyo is a UNESCO-tentative town layered with history. Walk its old streets and caravan sites, visit the arts college, and soak up centuries of Swahili culture on the Indian Ocean.',
                'highlights' => "Historic slave-trade sites\nBagamoyo arts college\nSwahili old town & Kaole ruins",
                'activities' => "Historic slave trade sites\nTraditional arts centers\nSwahili cultural experiences",
                'reviews' => [
                    ['name' => 'Fatima S.', 'location' => 'UAE', 'rating' => 5, 'comment' => 'Moving and educational. A meaningful stop that pairs perfectly with Zanzibar.'],
                ],
            ],
        ];
    }
}
