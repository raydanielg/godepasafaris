<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImpactStat;
use App\Models\ImpactStory;
use App\Models\ImpactGallery;
use App\Models\ImpactTimeline;
use App\Models\ImpactPartner;
use Illuminate\Support\Str;

class ImpactController extends Controller
{
    // Dashboard/Overview
    public function index()
    {
        $stats = [
            'total_stats' => ImpactStat::count(),
            'active_stats' => ImpactStat::where('is_active', true)->count(),
            'total_stories' => ImpactStory::count(),
            'active_stories' => ImpactStory::where('is_active', true)->count(),
            'total_gallery' => ImpactGallery::count(),
            'active_gallery' => ImpactGallery::where('is_active', true)->count(),
            'total_timeline' => ImpactTimeline::count(),
            'total_partners' => ImpactPartner::count(),
        ];

        return view('admin.impact.index', compact('stats'));
    }

    // ========== STATS MANAGEMENT ==========
    public function stats()
    {
        $stats = ImpactStat::orderBy('display_order')->paginate(10);
        return view('admin.impact.stats.index', compact('stats'));
    }

    public function createStat()
    {
        return view('admin.impact.stats.create');
    }

    public function storeStat(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:50',
            'label' => 'required|string|max:255',
            'value' => 'required|integer',
            'suffix' => 'nullable|string|max:10',
            'display_order' => 'nullable|integer',
        ]);

        ImpactStat::create($request->all());
        return redirect()->route('admin.impact.stats')->with('success', 'Stat created successfully.');
    }

    public function editStat(ImpactStat $stat)
    {
        return view('admin.impact.stats.edit', compact('stat'));
    }

    public function updateStat(Request $request, ImpactStat $stat)
    {
        $request->validate([
            'icon' => 'required|string|max:50',
            'label' => 'required|string|max:255',
            'value' => 'required|integer',
            'suffix' => 'nullable|string|max:10',
            'display_order' => 'nullable|integer',
        ]);

        $stat->update($request->all());
        return redirect()->route('admin.impact.stats')->with('success', 'Stat updated successfully.');
    }

    public function deleteStat(ImpactStat $stat)
    {
        $stat->delete();
        return back()->with('success', 'Stat deleted successfully.');
    }

    public function toggleStatStatus(ImpactStat $stat)
    {
        $stat->update(['is_active' => !$stat->is_active]);
        return back()->with('success', 'Stat status updated.');
    }

    // ========== STORIES MANAGEMENT ==========
    public function stories()
    {
        $stories = ImpactStory::orderBy('display_order')->paginate(10);
        return view('admin.impact.stories.index', compact('stories'));
    }

    public function createStory()
    {
        return view('admin.impact.stories.create');
    }

    public function storeStory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'badge' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'quote' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:50',
            'display_order' => 'nullable|integer',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images/impact/stories'), $imageName);
            $data['image'] = 'images/impact/stories/' . $imageName;
        }

        ImpactStory::create($data);
        return redirect()->route('admin.impact.stories')->with('success', 'Story created successfully.');
    }

    public function editStory(ImpactStory $story)
    {
        return view('admin.impact.stories.edit', compact('story'));
    }

    public function updateStory(Request $request, ImpactStory $story)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'badge' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'quote' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:50',
            'display_order' => 'nullable|integer',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($story->image && file_exists(public_path($story->image))) {
                unlink(public_path($story->image));
            }

            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images/impact/stories'), $imageName);
            $data['image'] = 'images/impact/stories/' . $imageName;
        }

        $story->update($data);
        return redirect()->route('admin.impact.stories')->with('success', 'Story updated successfully.');
    }

    public function deleteStory(ImpactStory $story)
    {
        // Delete image file
        if ($story->image && file_exists(public_path($story->image))) {
            unlink(public_path($story->image));
        }

        $story->delete();
        return back()->with('success', 'Story deleted successfully.');
    }

    public function toggleStoryStatus(ImpactStory $story)
    {
        $story->update(['is_active' => !$story->is_active]);
        return back()->with('success', 'Story status updated.');
    }

    public function toggleStoryFeatured(ImpactStory $story)
    {
        $story->update(['is_featured' => !$story->is_featured]);
        return back()->with('success', 'Story featured status updated.');
    }

    // ========== GALLERY MANAGEMENT ==========
    public function gallery()
    {
        $gallery = ImpactGallery::orderBy('display_order')->paginate(12);
        return view('admin.impact.gallery.index', compact('gallery'));
    }

    public function createGallery()
    {
        return view('admin.impact.gallery.create');
    }

    public function storeGallery(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'nullable|string|max:255',
            'category' => 'required|string|max:50',
            'column_width' => 'required|integer|in:4,6,12',
            'display_order' => 'nullable|integer',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images/impact/gallery'), $imageName);
            $data['image'] = 'images/impact/gallery/' . $imageName;
        }

        ImpactGallery::create($data);
        return redirect()->route('admin.impact.gallery')->with('success', 'Gallery item created successfully.');
    }

    public function editGallery(ImpactGallery $gallery)
    {
        return view('admin.impact.gallery.edit', compact('gallery'));
    }

    public function updateGallery(Request $request, ImpactGallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'nullable|string|max:255',
            'category' => 'required|string|max:50',
            'column_width' => 'required|integer|in:4,6,12',
            'display_order' => 'nullable|integer',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image && file_exists(public_path($gallery->image))) {
                unlink(public_path($gallery->image));
            }

            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images/impact/gallery'), $imageName);
            $data['image'] = 'images/impact/gallery/' . $imageName;
        }

        $gallery->update($data);
        return redirect()->route('admin.impact.gallery')->with('success', 'Gallery item updated successfully.');
    }

    public function deleteGallery(ImpactGallery $gallery)
    {
        // Delete image file
        if ($gallery->image && file_exists(public_path($gallery->image))) {
            unlink(public_path($gallery->image));
        }

        $gallery->delete();
        return back()->with('success', 'Gallery item deleted successfully.');
    }

    public function toggleGalleryStatus(ImpactGallery $gallery)
    {
        $gallery->update(['is_active' => !$gallery->is_active]);
        return back()->with('success', 'Gallery item status updated.');
    }

    // ========== TIMELINE MANAGEMENT ==========
    public function timeline()
    {
        $timeline = ImpactTimeline::orderBy('display_order')->paginate(10);
        return view('admin.impact.timeline.index', compact('timeline'));
    }

    public function createTimeline()
    {
        return view('admin.impact.timeline.create');
    }

    public function storeTimeline(Request $request)
    {
        $request->validate([
            'year' => 'required|string|max:10',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'display_order' => 'nullable|integer',
        ]);

        ImpactTimeline::create($request->all());
        return redirect()->route('admin.impact.timeline')->with('success', 'Timeline event created successfully.');
    }

    public function editTimeline(ImpactTimeline $timeline)
    {
        return view('admin.impact.timeline.edit', compact('timeline'));
    }

    public function updateTimeline(Request $request, ImpactTimeline $timeline)
    {
        $request->validate([
            'year' => 'required|string|max:10',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'display_order' => 'nullable|integer',
        ]);

        $timeline->update($request->all());
        return redirect()->route('admin.impact.timeline')->with('success', 'Timeline event updated successfully.');
    }

    public function deleteTimeline(ImpactTimeline $timeline)
    {
        $timeline->delete();
        return back()->with('success', 'Timeline event deleted successfully.');
    }

    public function toggleTimelineStatus(ImpactTimeline $timeline)
    {
        $timeline->update(['is_active' => !$timeline->is_active]);
        return back()->with('success', 'Timeline event status updated.');
    }

    // ========== PARTNERS MANAGEMENT ==========
    public function partners()
    {
        $partners = ImpactPartner::orderBy('display_order')->paginate(10);
        return view('admin.impact.partners.index', compact('partners'));
    }

    public function createPartner()
    {
        return view('admin.impact.partners.create');
    }

    public function storePartner(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:50',
            'description' => 'nullable|string',
            'website_url' => 'nullable|url',
            'display_order' => 'nullable|integer',
        ]);

        ImpactPartner::create($request->all());
        return redirect()->route('admin.impact.partners')->with('success', 'Partner created successfully.');
    }

    public function editPartner(ImpactPartner $partner)
    {
        return view('admin.impact.partners.edit', compact('partner'));
    }

    public function updatePartner(Request $request, ImpactPartner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:50',
            'description' => 'nullable|string',
            'website_url' => 'nullable|url',
            'display_order' => 'nullable|integer',
        ]);

        $partner->update($request->all());
        return redirect()->route('admin.impact.partners')->with('success', 'Partner updated successfully.');
    }

    public function deletePartner(ImpactPartner $partner)
    {
        $partner->delete();
        return back()->with('success', 'Partner deleted successfully.');
    }

    public function togglePartnerStatus(ImpactPartner $partner)
    {
        $partner->update(['is_active' => !$partner->is_active]);
        return back()->with('success', 'Partner status updated.');
    }
}
