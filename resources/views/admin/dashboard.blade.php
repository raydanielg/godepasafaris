<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Go Deep Africa Safari</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 260px;
            --earth-brown: #8b4513;
            --earth-light: #deb887;
        }
        body { background-color: #f8f9fa; }
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #2c1810;
            color: white;
            z-index: 1000;
            transition: all 0.3s;
        }
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }
        .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            border-left: 4px solid var(--earth-light);
        }
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
        }
        .top-nav {
            background: white;
            padding: 15px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        .bg-earth-light { background-color: rgba(139, 69, 19, 0.1); color: #8b4513; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" height="40">
            <h6 class="mt-2 mb-0 fw-bold">ADMIN PANEL</h6>
        </div>
        <nav class="mt-4">
            <a href="#" class="nav-link active"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="#" class="nav-link"><i class="fas fa-calendar-check"></i> Bookings</a>
            <a href="#" class="nav-link"><i class="fas fa-paw"></i> Safari Packages</a>
            <a href="#" class="nav-link"><i class="fas fa-mountain"></i> Kili Packages</a>
            <a href="#" class="nav-link"><i class="fas fa-newspaper"></i> Blog Posts</a>
            <a href="#" class="nav-link"><i class="fas fa-bullhorn"></i> Announcements</a>
            <a href="#" class="nav-link"><i class="fas fa-users"></i> Users</a>
            <hr class="mx-3 opacity-10">
            <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-external-link-alt"></i> View Site</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link bg-transparent border-0 w-100 text-start" style="color: #ff6b6b;"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header class="top-nav">
            <h4 class="mb-0 fw-bold">Welcome back, {{ Auth::user()->name }}!</h4>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <p class="mb-0 fw-bold small text-dark">{{ Auth::user()->name }}</p>
                    <small class="text-muted text-uppercase" style="font-size: 0.6rem;">{{ Auth::user()->role }}</small>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=8b4513&color=fff" class="rounded-circle" width="40" height="40">
            </div>
        </header>

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
    </div>
</body>
</html>
