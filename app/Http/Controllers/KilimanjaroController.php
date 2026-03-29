<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KilimanjaroController extends Controller
{
    public function index()
    {
        $packages = \App\Models\KilimanjaroPackage::latest()->get();
        return view('kilimanjaro.index', compact('packages'));
    }

    public function show($slug)
    {
        $package = \App\Models\KilimanjaroPackage::where('slug', $slug)->firstOrFail();
        $relatedPackages = \App\Models\KilimanjaroPackage::where('id', '!=', $package->id)->limit(3)->get();
        return view('kilimanjaro.show', compact('package', 'relatedPackages'));
    }
}
