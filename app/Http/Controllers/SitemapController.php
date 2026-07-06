<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SafariPackage;
use App\Models\KilimanjaroPackage;
use App\Models\SafariDestination;
use App\Models\CulturalExperience;
use App\Models\Post;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;

class SitemapController extends Controller
{
    public function index()
    {
        $safaris = SafariPackage::all();
        $kilis = KilimanjaroPackage::all();
        $posts = Post::all();
        $routes = ['machame', 'lemosho', 'marangu', 'rongai', 'umbwe', 'northern'];

        // Safari circuits are config-driven (keyed by slug).
        $circuits = array_keys(config('circuits', []));

        // Safari styles that have real routes.
        $styles = ['private', 'budget', 'photographic', 'cultural', 'walking', 'luxury'];

        // Dynamic destinations (stable table).
        $destinations = SafariDestination::query()
            ->when(method_exists(SafariDestination::class, 'scopeActive'), fn ($q) => $q->active())
            ->get();

        // Cultural experiences — guard the query in case the table hasn't been
        // migrated on this server yet, so the sitemap never 500s.
        $cultural = collect();
        if (Schema::hasTable('cultural_experiences')) {
            $cultural = CulturalExperience::query()
                ->when(method_exists(CulturalExperience::class, 'scopeActive'), fn ($q) => $q->active())
                ->get();
        }

        return Response::view('sitemap', [
            'safaris' => $safaris,
            'kilis' => $kilis,
            'posts' => $posts,
            'routes' => $routes,
            'circuits' => $circuits,
            'styles' => $styles,
            'destinations' => $destinations,
            'cultural' => $cultural,
        ])->header('Content-Type', 'text/xml');
    }
}
