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
            'total_bookings' => Booking::count(),
            'safari_packages' => SafariPackage::count(),
            'kili_packages' => KilimanjaroPackage::count(),
            'total_users' => User::count(),
        ];

        $recentBookings = Booking::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}
