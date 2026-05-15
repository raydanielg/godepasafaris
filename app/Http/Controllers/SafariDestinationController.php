<?php

namespace App\Http\Controllers;

use App\Models\SafariDestination;
use App\Models\SafariPackage;
use Illuminate\Http\Request;

class SafariDestinationController extends Controller
{
    public function index()
    {
        $destinations = SafariDestination::active()->ordered()->with('activities')->get();
        $featured = SafariDestination::active()->featured()->with('activities')->first();
        
        return view('pages.destinations.index', compact('destinations', 'featured'));
    }

    public function show($slug)
    {
        $destination = SafariDestination::active()
            ->where('slug', $slug)
            ->with('activities')
            ->firstOrFail();

        $relatedPackages = SafariPackage::where('title', 'like', '%' . $destination->name . '%')
            ->orWhere('summary', 'like', '%' . $destination->name . '%')
            ->limit(3)
            ->get();

        $otherDestinations = SafariDestination::active()
            ->where('id', '!=', $destination->id)
            ->limit(4)
            ->get();

        return view('pages.destinations.show', compact('destination', 'relatedPackages', 'otherDestinations'));
    }
}
