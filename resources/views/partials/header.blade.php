<header class="main-header">
    <!-- Announcement Bar -->
    @if($globalAnnouncement)
    <div class="announcement-bar py-2 text-center animate__animated animate__fadeInDown" style="background-color: #8b4513;">
        <div class="container">
            <span class="small fw-bold text-white">
                {{ $globalAnnouncement->content }}
                @if($globalAnnouncement->link)
                    <a href="{{ $globalAnnouncement->link }}" class="text-white text-decoration-underline ms-2">{{ $globalAnnouncement->button_text ?? 'Learn More' }}</a>
                @endif
            </span>
        </div>
    </div>
    @endif
    <!-- Top Header: Logo, Contact Info -->
    <div class="top-header py-2 px-4 px-lg-5 animate__animated animate__fadeInDown border-bottom">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="header-logo d-flex align-items-center">
                <a href="{{ url('/') }}" class="flex-shrink-0">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Go Deep Africa Safari Logo" class="img-fluid" style="max-height: 45px; width: auto; object-fit: contain;">
                </a>
            </div>
            
            <div class="header-contact-info d-flex gap-4 align-items-center">
                <div class="contact-item d-flex align-items-center gap-2">
                    <div class="icon-circle-sm bg-light shadow-sm d-none d-md-flex align-items-center justify-content-center" style="width: 35px; height: 35px; border-radius: 50%;">
                        <i class="fas fa-phone-alt text-earth small"></i>
                    </div>
                    <div>
                        <small class="d-none d-md-block text-muted" style="font-size: 0.7rem;">Call Anytime</small>
                        <a href="tel:+255794636471" class="text-decoration-none text-dark fw-bold" style="font-size: 0.9rem;">+255 794 636 471</a>
                    </div>
                </div>

                <div class="contact-item d-none d-md-flex align-items-center gap-2">
                    <div class="icon-circle-sm bg-light shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; border-radius: 50%;">
                        <i class="fas fa-envelope text-earth small"></i>
                    </div>
                    <div>
                        <small class="d-block text-muted" style="font-size: 0.7rem;">Email Us</small>
                        <a href="mailto:info@godeepafricasafari.com" class="text-decoration-none text-dark fw-bold" style="font-size: 0.9rem;">info@godeepafricasafari.com</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>

    <!-- Bottom Header: Navigation Menu -->
    <nav class="bottom-header sticky-top navbar navbar-expand-lg navbar-dark shadow-sm py-0 animate__animated animate__fadeIn">
        <div class="container-fluid px-lg-5 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <button class="navbar-toggler my-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Inquiry Button for Mobile Header -->
                <a href="#" class="btn btn-earth btn-sm px-3 rounded-pill d-lg-none" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">INQUIRY</a>
            </div>
            
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }} py-3 px-3" href="{{ url('/') }}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('tours.all') ? 'active' : '' }} py-3 px-3" href="{{ route('tours.all') }}">SAFARIS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('kilimanjaro') ? 'active' : '' }} py-3 px-3" href="{{ route('kilimanjaro') }}">KILIMANJARO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('destinations') ? 'active' : '' }} py-3 px-3" href="{{ route('destinations') }}">DESTINATIONS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('blog') ? 'active' : '' }} py-3 px-3" href="{{ route('blog') }}">BLOGS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('about') ? 'active' : '' }} py-3 px-3" href="{{ route('about') }}">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('contact') ? 'active' : '' }} py-3 px-3" href="{{ route('contact') }}">CONTACT US</a>
                    </li>
                </ul>
                
                <div class="auth-buttons d-flex gap-3 py-2 d-none d-lg-block">
                    <a href="#" class="btn btn-earth px-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">INQUIRY NOW</a>
                </div>
            </div>
        </div>
    </nav>
</header>
