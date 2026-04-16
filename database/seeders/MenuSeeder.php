<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuSection;
use App\Models\MenuLink;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Safari Mega Menu
        $safariSection = MenuSection::firstOrCreate(
            ['nav_item' => 'safari', 'title' => 'Tanzania Safari Guide'],
            [
                'description' => 'Discover the best wildlife experiences in Tanzania. From the Serengeti Great Migration to Ngorongoro Crater, our expert guides will take you on an unforgettable journey through Africa\'s most iconic national parks.',
                'image' => 'https://images.unsplash.com/photo-1516422213484-21db3332906c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'link_url' => '/safari',
                'link_text' => 'Explore All Safaris',
                'badge' => 'New Season',
                'badge_color' => 'success',
                'display_order' => 1,
            ]
        );

        $safariLinks = [
            ['title' => 'Serengeti National Park', 'url' => '/destinations/serengeti', 'icon' => 'fa-paw', 'description' => 'Witness the Great Migration', 'badge' => 'Popular', 'badge_color' => 'danger'],
            ['title' => 'Ngorongoro Crater', 'url' => '/destinations/ngorongoro', 'icon' => 'fa-mountain', 'description' => 'World\'s largest inactive volcano', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'Tarangire National Park', 'url' => '/destinations/tarangire', 'icon' => 'fa-tree', 'description' => 'Home to giant elephants', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'Lake Manyara', 'url' => '/destinations/manyara', 'icon' => 'fa-water', 'description' => 'Tree-climbing lions', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'Selous Game Reserve', 'url' => '/destinations/selous', 'icon' => 'fa-binoculars', 'description' => 'Africa\'s largest game reserve', 'badge' => 'Wild', 'badge_color' => 'warning'],
            ['title' => 'Ruaha National Park', 'url' => '/destinations/ruaha', 'icon' => 'fa-safari', 'description' => 'Untouched wilderness', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'Private Safari Tours', 'url' => '/safari-styles/private', 'icon' => 'fa-user-shield', 'description' => 'Exclusive experiences', 'badge' => 'VIP', 'badge_color' => 'warning'],
            ['title' => 'Group Safari Tours', 'url' => '/safari-styles/budget', 'icon' => 'fa-users', 'description' => 'Join fellow travelers', 'badge' => 'Save 20%', 'badge_color' => 'success'],
        ];

        foreach ($safariLinks as $index => $link) {
            MenuLink::firstOrCreate(
                ['menu_section_id' => $safariSection->id, 'title' => $link['title']],
                array_merge($link, ['display_order' => $index + 1])
            );
        }

        // Kilimanjaro Mega Menu
        $kiliSection = MenuSection::firstOrCreate(
            ['nav_item' => 'kilimanjaro', 'title' => 'Climbing Kilimanjaro Guide - 2026/2027'],
            [
                'description' => 'A comprehensive guide to climbing Kilimanjaro by Go Deep Africa Safari experts. Based on insights from over 8,000 expeditions across all routes, it covers important updates for the 2026 season.',
                'image' => 'https://images.unsplash.com/photo-1627894483216-2138af692e32?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'link_url' => '/kilimanjaro',
            'link_text' => 'Read Our Detailed Guide',
            'badge' => '52 Reasons',
            'badge_color' => 'success',
            'display_order' => 1,
        ]);

        $kiliLinks = [
            ['title' => 'Why We Set the Gold Standard', 'url' => '/kilimanjaro/why-us', 'icon' => 'fa-trophy', 'description' => '52 reasons to choose us', 'badge' => '52 Reasons', 'badge_color' => 'success'],
            ['title' => 'Private Tours and Pricing', 'url' => '/kilimanjaro/pricing', 'icon' => 'fa-tag', 'description' => 'Transparent pricing', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'Group Departures', 'url' => '/kilimanjaro/group', 'icon' => 'fa-users', 'description' => 'Join scheduled climbs', 'badge' => '$100 Deposit', 'badge_color' => 'success'],
            ['title' => 'Kilimanjaro Routes', 'url' => '/kilimanjaro', 'icon' => 'fa-route', 'description' => 'Compare all routes', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'Packing List', 'url' => '/pages/help-center', 'icon' => 'fa-suitcase', 'description' => 'Essential gear guide', 'badge' => 'Free PDF', 'badge_color' => 'danger'],
            ['title' => 'Success Calculator', 'url' => '/kilimanjaro/calculator', 'icon' => 'fa-calculator', 'description' => 'Estimate your success', 'badge' => 'New', 'badge_color' => 'info'],
            ['title' => 'Helpful Articles', 'url' => '/blog?category=kilimanjaro', 'icon' => 'fa-book', 'description' => 'Tips & insights', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'Other Mountains', 'url' => '/kilimanjaro/other-mountains', 'icon' => 'fa-mountain', 'description' => 'Meru, Ol Doinyo Lengai', 'badge' => null, 'badge_color' => 'secondary'],
        ];

        foreach ($kiliLinks as $index => $link) {
            MenuLink::create(array_merge($link, [
                'menu_section_id' => $kiliSection->id,
                'display_order' => $index + 1,
            ]));
        }

        // Impact / Giving Back Mega Menu
        $impactSection = MenuSection::create([
            'nav_item' => 'impact',
            'title' => 'Giving Back to Tanzania',
            'description' => 'Your journey with us directly supports local communities, orphans, and women in need. Every safari makes a difference. Learn how 10% of every booking transforms lives.',
            'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'link_url' => '/impact',
            'link_text' => 'See Our Impact',
            'badge' => '12,500+ Helped',
            'badge_color' => 'success',
            'display_order' => 1,
        ]);

        $impactLinks = [
            ['title' => 'Our Impact Story', 'url' => '/impact', 'icon' => 'fa-heart', 'description' => 'How we give back', 'badge' => 'Read More', 'badge_color' => 'success'],
            ['title' => 'Orphanage Support', 'url' => '/impact?section=orphans', 'icon' => 'fa-child', 'description' => '15+ centers supported', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'Women Empowerment', 'url' => '/impact?section=women', 'icon' => 'fa-female', 'description' => '850+ women trained', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'Street Children', 'url' => '/impact?section=street', 'icon' => 'fa-hands-helping', 'description' => 'Rehabilitation programs', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'Success Stories', 'url' => '/impact?section=stories', 'icon' => 'fa-book-open', 'description' => 'Lives transformed', 'badge' => 'New', 'badge_color' => 'info'],
            ['title' => 'Our Partners', 'url' => '/impact?section=partners', 'icon' => 'fa-handshake', 'description' => 'Collaborating NGOs', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'How It Works', 'url' => '/impact?section=process', 'icon' => 'fa-cogs', 'description' => 'From booking to impact', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'Get Involved', 'url' => '/impact?section=volunteer', 'icon' => 'fa-hand-holding-heart', 'description' => 'Volunteer or donate', 'badge' => 'Join Us', 'badge_color' => 'warning'],
        ];

        foreach ($impactLinks as $index => $link) {
            MenuLink::create(array_merge($link, [
                'menu_section_id' => $impactSection->id,
                'display_order' => $index + 1,
            ]));
        }

        // Destinations Mega Menu
        $destSection = MenuSection::create([
            'nav_item' => 'destinations',
            'title' => 'Explore Tanzania',
            'description' => 'From the endless plains of the Serengeti to the tropical beaches of Zanzibar, discover Tanzania\'s most breathtaking destinations with our expert local guides.',
            'image' => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'link_url' => '/destinations',
            'link_text' => 'View All Destinations',
            'badge' => '15+ Parks',
            'badge_color' => 'info',
            'display_order' => 1,
        ]);

        $destLinks = [
            ['title' => 'Northern Circuit', 'url' => '/destinations?region=north', 'icon' => 'fa-map', 'description' => 'Serengeti, Ngorongoro, Manyara', 'badge' => 'Popular', 'badge_color' => 'danger'],
            ['title' => 'Southern Circuit', 'url' => '/destinations?region=south', 'icon' => 'fa-compass', 'description' => 'Selous, Ruaha, Mikumi', 'badge' => 'Wild', 'badge_color' => 'warning'],
            ['title' => 'Western Circuit', 'url' => '/destinations?region=west', 'icon' => 'fa-leaf', 'description' => 'Gombe, Mahale, Katavi', 'badge' => 'Chimps', 'badge_color' => 'success'],
            ['title' => 'Zanzibar Island', 'url' => '/destinations/zanzibar', 'icon' => 'fa-umbrella-beach', 'description' => 'Beaches & Stone Town', 'badge' => 'Beach', 'badge_color' => 'info'],
            ['title' => 'Mount Kilimanjaro', 'url' => '/kilimanjaro', 'icon' => 'fa-mountain', 'description' => 'Africa\'s highest peak', 'badge' => '5,895m', 'badge_color' => 'primary'],
            ['title' => 'Mount Meru', 'url' => '/destinations/meru', 'icon' => 'fa-hiking', 'description' => 'Kilimanjaro\'s sister', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'Cultural Tours', 'url' => '/safari-styles/cultural', 'icon' => 'fa-users', 'description' => 'Maasai & local tribes', 'badge' => null, 'badge_color' => 'secondary'],
            ['title' => 'Photographic Safaris', 'url' => '/safari-styles/photographic', 'icon' => 'fa-camera', 'description' => 'For photography lovers', 'badge' => 'Best Shots', 'badge_color' => 'info'],
        ];

        foreach ($destLinks as $index => $link) {
            MenuLink::create(array_merge($link, [
                'menu_section_id' => $destSection->id,
                'display_order' => $index + 1,
            ]));
        }
    }
}
