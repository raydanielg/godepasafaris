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
