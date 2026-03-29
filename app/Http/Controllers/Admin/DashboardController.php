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
}
