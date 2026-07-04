<?php

namespace App\Http\Controllers;

use App\Models\CulturalExperience;
use Illuminate\Support\Facades\Schema;

class CulturalController extends Controller
{
    public function index()
    {
        $experiences = collect();

        if (Schema::hasTable('cultural_experiences')) {
            $experiences = CulturalExperience::active()->ordered()->get();
        }

        $featured = $experiences->firstWhere('is_featured', true) ?? $experiences->first();

        return view('cultural.index', compact('experiences', 'featured'));
    }

    public function show(string $cultural)
    {
        abort_unless(Schema::hasTable('cultural_experiences'), 404);

        $experience = CulturalExperience::active()->where('slug', $cultural)->firstOrFail();
        $experience->load('reviews');

        $related = CulturalExperience::active()
            ->where('id', '!=', $experience->id)
            ->ordered()
            ->take(3)
            ->get();

        return view('cultural.show', compact('experience', 'related'));
    }
}
