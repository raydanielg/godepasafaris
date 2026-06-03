<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SafariPackage;
use Illuminate\Http\Request;

class SafariController extends Controller
{
    /**
     * Get all safari packages
     */
    public function index(Request $request)
    {
        $query = SafariPackage::where('is_active', true);

        // Filter by category
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Filter by featured
        if ($request->has('featured') && $request->featured) {
            $query->where('is_featured', true);
        }

        // Filter by days range
        if ($request->has('min_days')) {
            $query->where('days', '>=', $request->min_days);
        }
        if ($request->has('max_days')) {
            $query->where('days', '<=', $request->max_days);
        }

        // Filter by price range
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Pagination
        $perPage = $request->get('per_page', 15);
        $safaris = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $safaris->items(),
            'pagination' => [
                'total' => $safaris->total(),
                'per_page' => $safaris->perPage(),
                'current_page' => $safaris->currentPage(),
                'last_page' => $safaris->lastPage(),
            ]
        ]);
    }

    /**
     * Get single safari package by slug
     */
    public function show($slug)
    {
        $safari = SafariPackage::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $safari
        ]);
    }

    /**
     * Get featured safari packages
     */
    public function featured(Request $request)
    {
        $limit = $request->get('limit', 6);
        $safaris = SafariPackage::where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $safaris
        ]);
    }
}
