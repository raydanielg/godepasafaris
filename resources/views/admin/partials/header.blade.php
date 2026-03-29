<header class="top-nav">
    <div class="d-flex align-items-center gap-3">
        <h4 class="mb-0 fw-bold text-dark">Dashboard</h4>
    </div>
    <div class="d-flex align-items-center gap-3">
        <div class="text-end d-none d-md-block">
            <p class="mb-0 fw-bold small text-dark">{{ Auth::user()->name }}</p>
            <small class="text-muted text-uppercase" style="font-size: 0.6rem;">{{ Auth::user()->role }}</small>
        </div>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=8b4513&color=fff" class="rounded-circle shadow-sm" width="40" height="40">
            </a>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3">
                <li><a class="dropdown-item py-2" href="#"><i class="fas fa-user-circle me-2"></i> Profile</a></li>
                <li><a class="dropdown-item py-2" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item py-2 text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<style>
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
</style>
