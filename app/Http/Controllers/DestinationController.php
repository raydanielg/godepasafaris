<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::query();

        if ($request->has('category') && $request->category != 'All') {
            $query->where('category', $request->category);
        }

        $destinations = $query->latest()->get();
        $categories = ['All', 'National Parks', 'Mountains', 'Rivers & Lakes', 'Beach & Islands Ext', 'Towns and Cities'];

        return view('destinations.index', compact('destinations', 'categories'));
    }
}
