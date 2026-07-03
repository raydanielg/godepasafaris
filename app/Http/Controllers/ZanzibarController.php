<?php

namespace App\Http\Controllers;

use App\Models\ZanzibarActivity;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ZanzibarController extends Controller
{
    /**
     * Render the Zanzibar page. Content comes from the database (managed in the
     * admin panel); any category with no DB rows falls back to config/zanzibar.php
     * so the page is never empty.
     */
    public function index()
    {
        $z = config('zanzibar', []);

        // If the content table hasn't been migrated yet (fresh deploy), or any
        // DB issue occurs, render from config so the page never 500s.
        try {
            if (! Schema::hasTable('zanzibar_activities')) {
                return view('zanzibar', ['z' => $z]);
            }

            $rows = ZanzibarActivity::active()->ordered()->get()->groupBy('category');
        } catch (\Throwable $e) {
            Log::warning('Zanzibar DB content unavailable, using config fallback: ' . $e->getMessage());

            return view('zanzibar', ['z' => $z]);
        }

        // Category => closure mapping a DB row to the shape each view section expects.
        $shapes = [
            'beaches'    => fn ($r) => ['name' => $r->title, 'icon' => $r->icon, 'best_time' => $r->best_time, 'desc' => $r->description, 'activities' => $r->detail_list, 'image' => $r->image_url],
            'stone_town' => fn ($r) => ['name' => $r->title, 'icon' => $r->icon, 'desc' => $r->description],
            'culture'    => fn ($r) => ['name' => $r->title, 'icon' => $r->icon],
            'spices'     => fn ($r) => ['name' => $r->title, 'icon' => $r->icon, 'desc' => $r->description],
            'turtle'     => fn ($r) => ['name' => $r->title, 'icon' => $r->icon, 'desc' => $r->description],
            'marine'     => fn ($r) => ['name' => $r->title, 'icon' => $r->icon],
            'packages'   => fn ($r) => [
                'name'     => $r->title,
                'tag'      => $r->description,
                'icon'     => $r->icon,
                'from'     => (int) ($r->price ?? 0),
                'includes' => $r->detail_list,
                'nights'   => preg_match('/(\d+)\s*night/i', (string) $r->duration, $m) ? (int) $m[1] : '',
                'image'    => $r->image_url,
            ],
        ];

        foreach ($shapes as $category => $shape) {
            if (($rows[$category] ?? collect())->isNotEmpty()) {
                $z[$category] = $rows[$category]->map($shape)->values()->all();
            }
        }

        // prison_island / jozani keep their config intro but take features from the DB.
        foreach (['prison_island', 'jozani'] as $category) {
            if (($rows[$category] ?? collect())->isNotEmpty()) {
                $z[$category]['features'] = $rows[$category]
                    ->map(fn ($r) => ['name' => $r->title, 'icon' => $r->icon, 'desc' => $r->description])
                    ->values()->all();
            }
        }

        return view('zanzibar', ['z' => $z]);
    }
}
