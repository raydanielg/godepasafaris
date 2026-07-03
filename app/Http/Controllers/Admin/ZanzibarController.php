<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZanzibarActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ZanzibarController extends Controller
{
    public function index()
    {
        $categories = ZanzibarActivity::CATEGORIES;

        // Before the table has been created (fresh deploy), show a friendly
        // setup notice instead of a 500 error.
        if (! Schema::hasTable('zanzibar_activities')) {
            return view('admin.zanzibar.index', ['items' => collect(), 'categories' => $categories, 'needsSetup' => true]);
        }

        $items = ZanzibarActivity::ordered()->get()->groupBy('category');

        return view('admin.zanzibar.index', compact('items', 'categories'));
    }

    public function create()
    {
        if (! Schema::hasTable('zanzibar_activities')) {
            return redirect()->route('admin.zanzibar.index');
        }

        $categories = ZanzibarActivity::CATEGORIES;

        return view('admin.zanzibar.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (! Schema::hasTable('zanzibar_activities')) {
            return redirect()->route('admin.zanzibar.index')
                ->with('error', 'The Zanzibar table is not set up yet. Please run the migration or import the SQL first.');
        }

        $data = $this->validated($request);
        $data['image'] = $this->handleImage($request);
        $data['display_order'] = $data['display_order'] ?? (ZanzibarActivity::max('display_order') + 1);

        ZanzibarActivity::create($data);

        return redirect()->route('admin.zanzibar.index')->with('success', 'Zanzibar item created successfully.');
    }

    public function edit(ZanzibarActivity $zanzibar)
    {
        $categories = ZanzibarActivity::CATEGORIES;

        return view('admin.zanzibar.edit', ['item' => $zanzibar, 'categories' => $categories]);
    }

    public function update(Request $request, ZanzibarActivity $zanzibar)
    {
        $data = $this->validated($request);

        if ($newImage = $this->handleImage($request)) {
            $this->deleteImage($zanzibar->image);
            $data['image'] = $newImage;
        }

        $zanzibar->update($data);

        return redirect()->route('admin.zanzibar.index')->with('success', 'Zanzibar item updated successfully.');
    }

    public function destroy(ZanzibarActivity $zanzibar)
    {
        $this->deleteImage($zanzibar->image);
        $zanzibar->delete();

        return redirect()->route('admin.zanzibar.index')->with('success', 'Zanzibar item deleted.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'category'      => 'required|string|in:' . implode(',', array_keys(ZanzibarActivity::CATEGORIES)),
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'icon'          => 'nullable|string|max:60',
            'price'         => 'nullable|numeric|min:0',
            'duration'      => 'nullable|string|max:120',
            'best_time'     => 'nullable|string|max:120',
            'details'       => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            // Secure image rules: images only, max 4 MB.
            'image'         => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
        ], [
            'image.image' => 'The file must be an image (JPG, PNG or WebP).',
            'image.max'   => 'The image may not be larger than 4 MB.',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        return $validated;
    }

    /** Store an uploaded image on the public disk; returns the stored path or null. */
    private function handleImage(Request $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        return $request->file('image')->store('zanzibar', 'public');
    }

    private function deleteImage(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'http') && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
