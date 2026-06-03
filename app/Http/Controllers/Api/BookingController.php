<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\SafariPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Create a new booking
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'safari_package_id' => 'required|exists:safari_packages,id',
            'travel_date' => 'required|date|after:today',
            'travelers' => 'required|integer|min:1',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $safari = SafariPackage::findOrFail($request->safari_package_id);

        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'safari_package_id' => $request->safari_package_id,
            'tour_name' => $safari->title,
            'travel_date' => $request->travel_date,
            'travelers' => $request->travelers,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully',
            'data' => $booking
        ], 201);
    }

    /**
     * Get user's bookings
     */
    public function index(Request $request)
    {
        $bookings = $request->user()->bookings()
            ->with('safariPackage')
            ->latest()
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $bookings->items(),
            'pagination' => [
                'total' => $bookings->total(),
                'per_page' => $bookings->perPage(),
                'current_page' => $bookings->currentPage(),
                'last_page' => $bookings->lastPage(),
            ]
        ]);
    }

    /**
     * Get single booking
     */
    public function show(Request $request, $id)
    {
        $booking = $request->user()->bookings()
            ->with('safariPackage')
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $booking
        ]);
    }
}
