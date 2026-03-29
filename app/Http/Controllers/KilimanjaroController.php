<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\KilimanjaroPackage;
use App\Mail\BookingInquiry;
use Illuminate\Support\Facades\Mail;

class KilimanjaroController extends Controller
{
    public function index()
    {
        $packages = KilimanjaroPackage::latest()->get();
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'message' => 'required|string',
        ]);

        $package = KilimanjaroPackage::findOrFail($id);
        
        $details = $request->only(['name', 'email', 'phone', 'adults', 'children', 'message']);
        $details['package'] = $package->title;

        // Send Email to Admin
        Mail::to('info@godeepafricasafari.com')->send(new BookingInquiry($details));

        return back()->with('success', 'Thank you! Your inquiry has been received. Our team will contact you within 24 hours.');
    }
}
