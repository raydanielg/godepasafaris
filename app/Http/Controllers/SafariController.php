<?php

namespace App\Http\Controllers;

use App\Models\SafariPackage;
use App\Mail\BookingInquiry;
use App\Mail\CustomerConfirmation;
use App\Http\Controllers\Concerns\PreventsSpam;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class SafariController extends Controller
{
    use PreventsSpam;

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
        // Silently drop bot submissions caught by the honeypot: pretend it
        // succeeded so the bot moves on, but never save or email anything.
        if ($this->isSpamSubmission($request)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! Your safari inquiry has been received. Our team will contact you within 24 hours.'
                ]);
            }
            return back()->with('success', 'Thank you! Your safari inquiry has been received. Our team will contact you within 24 hours.');
        }

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

        // 1) Save to the admin Bookings list so it never depends on email.
        try {
            \App\Models\Booking::create([
                'safari_package_id' => $package->id,
                'tour_name'         => $package->title,
                'name'              => $details['name'],
                'email'             => $details['email'],
                'phone'             => $details['phone'] ?? null,
                'travelers'         => trim(($details['adults'] ?? 0) . ' Adults' . (!empty($details['children']) ? ', ' . $details['children'] . ' Children' : '')),
                'message'           => $details['message'] ?? null,
            ]);
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Booking save failed (safari enquire): ' . $e->getMessage(), $details);
        }

        $adminEmail = config('mail.booking_recipients');

        // 2) Notify the company inboxes (business webmail + owner's Gmail).
        try {
            Mail::to($adminEmail)->send(new BookingInquiry($details));
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Admin email failed (safari enquire): ' . $e->getMessage(), ['to' => implode(',', (array) $adminEmail)] + $details);
        }

        // 3) Confirm to the customer.
        try {
            Mail::to($details['email'])->send(new CustomerConfirmation($details));
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Customer email failed (safari enquire): ' . $e->getMessage(), ['to' => $details['email']]);
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
        // Silently drop bot submissions caught by the honeypot: pretend it
        // succeeded so the bot moves on, but never save or email anything.
        if ($this->isSpamSubmission($request)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! Your inquiry has been received. We will contact you shortly.'
                ]);
            }
            return back()->with('success', 'Thank you! Your inquiry has been received. We will contact you shortly.');
        }

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

        // 1) Save to the admin Bookings list (the source of truth — never lost
        //    even if email delivery fails).
        try {
            \App\Models\Booking::create($validated);
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Booking save failed (store): ' . $e->getMessage(), $validated);
        }

        $details = array_merge($validated, ['package' => $validated['tour_name'] ?? 'General Inquiry']);
        $adminEmail = config('mail.booking_recipients');

        // 2) Notify the company inboxes (business webmail + owner's Gmail).
        try {
            Mail::to($adminEmail)->send(new BookingInquiry($details));
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Admin email failed (store): ' . $e->getMessage(), ['to' => implode(',', (array) $adminEmail)] + $details);
        }

        // 3) Confirm to the customer.
        if (!empty($validated['email'])) {
            try {
                Mail::to($validated['email'])->send(new CustomerConfirmation($details));
            } catch (\Throwable $e) {
                \Log::channel('bookings')->error('Customer email failed (store): ' . $e->getMessage(), ['to' => $validated['email']]);
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
