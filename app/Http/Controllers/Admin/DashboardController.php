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
            'total_users' => \App\Models\User::count(),
        ];

        $recentBookings = \App\Models\Booking::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}
