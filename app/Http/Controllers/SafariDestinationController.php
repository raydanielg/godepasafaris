<?php

namespace App\Http\Controllers;

use App\Models\SafariDestination;
use App\Models\SafariPackage;
use Illuminate\Http\Request;

class SafariDestinationController extends Controller
{
    public function index(Request $request)
    {
        // Region-to-slug mapping for Northern/Southern/Western Tanzania circuits
        $regionMap = [
            'north' => ['serengeti', 'ngorongoro', 'tarangire', 'lake-manyara', 'mount-kilimanjaro', 'arusha', 'mkomazi'],
            'south' => ['selous', 'ruaha', 'mikumi', 'saadani'],
            'west'  => ['mahale', 'gombe', 'katavi', 'rubondo'],
        ];

        $query = SafariDestination::active()->ordered()->with('activities');

        $activeRegion = null;
        if ($request->filled('region') && isset($regionMap[$request->region])) {
            $activeRegion = $request->region;
            $keywords = $regionMap[$request->region];
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $kw) {
                    $q->orWhere('slug', 'like', "%{$kw}%");
                }
            });
        }

        $destinations = $query->get();
        $featured = SafariDestination::active()->featured()->with('activities')->first();

        return view('pages.destinations.index', compact('destinations', 'featured', 'activeRegion'));
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
