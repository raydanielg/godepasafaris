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
                'content' => 'The Serengeti National Park is home to the most famous wildlife spectacle on earth: the Great Wildebeest Migration. Every year, over 1.5 million wildebeest, 200,000 zebras, and 300,000 Thomson\'s gazelles trek across the vast plains in search of fresh grazing land.\n\n### The Rhythm of the Migration\nThe migration is a year-round cycle driven by the rains. Understanding this rhythm is key to planning your safari. From the calving season in the south to the dramatic river crossings in the north, each phase offers something unique.\n\n### When to Go for River Crossings\n- **July to September:** This is the peak time to witness the dramatic Mara River crossings in the Northern Serengeti. This is where you see the life-and-death struggle as herds face giant Nile crocodiles.\n- **October:** The herds begin moving back south through the Lobo area, offering excellent predator sightings.\n\n### The Calving Season (Ndutu)\n- **January to March:** The herds congregate in the Southern Serengeti and Ngorongoro Conservation Area. Over 8,000 calves are born every single day, attracting an incredible number of predators like lions, cheetahs, and hyenas.\n\n### What to Expect on Your Safari\nExpect raw nature at its finest. You will see predator-prey interactions, vast golden savannas, and an incredible diversity of birdlife. Our expert guides at Go Deep Africa Safari ensure you are at the right place at the right time.\n\n### Essential Safari Gear\n1. High-quality binoculars\n2. A camera with a good zoom lens (at least 300mm)\n3. Neutral-colored clothing\n4. A wide-brimmed hat and sunscreen',
                'category' => 'Safari',
                'image' => 'images/images/3-Days-Serengeti-Balloon-Safaris.webp',
            ],
            [
                'title' => 'Conquering Kilimanjaro: Machame vs Lemosho Route',
                'summary' => 'Choosing the right route is crucial for your summit success. We break down the two most popular paths.',
                'content' => 'Mount Kilimanjaro, the "Roof of Africa," stands at 5,895 meters. Climbing it is a physical and mental challenge that requires the right preparation and route choice. At Go Deep Africa Safari, we specialize in high-altitude expeditions with an emphasis on safety and success.\n\n### The Machame Route (Whiskey Route)\nKnown for its beautiful scenery but also its steep climbs. It offers great "climb high, sleep low" opportunities which help with acclimatization. It usually takes 6 to 7 days. The Barranco Wall is a highlight of this route, offering a fun scramble with rewarding views.\n\n### The Lemosho Route\nLonger and more remote, Lemosho is widely considered the most beautiful route. Its longer duration (7-8 days) provides an excellent acclimatization profile, leading to higher summit success rates. It starts in the lush rainforest on the western side and crosses the Shira Plateau.\n\n### Why Climb with Us?\n- **Certified Guides:** Our lead guides are certified in Wilderness First Responder (WFR).\n- **High-Quality Gear:** We provide North Face tents and specialized sleeping mats.\n- **Nutrition:** Our mountain chefs prepare fresh, high-energy meals to keep you fueled.\n\n### Training for the Peak\nSuccess on Kilimanjaro is 70% mental and 30% physical. However, physical preparation cannot be ignored. Focus on long hikes with a weighted pack, cardiovascular endurance, and leg strength.',
                'category' => 'Trekking',
                'image' => 'images/images/4-Kilimanjaro-Jane-at-summit-SC_JW.jpg',
            ],
            [
                'title' => 'Zanzibar: More Than Just White Sand Beaches',
                'summary' => 'Discover the rich history of Stone Town and the aromatic spice plantations of the Spice Island.',
                'content' => 'While Zanzibar is famous for its turquoise waters and powdery white sand, there is a deep Swahili cultural history waiting to be explored. After a dusty safari, there is no better place to unwind than the shores of the Indian Ocean.\n\n### Stone Town: A Step Back in Time\nA UNESCO World Heritage site, Stone Town is a labyrinth of narrow alleys, historic buildings, and bustling markets. Visit the House of Wonders, the Old Fort, and the Freddie Mercury Museum. The evening Forodhani Gardens food market is a must for tasting local seafood and Zanzibar pizza.\n\n### The Spice Island Heritage\nTanzania is known as the "Spice Island" for a reason. A spice tour allows you to see, smell, and taste fresh cloves, nutmeg, cinnamon, and vanilla directly from the source. It\'s a sensory journey through the plantations that once drove the island\'s economy.\n\n### Pristine Beaches and Snorkeling\n- **Nungwi & Kendwa:** Located in the north, these beaches are famous for having the least tidal movement, allowing for swimming all day long.\n- **Mnemba Atoll:** One of the best snorkeling spots in East Africa, with crystal clear waters and vibrant coral reefs.\n- **Paje:** The hub for kite surfing and a more relaxed, bohemian vibe.\n\n### Practical Travel Tips\nZanzibar is a predominantly Muslim island. When in Stone Town or local villages, it is respectful to dress modestly (covering shoulders and knees). On the beaches and in resorts, standard swimwear is perfectly fine.',
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
