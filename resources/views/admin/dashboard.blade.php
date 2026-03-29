@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<style>
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }
    .activity-feed {
        list-style: none;
        padding: 0;
    }
    .activity-item {
        padding: 15px 0;
        border-bottom: 1px solid #eee;
        display: flex;
        gap: 15px;
    }
    .activity-item:last-child { border-bottom: none; }
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <!-- Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-2">
            <div class="stat-card h-100">
                <div class="stat-icon bg-earth-light"><i class="fas fa-shopping-cart"></i></div>
                <h4 class="fw-bold mb-1">{{ $stats['total_bookings'] }}</h4>
                <p class="text-muted mb-0 small">Total Inquiries</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card h-100">
                <div class="stat-icon bg-earth-light"><i class="fas fa-paw"></i></div>
                <h4 class="fw-bold mb-1">{{ $stats['safari_packages'] }}</h4>
                <p class="text-muted mb-0 small">Safari Packages</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card h-100">
                <div class="stat-icon bg-earth-light"><i class="fas fa-mountain"></i></div>
                <h4 class="fw-bold mb-1">{{ $stats['kili_packages'] }}</h4>
                <p class="text-muted mb-0 small">Kili Treks</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card h-100">
                <div class="stat-icon bg-earth-light"><i class="fas fa-map-marker-alt"></i></div>
                <h4 class="fw-bold mb-1">{{ $stats['total_destinations'] }}</h4>
                <p class="text-muted mb-0 small">Destinations</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card h-100">
                <div class="stat-icon bg-earth-light"><i class="fas fa-newspaper"></i></div>
                <h4 class="fw-bold mb-1">{{ $stats['total_posts'] }}</h4>
                <p class="text-muted mb-0 small">Blog Posts</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card h-100">
                <div class="stat-icon bg-earth-light"><i class="fas fa-users"></i></div>
                <h4 class="fw-bold mb-1">{{ $stats['total_users'] }}</h4>
                <p class="text-muted mb-0 small">Admin Users</p>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Inquiry & Content Trends</h5>
                    <div class="small text-muted">Last 7 Days</div>
                </div>
                <div class="chart-container">
                    <canvas id="mainChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h5 class="fw-bold mb-4">Category Distribution</h5>
                <div class="chart-container">
                    <canvas id="distributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Inquiries -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Recent Inquiries</h5>
                    <a href="#" class="btn btn-sm btn-earth text-white rounded-pill px-3">View All</a>
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

        <!-- Activity Log -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h5 class="fw-bold mb-4">Activity Log</h5>
                <ul class="activity-feed">
                    @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                    <li class="activity-item">
                        <div class="activity-icon bg-earth-light">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <p class="mb-0 small fw-bold">{{ $user->name }} joined as Admin</p>
                            <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                        </div>
                    </li>
                    @endforeach
                    @foreach($recentBookings->take(2) as $booking)
                    <li class="activity-item">
                        <div class="activity-icon bg-success-subtle text-success">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <p class="mb-0 small fw-bold">New inquiry from {{ $booking->name }}</p>
                            <small class="text-muted">{{ $booking->created_at->diffForHumans() }}</small>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Main Multi-Line Chart
    const ctxMain = document.getElementById('mainChart').getContext('2d');
    new Chart(ctxMain, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [
                {
                    label: 'Inquiries',
                    data: [12, 19, 3, 5, 2, 3, 9],
                    borderColor: '#8b4513',
                    backgroundColor: 'rgba(139, 69, 19, 0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Destinations',
                    data: [2, 5, 1, 8, 4, 6, 3],
                    borderColor: '#deb887',
                    backgroundColor: 'transparent',
                    borderDash: [5, 5],
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'top', align: 'end' } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Distribution Chart (Enhanced)
    const ctxDist = document.getElementById('distributionChart').getContext('2d');
    new Chart(ctxDist, {
        type: 'doughnut',
        data: {
            labels: ['Safari', 'Kili', 'Destinations', 'Blogs'],
            datasets: [{
                data: [
                    {{ $stats['safari_packages'] }}, 
                    {{ $stats['kili_packages'] }}, 
                    {{ $stats['total_destinations'] }}, 
                    {{ $stats['total_posts'] }}
                ],
                backgroundColor: ['#8b4513', '#deb887', '#3E2723', '#A0522D'],
                hoverOffset: 15,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: { 
                legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true } } 
            }
        }
    });
</script>
@endpush

