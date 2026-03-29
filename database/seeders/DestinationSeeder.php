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
                'title' => 'Arusha',
                'category' => 'Towns and Cities',
                'description' => 'Arusha city is located in the northern part of the country. The city is well known as the country\'s main safari hub.',
                'rich_content' => '<p>Arusha city is located in the northern part of the country. The city is well known as the country\'s main safari hub. It is a starting point for the very popular northern safaris, Serengeti national park, Ngorongoro conservation area, Lake Manyara, and the Tarangire. Arusha has a great view of the highest second Mountain in Tanzania, Meru as well as the famous Kilimanjaro all standing above the city.</p>

<blockquote><strong>Did you know?</strong> Arusha is located halfway between Cape Town and Cairo.</blockquote>

<p>When in Arusha, you will find an intriguing blend of cultures, such as Swahili, Indians, Europeans, Americans, and local native peoples like the Waarusha, Wameru, and Maasai. The presence of museums and historic sites within the city allows you to explore almost endlessly.</p>

<h3 class="mt-5 mb-4">Things to do in Arusha</h3>
<p>If you are visiting Tanzania for your vacation it is highly likely you will stay a day or two in Arusha, which is the safari hub for the popular northern Tanzania parks. So you will surely be interested in things you can do while you wait or return from your safari:</p>

<ul class="list-unstyled custom-list">
    <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Cultural Heritage Centre:</strong> The place to see Tanzanian culture through art and artifacts. Beautiful exhibits tell the past and present stories of Tanzania and its people.</li>
    <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Masai Market:</strong> Very popular among tourists visiting Arusha, in this market, you can go shopping for local crafts. Be prepared to bargain!</li>
    <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Clock Tower:</strong> Located in the center of Arusha. It also marks the midway from cape town to Cairo.</li>
    <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Kahawa Coffee Tour:</strong> Tanzanian coffee is famous around the world for its rich flavors. Visit a plantation where you’ll have the chance to roast and grind your beans.</li>
    <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Meserani Snake Park:</strong> Feed baboons, hold wild tortoises and get up close with dozens of slithering snakes.</li>
    <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Shanga:</strong> A heart-warming project dedicated to supporting and empowering community members with disabilities.</li>
    <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Hiking to Meru Waterfalls:</strong> These falls are just outside of the city, the adventurous path makes this journey interesting.</li>
</ul>',
                'weather_info' => 'Arusha has a pleasant climate with moderate temperatures. The long rains are from March to May and short rains in November and December.',
                'faqs' => [
                    ['question' => 'How do I get to Arusha?', 'answer' => 'For international travelers we recommend you fly to Kilimanjaro airport (JRO) from there you can take a taxi to Arusha.'],
                    ['question' => 'Is Arusha safe?', 'answer' => 'Arusha city is generally safe for tourists, but like any city, it is where you should stay aware of your surroundings.'],
                ],
                'image' => 'images/images/360_F_1780607212_D459lFUNqKD0ziQZYUv7SCKFSeHTvpsl.jpg',
                'rate_range' => '$2370 to $3240',
                'best_time' => 'It is a year-round touring destination',
                'high_season' => 'July to August'
            ],
            [
                'title' => 'Zanzibar',
                'category' => 'Beach & Islands Ext',
                'description' => 'Zanzibar is a Tanzanian archipelago, located on the eastern coast of Tanzania.',
                'rich_content' => 'Zanzibar is famous for its spices and the slave trade of the 19th century. It is much more than a stopping point on an itinerary and can be seen as a destination in its own right.',
                'weather_info' => 'Zanzibar has a tropical climate. Hot and humid all year round.',
                'faqs' => [
                    ['question' => 'Is it expensive?', 'answer' => 'Zanzibar can be enjoyed on any budget.'],
                ],
                'image' => 'images/images/635ZANZIBAR_ISLAND.webp',
                'rate_range' => '$120 to $2820',
                'best_time' => 'June to October',
                'high_season' => 'July to October'
            ],
        ];

        foreach ($destinations as $dest) {
            \App\Models\Destination::create([
                'title' => $dest['title'],
                'slug' => \Illuminate\Support\Str::slug($dest['title']),
                'category' => $dest['category'],
                'description' => $dest['description'],
                'rich_content' => $dest['rich_content'] ?? null,
                'weather_info' => $dest['weather_info'] ?? null,
                'faqs' => $dest['faqs'] ?? null,
                'image' => $dest['image'],
                'rate_range' => $dest['rate_range'],
                'best_time' => $dest['best_time'],
                'high_season' => $dest['high_season'],
            ]);
        }
    }
}
