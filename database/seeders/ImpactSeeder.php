<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImpactStat;
use App\Models\ImpactStory;
use App\Models\ImpactGallery;
use App\Models\ImpactTimeline;
use App\Models\ImpactPartner;

class ImpactSeeder extends Seeder
{
    public function run(): void
    {
        // Impact Stats
        $stats = [
            [
                'icon' => 'fa-hands-helping',
                'label' => 'People Helped',
                'value' => 12500,
                'suffix' => '+',
                'display_order' => 1,
            ],
            [
                'icon' => 'fa-graduation-cap',
                'label' => 'Children Educated',
                'value' => 3200,
                'suffix' => '+',
                'display_order' => 2,
            ],
            [
                'icon' => 'fa-female',
                'label' => 'Women Empowered',
                'value' => 850,
                'suffix' => '+',
                'display_order' => 3,
            ],
            [
                'icon' => 'fa-home',
                'label' => 'Community Projects',
                'value' => 45,
                'suffix' => '',
                'display_order' => 4,
            ],
        ];

        foreach ($stats as $stat) {
            ImpactStat::create($stat);
        }

        // Impact Stories
        $stories = [
            [
                'name' => 'Neema',
                'location' => 'Arusha, Tanzania',
                'badge' => 'Success Story',
                'title' => 'Neema\'s Journey to Education',
                'quote' => 'Thanks to Go Deep Africa Safari, I received school supplies and now I\'m top of my class. I want to become a doctor and help my community.',
                'image' => 'https://images.unsplash.com/photo-1503919545889-aef636e10ad4?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'category' => 'orphan',
                'display_order' => 1,
                'is_featured' => true,
            ],
            [
                'name' => 'Maria',
                'location' => 'Moshi, Tanzania',
                'badge' => 'Women Empowerment',
                'title' => 'Maria\'s Business Success',
                'quote' => 'The micro-loan and training I received helped me start my tailoring business. Now I employ 3 other women and support my children\'s education.',
                'image' => 'https://images.unsplash.com/photo-1525896650794-60ad4ec40d0e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'category' => 'women',
                'display_order' => 2,
                'is_featured' => true,
            ],
            [
                'name' => 'Juma',
                'location' => 'Dar es Salaam, Tanzania',
                'badge' => 'Rehabilitation',
                'title' => 'Juma\'s New Beginning',
                'quote' => 'From living on the streets to becoming a skilled carpenter. The rehabilitation center gave me hope and a future I never thought possible.',
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'category' => 'rehabilitation',
                'display_order' => 3,
                'is_featured' => true,
            ],
        ];

        foreach ($stories as $story) {
            ImpactStory::create($story);
        }

        // Impact Gallery
        $gallery = [
            [
                'title' => 'Education Support',
                'subtitle' => 'Providing books and supplies to underprivileged children',
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'location' => 'Arusha, Tanzania',
                'category' => 'education',
                'column_width' => 4,
                'display_order' => 1,
            ],
            [
                'title' => 'Children\'s Home Visit',
                'subtitle' => 'Bringing joy and necessities to orphanages',
                'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'location' => 'Moshi, Tanzania',
                'category' => 'orphanage',
                'column_width' => 4,
                'display_order' => 2,
            ],
            [
                'title' => 'Women\'s Cooperative',
                'subtitle' => 'Empowering women through skills training',
                'image' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'location' => 'Karatu, Tanzania',
                'category' => 'women',
                'column_width' => 4,
                'display_order' => 3,
            ],
            [
                'title' => 'School Supplies Distribution',
                'subtitle' => '500+ students received books and supplies',
                'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'location' => 'Various Locations',
                'category' => 'education',
                'column_width' => 6,
                'display_order' => 4,
            ],
            [
                'title' => 'Annual Community Day',
                'subtitle' => 'Bringing joy to over 1,000 children',
                'image' => 'https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'location' => 'Arusha, Tanzania',
                'category' => 'community',
                'column_width' => 6,
                'display_order' => 5,
            ],
        ];

        foreach ($gallery as $item) {
            ImpactGallery::create($item);
        }

        // Impact Timeline
        $timeline = [
            [
                'year' => '2018',
                'title' => 'Foundation Established',
                'description' => 'Started with a vision to give back to our community. First partnership with 3 orphanages in Arusha.',
                'icon' => 'fa-flag',
                'display_order' => 1,
            ],
            [
                'year' => '2020',
                'title' => 'Women\'s Empowerment Program',
                'description' => 'Launched micro-finance initiative supporting 100+ women entrepreneurs in rural Tanzania.',
                'icon' => 'fa-female',
                'display_order' => 2,
            ],
            [
                'year' => '2022',
                'title' => 'Street Children Rehabilitation',
                'description' => 'Partnered with 5 rehabilitation centers, providing education and vocational training to 200+ street children.',
                'icon' => 'fa-hands-helping',
                'display_order' => 3,
            ],
            [
                'year' => '2024',
                'title' => '10,000 Lives Touched',
                'description' => 'Milestone achievement: Over 10,000 people helped through our various programs across Tanzania.',
                'icon' => 'fa-heart',
                'display_order' => 4,
            ],
        ];

        foreach ($timeline as $event) {
            ImpactTimeline::create($event);
        }

        // Impact Partners
        $partners = [
            [
                'name' => 'Arusha Orphanage Center',
                'icon' => 'fa-hands-helping',
                'description' => 'Providing care and education to orphaned children in Arusha region.',
                'display_order' => 1,
            ],
            [
                'name' => 'Tanzania Women\'s Alliance',
                'icon' => 'fa-female',
                'description' => 'Empowering women through skills training and micro-finance.',
                'display_order' => 2,
            ],
            [
                'name' => 'Street Kids Rehabilitation',
                'icon' => 'fa-child',
                'description' => 'Rehabilitation and vocational training for street children.',
                'display_order' => 3,
            ],
            [
                'name' => 'Education for All Initiative',
                'icon' => 'fa-graduation-cap',
                'description' => 'Ensuring every child has access to quality education.',
                'display_order' => 4,
            ],
        ];

        foreach ($partners as $partner) {
            ImpactPartner::create($partner);
        }
    }
}
