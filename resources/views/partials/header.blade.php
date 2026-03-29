<header class="main-header">
    <!-- Top Header: Dynamic Announcement and Contact -->
    <div class="top-header py-2 px-4 px-lg-5 animate__animated animate__fadeInDown border-bottom" style="background-color: #3E2723;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="header-contact-info d-flex gap-4 align-items-center">
                <div class="contact-item d-flex align-items-center gap-2">
                    <i class="fas fa-phone-alt" style="font-size: 0.85rem; color: #DEB887;"></i>
                    <a href="tel:+255794636471" class="text-decoration-none text-white fw-bold" style="font-size: 0.85rem;">+255 794 636 471</a>
                </div>
                <div class="contact-item d-none d-md-flex align-items-center gap-2">
                    <i class="fas fa-envelope" style="font-size: 0.85rem; color: #DEB887;"></i>
                    <a href="mailto:info@godeepafricasafari.com" class="text-decoration-none text-white fw-bold" style="font-size: 0.85rem;">info@godeepafricasafari.com</a>
                </div>
                @if($globalAnnouncement)
                <div class="announcement-text ms-4 d-none d-lg-block">
                    <span class="small fw-bold" style="color: #DEB887;">
                        {{ $globalAnnouncement->content }}
                        @if($globalAnnouncement->link)
                            <a href="{{ $globalAnnouncement->link }}" class="text-white text-decoration-underline ms-2">{{ $globalAnnouncement->button_text ?? 'Book Now' }}</a>
                        @endif
                    </span>
                </div>
                @endif
            </div>
            
            <div class="header-socials d-flex gap-3">
                <a href="https://facebook.com/godeepafricasafari" target="_blank" style="color: #DEB887;"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com/godeepafricasafari" target="_blank" style="color: #DEB887;"><i class="fab fa-instagram"></i></a>
                <a href="https://tiktok.com/@godeepafricasafari" target="_blank" style="color: #DEB887;"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
    </div>

    <!-- Bottom Header: Navigation Menu & Logo -->
    <nav class="bottom-header sticky-top navbar navbar-expand-lg navbar-light shadow-sm py-2 animate__animated animate__fadeIn mx-lg-5 mt-lg-3 rounded-pill" style="background-color: #fdfaf5;">
        <div class="container-fluid px-lg-5">
            <a href="{{ url('/') }}" class="navbar-brand me-4">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Go Deep Africa Safari" style="max-height: 55px; width: auto;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }} px-3" href="{{ url('/') }}" style="color: #3E2723 !important;">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('tours.all') ? 'active' : '' }} px-3" href="{{ route('tours.all') }}" style="color: #3E2723 !important;">SAFARIS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('kilimanjaro') ? 'active' : '' }} px-3" href="{{ route('kilimanjaro') }}" style="color: #3E2723 !important;">KILIMANJARO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('destinations') ? 'active' : '' }} px-3" href="{{ route('destinations') }}" style="color: #3E2723 !important;">DESTINATIONS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('blog*') ? 'active' : '' }} px-4" href="{{ route('blog') }}" style="color: #3E2723 !important;">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('about') ? 'active' : '' }} px-4" href="{{ route('about') }}" style="color: #3E2723 !important;">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('contact') ? 'active' : '' }} px-3" href="{{ route('contact') }}" style="color: #3E2723 !important;">CONTACT US</a>
                    </li>
                </ul>
                
                <div class="auth-buttons d-flex gap-3 align-items-center">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-earth btn-sm px-4 rounded-pill fw-bold text-white shadow-sm dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #3E2723 !important; border: none;">
                                <i class="fas fa-user-circle me-1"></i> Admin
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" aria-labelledby="userMenu">
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2 text-muted"></i>Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                    <a href="#" class="btn btn-inquiry btn-sm px-4 rounded-pill fw-bold text-white shadow-lg animate__animated animate__pulse animate__infinite" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                        INQUIRY NOW <i class="fas fa-paper-plane ms-2 small"></i>
                    </a>
                </div>

                <style>
                    .navbar-nav .nav-link {
                        color: #3E2723 !important;
                        font-weight: 600;
                        transition: all 0.3s ease;
                        position: relative;
                        padding: 10px 20px !important;
                        margin: 0 5px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    .navbar-nav .nav-link:hover {
                        color: #8b4513 !important;
                        background-color: rgba(139, 69, 19, 0.05);
                    }

                    .navbar-nav .nav-link.active {
                        background-color: #8b4513 !important;
                        color: #ffffff !important;
                        border-radius: 4px;
                    }

                    .navbar-nav .nav-link.active[style] {
                        color: #ffffff !important;
                    }

                    .btn-inquiry {
                        background: #8b4513;
                        border: 2px solid #8b4513;
                        letter-spacing: 1px;
                        padding: 12px 30px !important;
                        transition: all 0.3s ease;
                        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.2);
                        text-transform: uppercase;
                        font-size: 0.85rem;
                    }

                    .btn-inquiry:hover {
                        background: transparent;
                        color: #8b4513 !important;
                        transform: translateY(-2px);
                        box-shadow: 0 6px 20px rgba(139, 69, 19, 0.3);
                    }

                    .btn-inquiry:active {
                        transform: translateY(0) scale(0.98);
                    }
                </style>
            </div>
        </div>
    </nav>
</header>
