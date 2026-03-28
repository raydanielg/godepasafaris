<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Serengeti: The Ultimate Guide to the Great Migration',
                'summary' => 'Experience the world\'s most spectacular wildlife event. Learn when and where to witness the river crossings.',
                'content' => 'The Serengeti National Park is home to the most famous wildlife spectacle on earth: the Great Wildebeest Migration. Every year, over 1.5 million wildebeest, 200,000 zebras, and 300,000 Thomson\'s gazelles trek across the vast plains in search of fresh grazing land.\n\n### When to Go\n- **July to September:** This is the peak time to witness the dramatic Mara River crossings in the Northern Serengeti.\n- **January to March:** The calving season in the Southern Serengeti (Ndutu) where thousands of calves are born daily.\n\n### What to Expect\nExpect raw nature at its finest. You will see predator-prey interactions, vast golden savannas, and an incredible diversity of birdlife. Our expert guides at Go Deep Africa Safari ensure you are at the right place at the right time.',
                'category' => 'Safari',
                'image' => 'images/images/3-Days-Serengeti-Balloon-Safaris.webp',
            ],
            [
                'title' => 'Conquering Kilimanjaro: Machame vs Lemosho Route',
                'summary' => 'Choosing the right route is crucial for your summit success. We break down the two most popular paths.',
                'content' => 'Mount Kilimanjaro, the "Roof of Africa," stands at 5,895 meters. Climbing it is a physical and mental challenge that requires the right preparation and route choice.\n\n### The Machame Route (Whiskey Route)\nKnown for its beautiful scenery but also its steep climbs. It offers great "climb high, sleep low" opportunities which help with acclimatization.\n\n### The Lemosho Route\nLonger and more remote, Lemosho is widely considered the most beautiful route. Its longer duration (7-8 days) provides an excellent acclimatization profile, leading to higher summit success rates.\n\n### Training Tips\n- Focus on cardiovascular endurance.\n- Hike in your summit boots to break them in.\n- Stay hydrated and maintain a positive mindset.',
                'category' => 'Trekking',
                'image' => 'images/images/4-Kilimanjaro-Jane-at-summit-SC_JW.jpg',
            ],
            [
                'title' => 'Zanzibar: More Than Just White Sand Beaches',
                'summary' => 'Discover the rich history of Stone Town and the aromatic spice plantations of the Spice Island.',
                'content' => 'While Zanzibar is famous for its turquoise waters and powdery white sand, there is a deep cultural history waiting to be explored.\n\n### Stone Town\nA UNESCO World Heritage site, Stone Town is a labyrinth of narrow alleys, historic buildings, and bustling markets. Visit the House of Wonders and the Old Fort to truly understand the island\'s Omani and Swahili heritage.\n\n### Spice Tours\nTanzania is known as the "Spice Island" for a reason. A spice tour allows you to see, smell, and taste fresh cloves, nutmeg, cinnamon, and vanilla directly from the source.\n\n### Relaxing in Nungwi\nAfter your adventures, head north to Nungwi for the best sunsets and a vibrant beach atmosphere.',
                'category' => 'Culture',
                'image' => 'images/images/635ZANZIBAR_ISLAND.webp',
            ],
        ];

        foreach ($posts as $post) {
            $createdPost = Post::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'summary' => $post['summary'],
                'content' => $post['content'],
                'category' => $post['category'],
                'image' => $post['image'],
            ]);

            // Add some sample comments
            $createdPost->comments()->create([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'rating' => 5,
                'comment' => 'This guide helped me plan my trip perfectly! Can\'t wait to visit the Serengeti.',
            ]);
        }
    }
}
