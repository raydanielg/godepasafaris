<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackingList;
use App\Models\PackingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackingListController extends Controller
{
    public function index()
    {
        $packingLists = PackingList::withCount('items')->orderBy('display_order')->get();
        return view('admin.packing-lists.index', compact('packingLists'));
    }

    public function create()
    {
        return view('admin.packing-lists.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:kilimanjaro,safari,general',
            'icon' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
            'display_order' => 'integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('packing-lists', 'public');
        }

        $packingList = PackingList::create($validated);

        return redirect()->route('admin.packing-lists.edit', $packingList)
            ->with('success', 'Packing list created successfully! Now add items.');
    }

    public function edit(PackingList $packingList)
    {
        $packingList->load('items');
        return view('admin.packing-lists.edit', compact('packingList'));
    }

    public function update(Request $request, PackingList $packingList)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:kilimanjaro,safari,general',
            'icon' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
            'display_order' => 'integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('packing-lists', 'public');
        }

        $packingList->update($validated);

        return redirect()->route('admin.packing-lists.index')
            ->with('success', 'Packing list updated successfully!');
    }

    public function destroy(PackingList $packingList)
    {
        $packingList->delete();
        return redirect()->route('admin.packing-lists.index')
            ->with('success', 'Packing list deleted successfully!');
    }

    // Item Management
    public function storeItem(Request $request, PackingList $packingList)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'is_essential' => 'boolean',
            'is_recommended' => 'boolean',
            'display_order' => 'integer',
        ]);

        $validated['is_essential'] = $request->boolean('is_essential', false);
        $validated['is_recommended'] = $request->boolean('is_recommended', true);

        $packingList->items()->create($validated);

        return redirect()->route('admin.packing-lists.edit', $packingList)
            ->with('success', 'Item added successfully!');
    }

    public function updateItem(Request $request, PackingItem $item)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'is_essential' => 'boolean',
            'is_recommended' => 'boolean',
            'display_order' => 'integer',
        ]);

        $validated['is_essential'] = $request->boolean('is_essential', false);
        $validated['is_recommended'] = $request->boolean('is_recommended', true);

        $item->update($validated);

        return redirect()->route('admin.packing-lists.edit', $item->packing_list_id)
            ->with('success', 'Item updated successfully!');
    }

    public function destroyItem(PackingItem $item)
    {
        $packingListId = $item->packing_list_id;
        $item->delete();

        return redirect()->route('admin.packing-lists.edit', $packingListId)
            ->with('success', 'Item deleted successfully!');
    }

    public function toggleItemStatus(PackingItem $item)
    {
        $item->update(['is_recommended' => !$item->is_recommended]);
        return back()->with('success', 'Item status updated!');
    }
}
