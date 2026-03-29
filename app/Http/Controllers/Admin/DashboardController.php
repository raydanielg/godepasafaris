<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\SafariPackage;
use App\Models\KilimanjaroPackage;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => \App\Models\Booking::count(),
            'safari_packages' => \App\Models\SafariPackage::count(),
            'kili_packages' => \App\Models\KilimanjaroPackage::count(),
            'total_destinations' => \App\Models\Destination::count(),
            'total_users' => \App\Models\User::count(),
            'total_posts' => \App\Models\Post::count(),
        ];

        $recentBookings = \App\Models\Booking::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function deleteAccount()
    {
        $user = auth()->user();
        auth()->logout();
        $user->delete();
        return redirect('/')->with('success', 'Your account has been successfully deleted.');
    }

    public function destinations()
    {
        $destinations = \App\Models\Destination::latest()->paginate(10);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function bookings()
    {
        $bookings = \App\Models\Booking::latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function safariPackages()
    {
        $packages = \App\Models\SafariPackage::latest()->paginate(10);
        return view('admin.safaris.index', compact('packages'));
    }

    public function kiliPackages()
    {
        $packages = \App\Models\KilimanjaroPackage::latest()->paginate(10);
        return view('admin.kilimanjaro.index', compact('packages'));
    }

    public function posts()
    {
        $posts = \App\Models\Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function createPost()
    {
        return view('admin.posts.create');
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/blog'), $imageName);
            $data['image'] = 'images/blog/' . $imageName;
        }

        \App\Models\Post::create($data);

        return redirect()->route('admin.posts')->with('success', 'Blog post created successfully.');
    }

    public function editPost(\App\Models\Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function updatePost(Request $request, \App\Models\Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/blog'), $imageName);
            $data['image'] = 'images/blog/' . $imageName;
        }

        $post->update($data);

        return redirect()->route('admin.posts')->with('success', 'Blog post updated successfully.');
    }

    public function deletePost(\App\Models\Post $post)
    {
        $post->delete();
        return back()->with('success', 'Blog post deleted successfully.');
    }

    public function uploadEditorImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->move(public_path('images/blog/content'), $filename);
            return response()->json(['location' => asset('images/blog/content/' . $filename)]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function announcements()
    {
        $announcements = \App\Models\Announcement::latest()->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'link' => 'nullable|url',
            'button_text' => 'nullable|string|max:50',
            'status' => 'required|in:active,expired',
        ]);

        \App\Models\Announcement::create($request->all());
        return back()->with('success', 'Announcement added successfully.');
    }

    public function deleteAnnouncement(\App\Models\Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Announcement deleted successfully.');
    }

    public function updateAnnouncementStatus(Request $request, \App\Models\Announcement $announcement)
    {
        $request->validate(['status' => 'required|in:active,expired']);
        $announcement->update(['status' => $request->status]);
        return back()->with('success', 'Announcement status updated.');
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin,sub_admin'
        ]);

        $user->update(['role' => $request->role]);
        return back()->with('success', 'User role updated successfully.');
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function settings()
    {
        $settings = [
            'site_name' => config('app.name'),
            'contact_email' => 'info@godeepafricasafari.com',
            'contact_phone' => '+255 794 636 471',
        ];
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        // For now, just a placeholder for updating settings
        return back()->with('success', 'Settings updated successfully.');
    }
}
