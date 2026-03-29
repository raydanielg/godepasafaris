@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-0">
    <!-- Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-earth-light"><i class="fas fa-shopping-cart"></i></div>
                <h3 class="fw-bold mb-1">{{ $stats['total_bookings'] }}</h3>
                <p class="text-muted mb-0 small">Total Bookings</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-earth-light"><i class="fas fa-paw"></i></div>
                <h3 class="fw-bold mb-1">{{ $stats['safari_packages'] }}</h3>
                <p class="text-muted mb-0 small">Safari Packages</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-earth-light"><i class="fas fa-mountain"></i></div>
                <h3 class="fw-bold mb-1">{{ $stats['kili_packages'] }}</h3>
                <p class="text-muted mb-0 small">Kili Packages</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-earth-light"><i class="fas fa-users"></i></div>
                <h3 class="fw-bold mb-1">{{ $stats['total_users'] }}</h3>
                <p class="text-muted mb-0 small">Admin Users</p>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="mb-0 fw-bold">Recent Inquiries</h5>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4">Customer</th>
                        <th class="border-0">Tour</th>
                        <th class="border-0">Date</th>
                        <th class="border-0">Status</th>
                        <th class="border-0 text-end px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBookings as $booking)
                    <tr>
                        <td class="px-4">
                            <p class="fw-bold mb-0 small">{{ $booking->name }}</p>
                            <small class="text-muted">{{ $booking->email }}</small>
                        </td>
                        <td><span class="small">{{ $booking->tour_name ?? 'General Inquiry' }}</span></td>
                        <td><span class="small">{{ $booking->created_at->format('M d, Y') }}</span></td>
                        <td><span class="badge bg-success-subtle text-success rounded-pill px-3">New</span></td>
                        <td class="text-end px-4">
                            <button class="btn btn-sm btn-light rounded-pill px-3">View</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">No recent inquiries found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

