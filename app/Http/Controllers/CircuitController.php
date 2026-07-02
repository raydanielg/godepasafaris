<?php

namespace App\Http\Controllers;

use App\Models\SafariDestination;
use Illuminate\Support\Str;

class CircuitController extends Controller
{
    /** Landing page listing the three safari circuits. */
    public function index()
    {
        $circuits = config('circuits', []);

        return view('circuits.index', compact('circuits'));
    }

    /** Detailed page for a single circuit, with map and related destinations. */
    public function show(string $slug)
    {
        $circuit = config("circuits.$slug");

        abort_if(! $circuit, 404);

        // Best-effort match of the circuit's places to real destination pages
        // so visitors can jump straight to a destination we sell.
        $slugs = collect($circuit['places'])->map(fn ($p) => Str::slug($p['name']));
        $relatedDestinations = SafariDestination::active()
            ->whereIn('slug', $slugs)
            ->get();

        return view('circuits.show', compact('circuit', 'relatedDestinations'));
    }
}
