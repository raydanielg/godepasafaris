<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\KilimanjaroPackage;
use App\Mail\BookingInquiry;
use App\Mail\CustomerConfirmation;
use Illuminate\Support\Facades\Mail;

class KilimanjaroController extends Controller
{
    public function index(Request $request)
    {
        $query = KilimanjaroPackage::latest();
        
        if ($request->has('all')) {
            $packages = $query->get();
        } else {
            $packages = $query->take(4)->get();
        }
        
        return view('kilimanjaro.index', compact('packages'));
    }

    public function show($slug)
    {
        $package = KilimanjaroPackage::where('slug', $slug)->firstOrFail();
        $relatedPackages = KilimanjaroPackage::where('id', '!=', $package->id)->limit(3)->get();
        return view('kilimanjaro.show', compact('package', 'relatedPackages'));
    }

    public function routeShow($slug)
    {
        $route = [
            'slug' => $slug,
            'name' => ucfirst($slug) . ' Route',
            'title' => 'Climb Kilimanjaro via ' . ucfirst($slug) . ' Route',
            'price' => 2252,
            'days' => 7,
            'success_rate' => '93.1%',
            'overview' => 'The ' . ucfirst($slug) . ' route, also known as the Whiskey Route, is a classic Kilimanjaro trail. It’s one of the most popular routes to climb Kilimanjaro. We organize hundreds of expeditions annually along this trail that starts in a beautiful tropical forest. The Machame route is available in 6- and 7-day variations, with the second offering a significantly better acclimatization profile and summit success rate.',
        ];
        
        // In a real app, this would come from a database. 
        // For now, we'll use a static array or a dedicated view for Machame as a template.
        return view('kilimanjaro.routes.' . $slug, compact('route'));
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

        $package = KilimanjaroPackage::findOrFail($id);

        $details = $request->only(['name', 'email', 'phone', 'adults', 'children', 'message']);
        $details['package'] = $package->title;

        // 1) Save to the admin Bookings list.
        try {
            \App\Models\Booking::create([
                'tour_name'  => $package->title,
                'name'       => $details['name'],
                'email'      => $details['email'],
                'phone'      => $details['phone'] ?? null,
                'travelers'  => trim(($details['adults'] ?? 0) . ' Adults' . (!empty($details['children']) ? ', ' . $details['children'] . ' Children' : '')),
                'message'    => $details['message'] ?? null,
            ]);
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Booking save failed (kilimanjaro enquire): ' . $e->getMessage(), $details);
        }

        $adminEmail = config('mail.admin_address');

        // 2) Notify the company.
        try {
            Mail::to($adminEmail)->send(new BookingInquiry($details));
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Admin email failed (kilimanjaro enquire): ' . $e->getMessage(), ['to' => $adminEmail] + $details);
        }

        // 3) Confirm to the customer.
        try {
            Mail::to($details['email'])->send(new CustomerConfirmation($details));
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Customer email failed (kilimanjaro enquire): ' . $e->getMessage(), ['to' => $details['email']]);
        }

        // Return JSON response for AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your inquiry has been received. Our team will contact you within 24 hours.'
            ]);
        }

        return back()->with('success', 'Thank you! Your inquiry has been received. Our team will contact you within 24 hours.');
    }
}
