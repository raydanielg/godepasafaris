<?php

namespace App\Http\Controllers;

use App\Models\SafariPackage;
use Illuminate\Http\Request;

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
}
