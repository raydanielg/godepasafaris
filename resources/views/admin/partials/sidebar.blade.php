<div class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" height="40">
        <h6 class="mt-2 mb-0 fw-bold text-white">ADMIN PANEL</h6>
    </div>
    <nav class="mt-4">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="{{ route('admin.bookings') }}" class="nav-link {{ Route::is('admin.bookings') ? 'active' : '' }}">
            <i class="fas fa-calendar-check"></i> Bookings
        </a>
        <a href="{{ route('admin.safaris') }}" class="nav-link {{ Route::is('admin.safaris') ? 'active' : '' }}">
            <i class="fas fa-paw"></i> Safari Packages
        </a>
        <a href="{{ route('admin.kilimanjaro') }}" class="nav-link {{ Route::is('admin.kilimanjaro') ? 'active' : '' }}">
            <i class="fas fa-mountain"></i> Kili Packages
        </a>
        <a href="{{ route('admin.destinations') }}" class="nav-link {{ Route::is('admin.destinations') ? 'active' : '' }}">
            <i class="fas fa-map-marker-alt"></i> Destinations
        </a>
        <a href="{{ route('admin.posts') }}" class="nav-link {{ Route::is('admin.posts*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i> Blog Posts
        </a>
        <a href="{{ route('admin.announcements') }}" class="nav-link {{ Route::is('admin.announcements') ? 'active' : '' }}">
            <i class="fas fa-bullhorn"></i> Announcements
        </a>
        @if(auth()->user()->isAdmin())
        <a href="{{ route('admin.users') }}" class="nav-link {{ Route::is('admin.users') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Users
        </a>
        <a href="{{ route('admin.settings') }}" class="nav-link {{ Route::is('admin.settings') ? 'active' : '' }}">
            <i class="fas fa-cog"></i> Settings
        </a>
        @endif
        <hr class="mx-3 opacity-10 border-white">
        <a href="{{ url('/') }}" class="nav-link" target="_blank">
            <i class="fas fa-external-link-alt"></i> View Site
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link bg-transparent border-0 w-100 text-start" style="color: #ff6b6b;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </nav>
</div>

<style>
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
    .sidebar .nav-link {
        color: rgba(255,255,255,0.7);
        padding: 12px 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.2s;
        text-decoration: none;
    }
    .sidebar .nav-link:hover, .sidebar .nav-link.active {
        color: white;
        background: rgba(255,255,255,0.1);
        border-left: 4px solid var(--earth-light);
    }
</style>
