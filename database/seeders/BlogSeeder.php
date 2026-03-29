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
                'content' => '
<p>The Serengeti National Park is home to the most famous wildlife spectacle on earth: the Great Wildebeest Migration. Every year, over 1.5 million wildebeest, 200,000 zebras, and 300,000 Thomson\'s gazelles trek across the vast plains in search of fresh grazing land.</p>

<h3>The Rhythm of the Migration</h3>
<p>The migration is a year-round cycle driven by the rains. Understanding this rhythm is key to planning your safari. From the calving season in the south to the dramatic river crossings in the north, each phase offers something unique.</p>

<h3>When to Go for River Crossings</h3>
<ul>
    <li><strong>July to September:</strong> This is the peak time to witness the dramatic Mara River crossings in the Northern Serengeti. This is where you see the life-and-death struggle as herds face giant Nile crocodiles.</li>
    <li><strong>October:</strong> The herds begin moving back south through the Lobo area, offering excellent predator sightings.</li>
</ul>

<h3>The Calving Season (Ndutu)</h3>
<ul>
    <li><strong>January to March:</strong> The herds congregate in the Southern Serengeti and Ngorongoro Conservation Area. Over 8,000 calves are born every single day, attracting an incredible number of predators like lions, cheetahs, and hyenas.</li>
</ul>

<h3>What to Expect on Your Safari</h3>
<p>Expect raw nature at its finest. You will see predator-prey interactions, vast golden savannas, and an incredible diversity of birdlife. Our expert guides at Go Deep Africa Safari ensure you are at the right place at the right time.</p>

<h3>Essential Safari Gear</h3>
<ol>
    <li>High-quality binoculars</li>
    <li>A camera with a good zoom lens (at least 300mm)</li>
    <li>Neutral-colored clothing</li>
    <li>A wide-brimmed hat and sunscreen</li>
</ol>',
                'category' => 'Safari',
                'image' => 'images/images/3-Days-Serengeti-Balloon-Safaris.webp',
            ],
            [
                'title' => 'Conquering Kilimanjaro: Machame vs Lemosho Route',
                'summary' => 'Choosing the right route is crucial for your summit success. We break down the two most popular paths.',
                'content' => '
<p>Mount Kilimanjaro, the "Roof of Africa," stands at 5,895 meters. Climbing it is a physical and mental challenge that requires the right preparation and route choice. At Go Deep Africa Safari, we specialize in high-altitude expeditions with an emphasis on safety and success.</p>

<h3>The Machame Route (Whiskey Route)</h3>
<p>Known for its beautiful scenery but also its steep climbs. It offers great "climb high, sleep low" opportunities which help with acclimatization. It usually takes 6 to 7 days. The Barranco Wall is a highlight of this route, offering a fun scramble with rewarding views.</p>

<h3>The Lemosho Route</h3>
<p>Longer and more remote, Lemosho is widely considered the most beautiful route. Its longer duration (7-8 days) provides an excellent acclimatization profile, leading to higher summit success rates. It starts in the lush rainforest on the western side and crosses the Shira Plateau.</p>

<h3>Why Climb with Us?</h3>
<ul>
    <li><strong>Certified Guides:</strong> Our lead guides are certified in Wilderness First Responder (WFR).</li>
    <li><strong>High-Quality Gear:</strong> We provide North Face tents and specialized sleeping mats.</li>
    <li><strong>Nutrition:</strong> Our mountain chefs prepare fresh, high-energy meals to keep you fueled.</li>
</ul>

<h3>Training for the Peak</h3>
<p>Success on Kilimanjaro is 70% mental and 30% physical. However, physical preparation cannot be ignored. Focus on long hikes with a weighted pack, cardiovascular endurance, and leg strength.</p>',
                'category' => 'Trekking',
                'image' => 'images/images/4-Kilimanjaro-Jane-at-summit-SC_JW.jpg',
            ],
            [
                'title' => 'Zanzibar: More Than Just White Sand Beaches',
                'summary' => 'Discover the rich history of Stone Town and the aromatic spice plantations of the Spice Island.',
                'content' => '
<p>While Zanzibar is famous for its turquoise waters and powdery white sand, there is a deep Swahili cultural history waiting to be explored. After a dusty safari, there is no better place to unwind than the shores of the Indian Ocean.</p>

<h3>Stone Town: A Step Back in Time</h3>
<p>A UNESCO World Heritage site, Stone Town is a labyrinth of narrow alleys, historic buildings, and bustling markets. Visit the House of Wonders, the Old Fort, and the Freddie Mercury Museum. The evening Forodhani Gardens food market is a must for tasting local seafood and Zanzibar pizza.</p>

<h3>The Spice Island Heritage</h3>
<p>Tanzania is known as the "Spice Island" for a reason. A spice tour allows you to see, smell, and taste fresh cloves, nutmeg, cinnamon, and vanilla directly from the source. It\'s a sensory journey through the plantations that once drove the island\'s economy.</p>

<h3>Pristine Beaches and Snorkeling</h3>
<ul>
    <li><strong>Nungwi & Kendwa:</strong> Located in the north, these beaches are famous for having the least tidal movement, allowing for swimming all day long.</li>
    <li><strong>Mnemba Atoll:</strong> One of the best snorkeling spots in East Africa, with crystal clear waters and vibrant coral reefs.</li>
    <li><strong>Paje:</strong> The hub for kite surfing and a more relaxed, bohemian vibe.</li>
</ul>

<h3>Practical Travel Tips</h3>
<p>Zanzibar is a predominantly Muslim island. When in Stone Town or local villages, it is respectful to dress modestly (covering shoulders and knees). On the beaches and in resorts, standard swimwear is perfectly fine.</p>',
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
