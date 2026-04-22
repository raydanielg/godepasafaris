<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SafariDestination;
use App\Models\SafariActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SafariDestinationController extends Controller
{
    public function index()
    {
        $destinations = SafariDestination::withCount('activities')->orderBy('display_order')->get();
        return view('admin.safari-destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.safari-destinations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'location' => 'nullable|string|max:255',
            'best_time' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icon' => 'nullable|string|max:50',
            'badge' => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:20',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
            'highlight_1' => 'nullable|string|max:255',
            'highlight_2' => 'nullable|string|max:255',
            'highlight_3' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:100',
            'established' => 'nullable|string|max:50',
            'wildlife_count' => 'nullable|string|max:100',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('safari-destinations', 'public');
        }

        $destination = SafariDestination::create($validated);

        return redirect()->route('admin.safari-destinations.edit', $destination)
            ->with('success', 'Destination created! Add activities now.');
    }

    public function edit(SafariDestination $safariDestination)
    {
        $safariDestination->load('activities');
        return view('admin.safari-destinations.edit', compact('safariDestination'));
    }

    public function update(Request $request, SafariDestination $safariDestination)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'location' => 'nullable|string|max:255',
            'best_time' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icon' => 'nullable|string|max:50',
            'badge' => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:20',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
            'highlight_1' => 'nullable|string|max:255',
            'highlight_2' => 'nullable|string|max:255',
            'highlight_3' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:100',
            'established' => 'nullable|string|max:50',
            'wildlife_count' => 'nullable|string|max:100',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('safari-destinations', 'public');
        }

        $safariDestination->update($validated);

        return redirect()->route('admin.safari-destinations.index')
            ->with('success', 'Destination updated successfully!');
    }

    public function destroy(SafariDestination $safariDestination)
    {
        $safariDestination->delete();
        return redirect()->route('admin.safari-destinations.index')
            ->with('success', 'Destination deleted successfully!');
    }

    // Activity Management
    public function storeActivity(Request $request, SafariDestination $safariDestination)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'display_order' => 'integer',
        ]);

        $safariDestination->activities()->create($validated);

        return redirect()->route('admin.safari-destinations.edit', $safariDestination)
            ->with('success', 'Activity added successfully!');
    }

    public function updateActivity(Request $request, SafariActivity $activity)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'display_order' => 'integer',
        ]);

        $activity->update($validated);

        return redirect()->route('admin.safari-destinations.edit', $activity->safari_destination_id)
            ->with('success', 'Activity updated successfully!');
    }

    public function destroyActivity(SafariActivity $activity)
    {
        $destinationId = $activity->safari_destination_id;
        $activity->delete();

        return redirect()->route('admin.safari-destinations.edit', $destinationId)
            ->with('success', 'Activity deleted successfully!');
    }
}
