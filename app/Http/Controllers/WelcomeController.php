<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SafariPackage;
use App\Models\KilimanjaroPackage;
use App\Models\Post;

class WelcomeController extends Controller
{
    public function index()
    {
        $packages = SafariPackage::latest()->take(3)->get();
        $posts = Post::latest()->take(3)->get();
        
        // Fetch all tour titles for the inquiry modal
        $safariTours = SafariPackage::select('id', 'title')->get();
        $kiliTours = KilimanjaroPackage::select('id', 'title')->get();
        $allTourOptions = $safariTours->concat($kiliTours);

        return view('welcome', compact('packages', 'posts', 'allTourOptions'));
    }

    public function testimonials()
    {
        // Mock data for testimonials, would normally come from DB
        $testimonials = [
            [
                'name' => 'John Doe',
                'location' => 'USA',
                'content' => 'An amazing experience! The Kilimanjaro climb was well-organized and the guides were professional.',
                'rating' => 5,
                'image' => 'https://i.pravatar.cc/150?u=john'
            ],
            [
                'name' => 'Sarah Smith',
                'location' => 'UK',
                'content' => 'The safari was breathtaking. We saw all the big five in just three days! Highly recommend Go Deep Africa.',
                'rating' => 5,
                'image' => 'https://i.pravatar.cc/150?u=sarah'
            ],
            [
                'name' => 'Michael Chen',
                'location' => 'Canada',
                'content' => 'Lemosho route is beautiful. The crew took great care of us. Nutritious food even at high altitudes!',
                'rating' => 5,
                'image' => 'https://i.pravatar.cc/150?u=michael'
            ]
        ];
        return view('pages.testimonials', compact('testimonials'));
    }
}
