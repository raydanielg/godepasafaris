<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SafariPackage;
use App\Models\KilimanjaroPackage;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\ImpactStat;
use App\Models\ImpactStory;
use App\Models\ImpactGallery;
use App\Models\ImpactTimeline;
use App\Models\ImpactPartner;

class WelcomeController extends Controller
{
    public function index()
    {
        $packages = SafariPackage::latest()->take(3)->get();
        $posts = Post::latest()->take(3)->get();
        $destinations = \App\Models\Destination::latest()->get();
        
        // Fetch all tour titles for the inquiry modal
        $safariTours = SafariPackage::select('id', 'title')->get();
        $kiliTours = KilimanjaroPackage::select('id', 'title')->get();
        $allTourOptions = $safariTours->concat($kiliTours);

        // Real, consent-given testimonials entered by staff in the admin panel.
        // This used to be a hardcoded list of invented reviewers illustrated with
        // AI-generated faces from i.pravatar.cc. If none exist yet the views simply
        // render nothing, which is the correct state until real ones are collected.
        $testimonials = \App\Models\Testimonial::active()->get();

        return view('welcome', compact('packages', 'posts', 'allTourOptions', 'testimonials'));
    }

    public function allTours()
    {
        $safaris = SafariPackage::latest()->get();
        $kilimanjaros = KilimanjaroPackage::latest()->get();
        $tours = $safaris->concat($kilimanjaros);
        
        // Define filters for the sidebar
        $filters = [
            'starting_from' => ['Arusha', 'Moshi', 'Zanzibar', 'Dar es Salaam'],
            'duration' => ['1-3 Days', '4-7 Days', '8-12 Days', '12+ Days'],
            'trip_type' => ['Private Safari', 'Group Join-in', 'Luxury Expedition', 'Budget Adventure'],
            'standard_level' => ['Luxury', 'Mid-range', 'Budget'],
            'specialized_tours' => ['Honeymoon', 'Family Friendly', 'Photographic', 'Bird Watching']
        ];
        
        // Fetch all tour titles for the inquiry modal
        $safariTours = SafariPackage::select('id', 'title')->get();
        $kiliTours = KilimanjaroPackage::select('id', 'title')->get();
        $allTourOptions = $safariTours->concat($kiliTours);

        return view('tours.index', compact('safaris', 'kilimanjaros', 'tours', 'filters', 'allTourOptions'));
    }

    public function testimonials()
    {
        // Real, consent-given testimonials entered by staff in the admin panel.
        // This used to be a hardcoded list of invented reviewers illustrated with
        // AI-generated faces from i.pravatar.cc. If none exist yet the views simply
        // render nothing, which is the correct state until real ones are collected.
        $testimonials = \App\Models\Testimonial::active()->get();
        return view('pages.testimonials', compact('testimonials'));
    }

    public function impact()
    {
        $stats = ImpactStat::active()->get();
        $stories = ImpactStory::active()->get();
        $gallery = ImpactGallery::active()->get();
        $timeline = ImpactTimeline::active()->get();
        $partners = ImpactPartner::active()->get();

        return view('pages.impact', compact('stats', 'stories', 'gallery', 'timeline', 'partners'));
    }
}
