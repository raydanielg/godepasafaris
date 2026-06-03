<?php

namespace App\Http\Controllers;

use App\Models\SafariPackage;
use App\Mail\BookingInquiry;
use App\Mail\CustomerConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class SafariController extends Controller
{
    public function index()
    {
        $packages = SafariPackage::latest()->get();
        
        // Fetch all tour titles for the inquiry modal
        $safariTours = \App\Models\SafariPackage::select('id', 'title')->get();
        $kiliTours = \App\Models\KilimanjaroPackage::select('id', 'title')->get();
        $allTourOptions = $safariTours->concat($kiliTours);
        
        return view('safari.index', compact('packages', 'allTourOptions'));
    }

    public function destinations()
    {
        $destinations = \App\Models\Destination::latest()->get();
        $categories = ['All', 'National Parks', 'Islands', 'Cultural Sites', 'Mountains'];
        
        // Fetch all tour titles for the inquiry modal
        $safariTours = \App\Models\SafariPackage::select('id', 'title')->get();
        $kiliTours = \App\Models\KilimanjaroPackage::select('id', 'title')->get();
        $allTourOptions = $safariTours->concat($kiliTours);

        return view('destinations.index', compact('destinations', 'categories', 'allTourOptions'));
    }

    public function destinationShow($slug)
    {
        $destination = \App\Models\Destination::where('slug', $slug)->firstOrFail();
        
        // Fetch all tour titles for the inquiry modal
        $safariTours = \App\Models\SafariPackage::select('id', 'title')->get();
        $kiliTours = \App\Models\KilimanjaroPackage::select('id', 'title')->get();
        $allTourOptions = $safariTours->concat($kiliTours);

        // Fetch related tours (e.g., packages mentioned in destination or just some recent ones)
        $relatedTours = \App\Models\SafariPackage::latest()->take(2)->get();

        return view('destinations.show', compact('destination', 'allTourOptions', 'relatedTours'));
    }

    public function show($slug)
    {
        $package = SafariPackage::where('slug', $slug)->firstOrFail();
        $relatedPackages = SafariPackage::where('id', '!=', $package->id)->limit(3)->get();
        return view('safari.show', compact('package', 'relatedPackages'));
    }

    public function enquire(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please check your input and try again.',
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $package = SafariPackage::findOrFail($id);

        $details = $request->only(['name', 'email', 'phone', 'adults', 'children', 'message']);
        $details['package'] = $package->title;

        // Send Email to Admin
        try {
            Mail::to('info@godeepafricasafari.com')->send(new BookingInquiry($details));
        } catch (\Exception $e) {
            \Log::error('Admin email failed: ' . $e->getMessage());
        }

        // Send Confirmation Email to Customer
        try {
            Mail::to($details['email'])->send(new CustomerConfirmation($details));
        } catch (\Exception $e) {
            \Log::error('Customer email failed: ' . $e->getMessage());
        }

        // Return JSON response for AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your safari inquiry has been received. Our team will contact you within 24 hours.'
            ]);
        }

        return back()->with('success', 'Thank you! Your safari inquiry has been received. Our team will contact you within 24 hours.');
    }

    public function storeBooking(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'nullable|string|max:20',
            'tour_id'       => 'nullable|integer',
            'tour_name'     => 'nullable|string|max:255',
            'travel_date'   => 'nullable|date',
            'travelers'     => 'nullable|string',
            'accommodation' => 'nullable|string|max:100',
            'message'       => 'nullable|string',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please check your input and try again.',
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        \App\Models\Booking::create($validated);

        // Notify admin by email
        $details = array_merge($validated, ['package' => $validated['tour_name'] ?? 'General Inquiry']);
        try {
            Mail::to('info@godeepafricasafari.com')->send(new BookingInquiry($details));
        } catch (\Exception $e) {
            \Log::error('Admin email failed: ' . $e->getMessage());
        }

        // Send Confirmation Email to Customer
        if (!empty($validated['email'])) {
            try {
                Mail::to($validated['email'])->send(new CustomerConfirmation($details));
            } catch (\Exception $e) {
                \Log::error('Customer email failed: ' . $e->getMessage());
            }
        }

        // Return JSON response for AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your inquiry has been received. We will contact you shortly.'
            ]);
        }

        return back()->with('success', 'Thank you! Your inquiry has been received. We will contact you shortly.');
    }
}
