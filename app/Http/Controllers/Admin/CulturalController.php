<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CulturalActivity;
use App\Models\CulturalExperience;
use App\Models\CulturalReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CulturalController extends Controller
{
    public function index()
    {
        // Before the table exists (fresh deploy), show an empty list with a
        // setup notice instead of a 500.
        if (! Schema::hasTable('cultural_experiences')) {
            return view('admin.cultural.index', ['experiences' => collect(), 'needsSetup' => true]);
        }

        $experiences = CulturalExperience::ordered()->withCount('reviews')->get();

        return view('admin.cultural.index', compact('experiences'));
    }

    public function create()
    {
        if (! Schema::hasTable('cultural_experiences')) {
            return redirect()->route('admin.cultural.index');
        }

        return view('admin.cultural.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['name']);
        $data['image'] = $this->upload($request, 'image') ?? null;
        $data['gallery'] = $this->uploadGallery($request);
        $data['display_order'] = $data['display_order'] ?? (CulturalExperience::max('display_order') + 1);

        CulturalExperience::create($data);

        return redirect()->route('admin.cultural.index')->with('success', 'Cultural experience created.');
    }

    public function edit(CulturalExperience $cultural)
    {
        $cultural->load('reviews', 'activityItems');

        return view('admin.cultural.edit', ['item' => $cultural]);
    }

    public function update(Request $request, CulturalExperience $cultural)
    {
        $data = $this->validated($request);

        if ($newImage = $this->upload($request, 'image')) {
            $this->deleteFile($cultural->image);
            $data['image'] = $newImage;
        }

        // Gallery: keep existing minus any removed, then append new uploads.
        $gallery = is_array($cultural->gallery) ? $cultural->gallery : [];
        foreach ((array) $request->input('remove_gallery', []) as $remove) {
            if (($k = array_search($remove, $gallery, true)) !== false) {
                $this->deleteFile($remove);
                unset($gallery[$k]);
            }
        }
        $data['gallery'] = array_values(array_merge($gallery, $this->uploadGallery($request)));

        $cultural->update($data);

        return redirect()->route('admin.cultural.index')->with('success', 'Cultural experience updated.');
    }

    public function destroy(CulturalExperience $cultural)
    {
        $this->deleteFile($cultural->image);
        foreach ((array) $cultural->gallery as $g) {
            $this->deleteFile($g);
        }
        $cultural->delete();

        return redirect()->route('admin.cultural.index')->with('success', 'Cultural experience deleted.');
    }

    /* -------------------------------------------------- Reviews management */

    public function storeReview(Request $request, CulturalExperience $cultural)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:120',
            'location' => 'nullable|string|max:120',
            'rating'   => 'required|integer|min:1|max:5',
            'comment'  => 'required|string|max:1000',
        ]);
        $validated['is_approved'] = true;

        $cultural->reviews()->create($validated);

        return back()->with('success', 'Review added.');
    }

    public function destroyReview(CulturalReview $review)
    {
        $review->delete();

        return back()->with('success', 'Review deleted.');
    }

    /* ------------------------------------------------- Activities manager */

    public function storeActivity(Request $request, CulturalExperience $cultural)
    {
        $validated = $this->validatedActivity($request);
        $validated['image'] = $this->upload($request, 'image');
        $validated['display_order'] = $validated['display_order'] ?? (($cultural->activityItems()->max('display_order') ?? 0) + 1);

        $cultural->activityItems()->create($validated);

        return back()->with('success', 'Activity added.');
    }

    public function updateActivity(Request $request, CulturalActivity $activity)
    {
        $validated = $this->validatedActivity($request);

        if ($newImage = $this->upload($request, 'image')) {
            $this->deleteFile($activity->image);
            $validated['image'] = $newImage;
        } else {
            unset($validated['image']);
        }

        $activity->update($validated);

        return back()->with('success', 'Activity updated.');
    }

    public function destroyActivity(CulturalActivity $activity)
    {
        $this->deleteFile($activity->image);
        $activity->delete();

        return back()->with('success', 'Activity deleted.');
    }

    private function validatedActivity(Request $request): array
    {
        return $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string|max:1000',
            'icon'          => 'nullable|string|max:60',
            'display_order' => 'nullable|integer|min:0',
            'image'         => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
        ]);
    }

    /* ---------------------------------------------------------- helpers */

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'region'           => 'nullable|string|max:255',
            'tribe'            => 'nullable|string|max:255',
            'tagline'          => 'nullable|string|max:255',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'description'      => 'nullable|string',
            'highlights'    => 'nullable|string',
            'activities'    => 'nullable|string',
            'price'         => 'nullable|numeric|min:0',
            'duration'      => 'nullable|string|max:120',
            'best_time'     => 'nullable|string|max:120',
            'icon'          => 'nullable|string|max:60',
            'display_order' => 'nullable|integer|min:0',
            'image'         => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'gallery.*'     => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
        ], [
            'image.image'     => 'The banner must be an image (JPG, PNG or WebP).',
            'gallery.*.image' => 'Each gallery file must be an image.',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['is_active'] = $request->boolean('is_active', true);

        return $validated;
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 2;
        while (CulturalExperience::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /** Store a single uploaded file field into public/uploads/cultural. */
    private function upload(Request $request, string $field): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        return $this->move($request->file($field));
    }

    /** @return string[] newly uploaded gallery paths */
    private function uploadGallery(Request $request): array
    {
        $paths = [];
        foreach ((array) $request->file('gallery', []) as $file) {
            if ($file) {
                $paths[] = $this->move($file);
            }
        }

        return $paths;
    }

    private function move($file): string
    {
        $name = 'cul_' . uniqid() . '.' . strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $dir = public_path('uploads/cultural');
        if (! is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        $file->move($dir, $name);

        return 'uploads/cultural/' . $name;
    }

    private function deleteFile(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'http') && is_file(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}
