<header class="main-header">
    <!-- Top Header: Dynamic Announcement and Contact -->
    <div class="top-header py-2 px-4 px-lg-5 animate__animated animate__fadeInDown border-bottom" style="background-color: #3E2723;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="header-contact-info d-flex gap-4 align-items-center">
                <div class="contact-item d-flex align-items-center gap-2">
                    <i class="fas fa-phone-alt" style="font-size: 0.85rem; color: #DEB887;"></i>
                    <a href="https://wa.me/966542586758" class="text-white text-decoration-none">
                        <i class="fab fa-whatsapp me-2"></i> +966 54 258 6758
                    </a>
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
                <a href="https://www.facebook.com/share/1DkJwJSKre/" target="_blank" style="color: #DEB887;"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.tiktok.com/@godeepafricasafar?_r=1&_d=ea2f55g68hamde&sec_uid=MS4wLjABAAAA9QgYff6T9D5ggw4R-sHMM3ZvjRY2rWL-pGeGJJK-7KDhR10NfGWPaBFuB-3cCedE&share_author_id=7360181590935782405&sharer_language=en&source=h5_m&u_code=edjg8mim3bfcak&timestamp=1774716159&user_id=7360181590935782405&sec_user_id=MS4wLjABAAAA9QgYff6T9D5ggw4R-sHMM3ZvjRY2rWL-pGeGJJK-7KDhR10NfGWPaBFuB-3cCedE&item_author_type=1&utm_source=copy&utm_campaign=client_share&utm_medium=android&share_iid=7620799729350444820&share_link_id=9863272e-6781-4c72-96fc-8cd3d626e0c3&share_app_id=1233&ugbiz_name=ACCOUNT&ug_btm=b8727%2Cb7360&social_share_type=5&enable_checksum=1" target="_blank" style="color: #DEB887;"><i class="fab fa-instagram"></i></a>
                <a href="https://www.tiktok.com/@godeepafricasafar?_r=1&_d=ea2f55g68hamde&sec_uid=MS4wLjABAAAA9QgYff6T9D5ggw4R-sHMM3ZvjRY2rWL-pGeGJJK-7KDhR10NfGWPaBFuB-3cCedE&share_author_id=7360181590935782405&sharer_language=en&source=h5_m&u_code=edjg8mim3bfcak&timestamp=1774716159&user_id=7360181590935782405&sec_user_id=MS4wLjABAAAA9QgYff6T9D5ggw4R-sHMM3ZvjRY2rWL-pGeGJJK-7KDhR10NfGWPaBFuB-3cCedE&item_author_type=1&utm_source=copy&utm_campaign=client_share&utm_medium=android&share_iid=7620799729350444820&share_link_id=9863272e-6781-4c72-96fc-8cd3d626e0c3&share_app_id=1233&ugbiz_name=ACCOUNT&ug_btm=b8727%2Cb7360&social_share_type=5&enable_checksum=1" target="_blank" style="color: #DEB887;"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.threads.com/@godeepafricasafariexpendition" target="_blank" style="color: #DEB887;"><i class="fa-brands fa-threads"></i></a>
            </div>
        </div>
    </div>

    <!-- Bottom Header: Navigation Menu & Logo with Mega Menu -->
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
                    
                    <!-- SAFARI Mega Menu -->
                    <li class="nav-item has-mega-menu position-static">
                        <a class="nav-link {{ Route::is('tours.all') || Route::is('safari*') ? 'active' : '' }} px-3" href="{{ route('tours.all') }}" style="color: #3E2723 !important;" id="safariMegaMenu">
                            SAFARIS <i class="fas fa-chevron-down ms-1 small"></i>
                        </a>
                        @php
                            $safariSection = \App\Models\MenuSection::forNavItem('safari')->first();
                            $safariLinks = $safariSection ? $safariSection->links()->active()->get() : collect();
                        @endphp
                        @if($safariSection && $safariLinks->count() > 0)
                        <div class="mega-menu-wrapper">
                            <div class="mega-menu-container">
                                <div class="mega-menu-content">
                                    <div class="row g-0">
                                        <div class="col-lg-5 mega-menu-links">
                                            <div class="p-4">
                                                <h6 class="text-uppercase fw-bold mb-3" style="color: #8B4513; font-size: 0.8rem; letter-spacing: 1px;">
                                                    <i class="fas fa-paw me-2"></i>Popular Safaris
                                                </h6>
                                                <div class="mega-links-list">
                                                    @foreach($safariLinks as $link)
                                                    <a href="{{ $link->url }}" class="mega-link-item d-flex align-items-center p-2 rounded text-decoration-none">
                                                        <div class="mega-link-icon me-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(139, 69, 19, 0.1);">
                                                            <i class="fas {{ $link->icon }}" style="color: #8B4513;"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center">
                                                                <span class="fw-medium" style="color: #3E2723;">{{ $link->title }}</span>
                                                                @if($link->badge)
                                                                <span class="badge ms-2" style="font-size: 0.65rem; background: {{ $link->badge_color == 'success' ? '#28a745' : ($link->badge_color == 'danger' ? '#dc3545' : ($link->badge_color == 'warning' ? '#ffc107' : '#6c757d')) }};">{{ $link->badge }}</span>
                                                                @endif
                                                            </div>
                                                            @if($link->description)
                                                            <small class="text-muted d-block" style="font-size: 0.75rem;">{{ $link->description }}</small>
                                                            @endif
                                                        </div>
                                                        <i class="fas fa-chevron-right ms-2 text-muted small"></i>
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 mega-menu-featured">
                                            <div class="h-100 p-4" style="background: linear-gradient(135deg, rgba(62,39,35,0.05) 0%, rgba(139,69,19,0.05) 100%);">
                                                <div class="row h-100 align-items-center">
                                                    <div class="col-md-6">
                                                        <span class="badge mb-2" style="background: {{ $safariSection->badge_color == 'success' ? '#28a745' : '#8B4513' }}; font-size: 0.7rem;">
                                                            <i class="fas fa-star me-1"></i>{{ $safariSection->badge }}
                                                        </span>
                                                        <h4 class="fw-bold mb-2" style="color: #3E2723; font-family: 'Playfair Display', serif;">{{ $safariSection->title }}</h4>
                                                        <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.6;">{{ $safariSection->description }}</p>
                                                        <a href="{{ $safariSection->link_url }}" class="btn btn-sm rounded-pill px-4 py-2 text-white" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); font-size: 0.85rem;">
                                                            {{ $safariSection->link_text }} <i class="fas fa-arrow-right ms-2"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mega-menu-image rounded-4 overflow-hidden shadow-lg">
                                                            <img src="{{ $safariSection->image }}" class="w-100" style="height: 220px; object-fit: cover;" alt="{{ $safariSection->title }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </li>
                    
                    <!-- KILIMANJARO Mega Menu -->
                    <li class="nav-item has-mega-menu position-static">
                        <a class="nav-link {{ Route::is('kilimanjaro*') ? 'active' : '' }} px-3" href="{{ route('kilimanjaro') }}" style="color: #3E2723 !important;" id="kiliMegaMenu">
                            KILIMANJARO <i class="fas fa-chevron-down ms-1 small"></i>
                        </a>
                        @php
                            $kiliSection = \App\Models\MenuSection::forNavItem('kilimanjaro')->first();
                            $kiliLinks = $kiliSection ? $kiliSection->links()->active()->get() : collect();
                        @endphp
                        @if($kiliSection && $kiliLinks->count() > 0)
                        <div class="mega-menu-wrapper">
                            <div class="mega-menu-container">
                                <div class="mega-menu-content">
                                    <div class="row g-0">
                                        <div class="col-lg-5 mega-menu-links">
                                            <div class="p-4">
                                                <h6 class="text-uppercase fw-bold mb-3" style="color: #8B4513; font-size: 0.8rem; letter-spacing: 1px;">
                                                    <i class="fas fa-mountain me-2"></i>Climbing Guide
                                                </h6>
                                                <div class="mega-links-list">
                                                    @foreach($kiliLinks as $link)
                                                    <a href="{{ $link->url }}" class="mega-link-item d-flex align-items-center p-2 rounded text-decoration-none">
                                                        <div class="mega-link-icon me-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(139, 69, 19, 0.1);">
                                                            <i class="fas {{ $link->icon }}" style="color: #8B4513;"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center">
                                                                <span class="fw-medium" style="color: #3E2723;">{{ $link->title }}</span>
                                                                @if($link->badge)
                                                                <span class="badge ms-2" style="font-size: 0.65rem; background: {{ $link->badge_color == 'success' ? '#28a745' : ($link->badge_color == 'danger' ? '#dc3545' : ($link->badge_color == 'warning' ? '#ffc107' : '#6c757d')) }};">{{ $link->badge }}</span>
                                                                @endif
                                                            </div>
                                                            @if($link->description)
                                                            <small class="text-muted d-block" style="font-size: 0.75rem;">{{ $link->description }}</small>
                                                            @endif
                                                        </div>
                                                        <i class="fas fa-chevron-right ms-2 text-muted small"></i>
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 mega-menu-featured">
                                            <div class="h-100 p-4" style="background: linear-gradient(135deg, rgba(62,39,35,0.05) 0%, rgba(139,69,19,0.05) 100%);">
                                                <div class="row h-100 align-items-center">
                                                    <div class="col-md-6">
                                                        <span class="badge mb-2" style="background: {{ $kiliSection->badge_color == 'success' ? '#28a745' : '#8B4513' }}; font-size: 0.7rem;">
                                                            <i class="fas fa-star me-1"></i>{{ $kiliSection->badge }}
                                                        </span>
                                                        <h4 class="fw-bold mb-2" style="color: #3E2723; font-family: 'Playfair Display', serif;">{{ $kiliSection->title }}</h4>
                                                        <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.6;">{{ $kiliSection->description }}</p>
                                                        <a href="{{ $kiliSection->link_url }}" class="btn btn-sm rounded-pill px-4 py-2 text-white" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); font-size: 0.85rem;">
                                                            {{ $kiliSection->link_text }} <i class="fas fa-arrow-right ms-2"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mega-menu-image rounded-4 overflow-hidden shadow-lg">
                                                            <img src="{{ $kiliSection->image }}" class="w-100" style="height: 220px; object-fit: cover;" alt="{{ $kiliSection->title }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </li>
                    
                    <!-- DESTINATIONS Mega Menu -->
                    <li class="nav-item has-mega-menu position-static">
                        <a class="nav-link {{ Route::is('destinations*') ? 'active' : '' }} px-3" href="{{ route('destinations') }}" style="color: #3E2723 !important;" id="destMegaMenu">
                            DESTINATIONS <i class="fas fa-chevron-down ms-1 small"></i>
                        </a>
                        @php
                            $destSection = \App\Models\MenuSection::forNavItem('destinations')->first();
                            $destLinks = $destSection ? $destSection->links()->active()->get() : collect();
                        @endphp
                        @if($destSection && $destLinks->count() > 0)
                        <div class="mega-menu-wrapper">
                            <div class="mega-menu-container">
                                <div class="mega-menu-content">
                                    <div class="row g-0">
                                        <div class="col-lg-5 mega-menu-links">
                                            <div class="p-4">
                                                <h6 class="text-uppercase fw-bold mb-3" style="color: #8B4513; font-size: 0.8rem; letter-spacing: 1px;">
                                                    <i class="fas fa-map-marker-alt me-2"></i>Explore Tanzania
                                                </h6>
                                                <div class="mega-links-list">
                                                    @foreach($destLinks as $link)
                                                    <a href="{{ $link->url }}" class="mega-link-item d-flex align-items-center p-2 rounded text-decoration-none">
                                                        <div class="mega-link-icon me-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(139, 69, 19, 0.1);">
                                                            <i class="fas {{ $link->icon }}" style="color: #8B4513;"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center">
                                                                <span class="fw-medium" style="color: #3E2723;">{{ $link->title }}</span>
                                                                @if($link->badge)
                                                                <span class="badge ms-2" style="font-size: 0.65rem; background: {{ $link->badge_color == 'success' ? '#28a745' : ($link->badge_color == 'danger' ? '#dc3545' : ($link->badge_color == 'warning' ? '#ffc107' : '#6c757d')) }};">{{ $link->badge }}</span>
                                                                @endif
                                                            </div>
                                                            @if($link->description)
                                                            <small class="text-muted d-block" style="font-size: 0.75rem;">{{ $link->description }}</small>
                                                            @endif
                                                        </div>
                                                        <i class="fas fa-chevron-right ms-2 text-muted small"></i>
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 mega-menu-featured">
                                            <div class="h-100 p-4" style="background: linear-gradient(135deg, rgba(62,39,35,0.05) 0%, rgba(139,69,19,0.05) 100%);">
                                                <div class="row h-100 align-items-center">
                                                    <div class="col-md-6">
                                                        <span class="badge mb-2" style="background: {{ $destSection->badge_color == 'info' ? '#17a2b8' : '#8B4513' }}; font-size: 0.7rem;">
                                                            <i class="fas fa-compass me-1"></i>{{ $destSection->badge }}
                                                        </span>
                                                        <h4 class="fw-bold mb-2" style="color: #3E2723; font-family: 'Playfair Display', serif;">{{ $destSection->title }}</h4>
                                                        <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.6;">{{ $destSection->description }}</p>
                                                        <a href="{{ $destSection->link_url }}" class="btn btn-sm rounded-pill px-4 py-2 text-white" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); font-size: 0.85rem;">
                                                            {{ $destSection->link_text }} <i class="fas fa-arrow-right ms-2"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mega-menu-image rounded-4 overflow-hidden shadow-lg">
                                                            <img src="{{ $destSection->image }}" class="w-100" style="height: 220px; object-fit: cover;" alt="{{ $destSection->title }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </li>
                    
                    <!-- IMPACT / GIVING BACK Mega Menu -->
                    <li class="nav-item has-mega-menu position-static">
                        <a class="nav-link {{ Route::is('impact*') ? 'active' : '' }} px-3" href="{{ route('impact') }}" style="color: #3E2723 !important;" id="impactMegaMenu">
                            GIVING BACK <i class="fas fa-chevron-down ms-1 small"></i>
                        </a>
                        @php
                            $impactSection = \App\Models\MenuSection::forNavItem('impact')->first();
                            $impactLinks = $impactSection ? $impactSection->links()->active()->get() : collect();
                        @endphp
                        @if($impactSection && $impactLinks->count() > 0)
                        <div class="mega-menu-wrapper">
                            <div class="mega-menu-container">
                                <div class="mega-menu-content">
                                    <div class="row g-0">
                                        <div class="col-lg-5 mega-menu-links">
                                            <div class="p-4">
                                                <h6 class="text-uppercase fw-bold mb-3" style="color: #8B4513; font-size: 0.8rem; letter-spacing: 1px;">
                                                    <i class="fas fa-heart me-2"></i>Our Impact Areas
                                                </h6>
                                                <div class="mega-links-list">
                                                    @foreach($impactLinks as $link)
                                                    <a href="{{ $link->url }}" class="mega-link-item d-flex align-items-center p-2 rounded text-decoration-none">
                                                        <div class="mega-link-icon me-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(139, 69, 19, 0.1);">
                                                            <i class="fas {{ $link->icon }}" style="color: #8B4513;"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center">
                                                                <span class="fw-medium" style="color: #3E2723;">{{ $link->title }}</span>
                                                                @if($link->badge)
                                                                <span class="badge ms-2" style="font-size: 0.65rem; background: {{ $link->badge_color == 'success' ? '#28a745' : ($link->badge_color == 'danger' ? '#dc3545' : ($link->badge_color == 'warning' ? '#ffc107' : ($link->badge_color == 'info' ? '#17a2b8' : '#6c757d'))) }};">{{ $link->badge }}</span>
                                                                @endif
                                                            </div>
                                                            @if($link->description)
                                                            <small class="text-muted d-block" style="font-size: 0.75rem;">{{ $link->description }}</small>
                                                            @endif
                                                        </div>
                                                        <i class="fas fa-chevron-right ms-2 text-muted small"></i>
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 mega-menu-featured">
                                            <div class="h-100 p-4" style="background: linear-gradient(135deg, rgba(62,39,35,0.08) 0%, rgba(139,69,19,0.08) 100%);">
                                                <div class="row h-100 align-items-center">
                                                    <div class="col-md-6">
                                                        <span class="badge mb-2" style="background: {{ $impactSection->badge_color == 'success' ? '#28a745' : '#8B4513' }}; font-size: 0.7rem;">
                                                            <i class="fas fa-hands-helping me-1"></i>{{ $impactSection->badge }}
                                                        </span>
                                                        <h4 class="fw-bold mb-2" style="color: #3E2723; font-family: 'Playfair Display', serif;">{{ $impactSection->title }}</h4>
                                                        <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.6;">{{ $impactSection->description }}</p>
                                                        <a href="{{ $impactSection->link_url }}" class="btn btn-sm rounded-pill px-4 py-2 text-white" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); font-size: 0.85rem;">
                                                            {{ $impactSection->link_text }} <i class="fas fa-arrow-right ms-2"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mega-menu-image rounded-4 overflow-hidden shadow-lg position-relative">
                                                            <img src="{{ $impactSection->image }}" class="w-100" style="height: 220px; object-fit: cover;" alt="{{ $impactSection->title }}">
                                                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(62,39,35,0.3);">
                                                                <div class="text-center text-white p-3">
                                                                    <i class="fas fa-heart fa-2x mb-2"></i>
                                                                    <p class="mb-0 fw-bold">Making a Difference</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
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
                    /* Base Nav Styles - Compact */
                    .navbar-nav .nav-link {
                        color: #3E2723 !important;
                        font-weight: 600;
                        transition: all 0.3s ease;
                        position: relative;
                        padding: 8px 14px !important;
                        margin: 0 3px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 0.85rem;
                        white-space: nowrap;
                    }

                    .navbar-nav .nav-link:hover {
                        color: #8b4513 !important;
                    }

                    .navbar-nav .nav-link.active {
                        background-color: #8b4513 !important;
                        color: #ffffff !important;
                        border-radius: 4px;
                    }

                    /* Mega Menu Styles - Compact */
                    .has-mega-menu {
                        position: static !important;
                    }

                    .has-mega-menu > .nav-link {
                        cursor: pointer;
                    }

                    .has-mega-menu > .nav-link i.fa-chevron-down {
                        transition: transform 0.3s ease;
                        font-size: 0.6rem;
                        margin-left: 4px !important;
                    }

                    .has-mega-menu:hover > .nav-link i.fa-chevron-down {
                        transform: rotate(180deg);
                    }

                    .mega-menu-wrapper {
                        position: absolute;
                        top: 100%;
                        left: 50%;
                        transform: translateX(-50%) translateY(10px);
                        width: 900px;
                        max-width: 95vw;
                        opacity: 0;
                        visibility: hidden;
                        transition: all 0.3s ease;
                        z-index: 1000;
                        padding-top: 8px;
                    }

                    .has-mega-menu:hover .mega-menu-wrapper {
                        opacity: 1;
                        visibility: visible;
                        transform: translateX(-50%) translateY(0);
                    }

                    .mega-menu-container {
                        background: #fff;
                        border-radius: 12px;
                        box-shadow: 0 15px 50px rgba(0,0,0,0.12);
                        overflow: hidden;
                        border: 1px solid rgba(139, 69, 19, 0.08);
                    }

                    .mega-menu-content {
                        padding: 0;
                    }

                    .mega-menu-links {
                        background: #fff;
                        padding: 12px !important;
                    }

                    .mega-menu-links h6 {
                        font-size: 0.7rem !important;
                        margin-bottom: 10px !important;
                    }

                    .mega-links-list {
                        display: flex;
                        flex-direction: column;
                        gap: 3px;
                    }

                    .mega-link-item {
                        transition: all 0.2s ease;
                        border: 1px solid transparent;
                        padding: 6px 8px !important;
                    }

                    .mega-link-item:hover {
                        background: rgba(139, 69, 19, 0.05);
                        border-color: rgba(139, 69, 19, 0.1);
                        transform: translateX(3px);
                    }

                    .mega-link-icon {
                        width: 32px !important;
                        height: 32px !important;
                        margin-right: 10px !important;
                        font-size: 0.85rem;
                    }

                    .mega-link-item span.fw-medium {
                        font-size: 0.8rem;
                    }

                    .mega-link-item small {
                        font-size: 0.7rem !important;
                    }

                    .mega-link-item .badge {
                        font-size: 0.6rem !important;
                        padding: 2px 6px !important;
                    }

                    .mega-link-item i.fa-chevron-right {
                        font-size: 0.6rem !important;
                    }

                    .mega-menu-featured {
                        background: linear-gradient(135deg, rgba(62,39,35,0.03) 0%, rgba(139,69,19,0.03) 100%);
                        padding: 16px !important;
                    }

                    .mega-menu-featured h4 {
                        font-size: 1.1rem !important;
                        margin-bottom: 8px !important;
                    }

                    .mega-menu-featured p {
                        font-size: 0.8rem !important;
                        line-height: 1.5 !important;
                        margin-bottom: 12px !important;
                    }

                    .mega-menu-featured .badge {
                        font-size: 0.65rem !important;
                        padding: 4px 8px !important;
                        margin-bottom: 8px !important;
                    }

                    .mega-menu-featured .btn {
                        padding: 8px 16px !important;
                        font-size: 0.75rem !important;
                    }

                    .mega-menu-image {
                        transition: transform 0.3s ease;
                        border-radius: 10px !important;
                    }

                    .mega-menu-image img {
                        height: 160px !important;
                    }

                    .mega-menu-image:hover {
                        transform: scale(1.02);
                    }

                    /* Inquiry Button - Compact */
                    .btn-inquiry {
                        background: #8b4513;
                        border: 2px solid #8b4513;
                        letter-spacing: 1px;
                        padding: 10px 20px !important;
                        transition: all 0.3s ease;
                        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.2);
                        text-transform: uppercase;
                        font-size: 0.8rem;
                        white-space: nowrap;
                    }

                    .btn-inquiry:hover {
                        background: transparent;
                        color: #8b4513 !important;
                        transform: translateY(-2px);
                        box-shadow: 0 6px 20px rgba(139, 69, 19, 0.3);
                    }

                    /* Tablet Responsive */
                    @media (max-width: 1199px) {
                        .mega-menu-wrapper {
                            width: 800px;
                        }
                        
                        .navbar-nav .nav-link {
                            padding: 8px 10px !important;
                            font-size: 0.8rem;
                        }
                    }

                    /* Mobile Responsive */
                    @media (max-width: 991px) {
                        .mega-menu-wrapper {
                            position: static;
                            width: 100%;
                            max-width: 100%;
                            transform: none;
                            opacity: 1;
                            visibility: visible;
                            display: none;
                            padding-top: 0;
                        }
                        
                        .has-mega-menu:hover .mega-menu-wrapper,
                        .has-mega-menu.active .mega-menu-wrapper {
                            display: block;
                        }
                        
                        .mega-menu-container {
                            border-radius: 8px;
                            margin: 5px 10px;
                        }

                        .mega-menu-featured .row {
                            flex-direction: column-reverse;
                        }

                        .mega-menu-image img {
                            height: 120px !important;
                        }

                        .mega-menu-links {
                            padding: 10px !important;
                        }

                        .mega-menu-featured {
                            padding: 12px !important;
                        }

                        .navbar-nav .nav-link {
                            padding: 10px 15px !important;
                            font-size: 0.9rem;
                        }
                    }

                    /* Small Mobile */
                    @media (max-width: 576px) {
                        .mega-link-item {
                            padding: 5px !important;
                        }

                        .mega-link-icon {
                            width: 28px !important;
                            height: 28px !important;
                            font-size: 0.75rem;
                        }

                        .mega-menu-featured h4 {
                            font-size: 1rem !important;
                        }

                        .mega-menu-featured p {
                            font-size: 0.75rem !important;
                        }
                    }
                </style>
            </div>
        </div>
    </nav>
</header>
