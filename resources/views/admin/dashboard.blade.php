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
<div class="container-fluid p-0 py-2">
    <!-- Header Greeting -->
    <div class="d-flex justify-content-between align-items-center mb-4 px-3">
        <div>
            <h2 class="h4 mb-0 text-gray-800 fw-bold">Habari, {{ auth()->user()->name }}!</h2>
            <p class="text-muted small mb-0">Karibu kwenye mfumo wako wa usimamizi wa safari.</p>
        </div>
        <div class="text-end d-none d-md-block">
            <div class="badge bg-white text-dark border rounded-pill px-3 py-2 shadow-sm">
                <i class="fas fa-calendar-alt text-earth me-2" style="color: #8b4513;"></i>
                {{ date('M d, Y') }}
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row g-4 mb-4 px-3">
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
                <p class="text-muted mb-0 small">System Users</p>
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
                    <a href="{{ route('admin.bookings') }}" class="btn btn-sm btn-earth text-white rounded-pill px-3">View All</a>
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
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-sm bg-earth-light text-earth rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                            <i class="fas fa-user small"></i>
                                        </div>
                                        <div>
                                            <p class="fw-bold mb-0 small">{{ $booking->name }}</p>
                                            <small class="text-muted" style="font-size: 0.7rem;">{{ $booking->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="small text-truncate d-inline-block" style="max-width: 150px;" title="{{ $booking->tour_name ?? 'General Inquiry' }}">
                                        {{ $booking->tour_name ?? 'General Inquiry' }}
                                    </span>
                                </td>
                                <td><span class="small text-muted">{{ $booking->created_at->format('M d, Y') }}</span></td>
                                <td>
                                    @if($booking->status == 'pending' || !$booking->status)
                                        <span class="badge bg-warning-subtle text-warning rounded-pill px-3" style="font-size: 0.65rem;">PENDING</span>
                                    @else
                                        <span class="badge bg-success-subtle text-success rounded-pill px-3" style="font-size: 0.65rem;">{{ strtoupper($booking->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-end px-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="mailto:{{ $booking->email }}" class="btn btn-sm btn-light rounded-circle" title="Email Customer">
                                            <i class="fas fa-envelope text-earth small"></i>
                                        </a>
                                        <button class="btn btn-sm btn-light rounded-circle" title="View Details">
                                            <i class="fas fa-eye text-earth small"></i>
                                        </button>
                                    </div>
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
    // Main Multi-Line Chart (Inquiry Trends)
    const ctxMain = document.getElementById('mainChart').getContext('2d');
    
    // Gradient for the primary line
    const gradient = ctxMain.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(139, 69, 19, 0.2)');
    gradient.addColorStop(1, 'rgba(139, 69, 19, 0)');

    new Chart(ctxMain, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [
                {
                    label: 'New Inquiries',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    borderColor: '#8b4513',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#8b4513',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Website Visits',
                    data: [28, 48, 40, 19, 86, 27, 90],
                    borderColor: '#deb887',
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    pointRadius: 0,
                    tension: 0.4,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index',
            },
            plugins: { 
                legend: { 
                    position: 'top', 
                    align: 'end',
                    labels: {
                        boxWidth: 10,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#3E2723',
                    bodyColor: '#666',
                    borderColor: '#eee',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: true,
                    callbacks: {
                        labelPointStyle: function(context) {
                            return { pointStyle: 'circle', rotation: 0 };
                        }
                    }
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: '#f8f9fa', drawBorder: false },
                    ticks: { color: '#adb5bd', font: { size: 11 } }
                },
                x: { 
                    grid: { display: false, drawBorder: false },
                    ticks: { color: '#adb5bd', font: { size: 11 } }
                }
            }
        }
    });

    // Distribution Chart (Enhanced Doughnut)
    const ctxDist = document.getElementById('distributionChart').getContext('2d');
    new Chart(ctxDist, {
        type: 'doughnut',
        data: {
            labels: ['Safari', 'Kilimanjaro', 'Destinations', 'Blogs'],
            datasets: [{
                data: [
                    {{ $stats['safari_packages'] }}, 
                    {{ $stats['kili_packages'] }}, 
                    {{ $stats['total_destinations'] }}, 
                    {{ $stats['total_posts'] }}
                ],
                backgroundColor: ['#8b4513', '#deb887', '#3E2723', '#A0522D'],
                hoverOffset: 20,
                borderWidth: 0,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: { 
                legend: { 
                    position: 'bottom', 
                    labels: { 
                        padding: 25, 
                        usePointStyle: true, 
                        pointStyle: 'circle',
                        font: { size: 12 }
                    } 
                },
                tooltip: {
                    padding: 12,
                    backgroundColor: '#fff',
                    titleColor: '#3E2723',
                    bodyColor: '#666',
                    borderColor: '#eee',
                    borderWidth: 1
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
</script>
@endpush

