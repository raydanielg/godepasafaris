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

        // Advanced Filtering
        if ($request->filled('price_max')) {
            $safariQuery->where('price', '<=', $request->price_max);
            $kiliQuery->where('price', '<=', $request->price_max);
        }

        if ($request->filled('category')) {
            $safariQuery->where('category', 'like', '%' . $request->category . '%');
            // Kilimanjaro is usually a specific category itself
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

        // Static categories for filters
        $filters = [
            'starting_from' => ['Arusha', 'Dar es Salaam', 'Moshi', 'Nairobi', 'Zanzibar'],
            'standard_level' => ['Budget', 'Mid Range', 'Luxury', 'Luxury++'],
            'specialized_tours' => ['Fly-in safaris', 'Beach time', 'Mountain climbing', 'Safari & Beach', 'Safari & Kilimanjaro']
        ];

        if ($request->ajax()) {
            return view('tours.partials.tour_list', compact('tours'))->render();
        }

        return view('tours.index', compact('tours', 'filters'));
    }
}
