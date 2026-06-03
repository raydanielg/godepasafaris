<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Get all destinations
     */
    public function index(Request $request)
    {
        $query = Destination::where('is_active', true);

        // Filter by category
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Pagination
        $perPage = $request->get('per_page', 15);
        $destinations = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $destinations->items(),
            'pagination' => [
                'total' => $destinations->total(),
                'per_page' => $destinations->perPage(),
                'current_page' => $destinations->currentPage(),
                'last_page' => $destinations->lastPage(),
            ]
        ]);
    }

    /**
     * Get single destination by slug
     */
    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $destination
        ]);
    }
}
