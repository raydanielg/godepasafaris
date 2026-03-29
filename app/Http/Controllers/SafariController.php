<?php

namespace App\Http\Controllers;

use App\Models\SafariPackage;
use App\Mail\BookingInquiry;
use Illuminate\Support\Facades\Mail;

class SafariController extends Controller
{
    public function index()
    {
        $packages = SafariPackage::latest()->get();
        return view('safari.index', compact('packages'));
    }

    public function show($slug)
    {
        $package = SafariPackage::where('slug', $slug)->firstOrFail();
        $relatedPackages = SafariPackage::where('id', '!=', $package->id)->limit(3)->get();
        return view('safari.show', compact('package', 'relatedPackages'));
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

        $package = SafariPackage::findOrFail($id);
        
        $details = $request->only(['name', 'email', 'phone', 'adults', 'children', 'message']);
        $details['package'] = $package->title;

        // Send Email to Admin
        Mail::to('info@godeepafricasafari.com')->send(new BookingInquiry($details));

        return back()->with('success', 'Thank you! Your safari inquiry has been received. Our team will contact you within 24 hours.');
    }
}
