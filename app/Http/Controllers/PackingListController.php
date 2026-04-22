<?php

namespace App\Http\Controllers;

use App\Models\PackingList;
use Illuminate\Http\Request;

class PackingListController extends Controller
{
    public function index()
    {
        $packingLists = PackingList::active()->with('items')->orderBy('display_order')->get();
        return view('pages.packing-list.index', compact('packingLists'));
    }

    public function show($slug)
    {
        $packingList = PackingList::active()
            ->where('slug', $slug)
            ->with(['items' => function($query) {
                $query->orderBy('is_essential', 'desc')->orderBy('display_order');
            }])
            ->firstOrFail();

        $relatedLists = PackingList::active()
            ->where('id', '!=', $packingList->id)
            ->where('category', $packingList->category)
            ->limit(3)
            ->get();

        return view('pages.packing-list.show', compact('packingList', 'relatedLists'));
    }

    public function category($category)
    {
        $packingLists = PackingList::active()
            ->byCategory($category)
            ->with('items')
            ->orderBy('display_order')
            ->get();

        $categoryNames = [
            'kilimanjaro' => 'Kilimanjaro Climbing',
            'safari' => 'Safari Tours',
            'general' => 'General Travel',
        ];

        $categoryTitle = $categoryNames[$category] ?? ucfirst($category);

        return view('pages.packing-list.category', compact('packingLists', 'category', 'categoryTitle'));
    }
}
