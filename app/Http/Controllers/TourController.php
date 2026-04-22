<?php

namespace App\Http\Controllers;

use App\Models\SafariPackage;
use App\Models\KilimanjaroPackage;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $safariQuery = SafariPackage::query();
        $kiliQuery = KilimanjaroPackage::query();

        // Price Filter
        if ($request->filled('price_max') && $request->price_max > 0) {
            $safariQuery->where('price', '<=', $request->price_max);
            $kiliQuery->where('price', '<=', $request->price_max);
        }

        // Days/Tour Length Filter
        if ($request->filled('days_max') && $request->days_max > 0) {
            $safariQuery->where('days', '<=', $request->days_max);
            $kiliQuery->where('days', '<=', $request->days_max);
        }

        // Days minimum
        if ($request->filled('days_min') && $request->days_min > 0) {
            $safariQuery->where('days', '>=', $request->days_min);
            $kiliQuery->where('days', '>=', $request->days_min);
        }

        // Trip Type Filter (Private/Shared)
        if ($request->boolean('private')) {
            $safariQuery->where('title', 'like', '%Private%');
        }
        if ($request->boolean('shared') || $request->boolean('group')) {
            $safariQuery->where('title', 'like', '%Group%');
        }

        // Safari Type (Lodge/Camping)
        if ($request->boolean('lodge')) {
            $safariQuery->where('title', 'like', '%Lodge%');
        }
        if ($request->boolean('camping')) {
            $safariQuery->where('title', 'like', '%Camping%');
        }

        // Specialized Tours
        if ($request->boolean('mountain_climbing') || $request->boolean('kilimanjaro')) {
            // Prioritize Kilimanjaro packages
            $safariQuery->where('title', 'not like', '%'); // Empty to skip safari if needed
        }

        // Category Filter
        if ($request->filled('category')) {
            $safariQuery->where('category', 'like', '%' . $request->category . '%');
        }

        $safariPackages = $safariQuery->get()->map(function($item) {
            $item->type = 'Safari';
            return $item;
        });

        $kilimanjaroPackages = $kiliQuery->get()->map(function($item) {
            $item->type = 'Kilimanjaro';
            return $item;
        });

        $tours = $safariPackages->concat($kilimanjaroPackages)->sortByDesc('created_at');

        // Count active filters
        $activeFilters = collect($request->only(['price_max', 'days_max', 'private', 'shared', 'lodge', 'camping', 'kilimanjaro']))
            ->filter()->count();

        // Static categories for filters
        $filters = [
            'starting_from' => ['Arusha', 'Dar es Salaam', 'Moshi', 'Nairobi', 'Zanzibar'],
            'standard_level' => ['Budget', 'Mid Range', 'Luxury', 'Luxury++'],
            'specialized_tours' => ['Fly-in safaris', 'Beach time', 'Mountain climbing', 'Safari & Beach', 'Safari & Kilimanjaro']
        ];

        if ($request->ajax()) {
            return view('tours.partials.tour_list', compact('tours'))->render();
        }

        return view('tours.index', compact('tours', 'filters', 'activeFilters'));
    }
}
