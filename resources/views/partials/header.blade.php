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
                <a href="https://www.facebook.com/share/1DkJwJSKre/" target="_blank" style="color: #DEB887;" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/godeepafricasafariexpendition?igsh=MWpxc25icmkzZDA3Mg==" target="_blank" style="color: #DEB887;" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://www.tiktok.com/@godeepafrica.safari?_r=1&_t=ZS-96aUetd9NMF" target="_blank" style="color: #DEB887;" title="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.threads.com/@godeepafricasafariexpendition" target="_blank" style="color: #DEB887;" title="Threads"><i class="fa-brands fa-threads"></i></a>
            </div>
        </div>
    </div>

    <!-- Bottom Header: Navigation Menu & Logo with Mega Menu -->
    <nav class="bottom-header sticky-top navbar navbar-expand-xl navbar-light shadow-sm py-2 animate__animated animate__fadeIn mx-lg-3 mt-lg-3 rounded-pill" style="background-color: #fdfaf5;">
        <div class="container-fluid px-lg-3">
            <a href="{{ url('/') }}" class="navbar-brand me-3">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Go Deep Africa Safari" style="max-height: 55px; width: auto;">
            </a>

            <button class="mobile-sidebar-toggle d-xl-none" type="button" id="mobileSidebarToggle" aria-label="Toggle navigation">
                <span class="hamburger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
            
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }} px-3" href="{{ url('/') }}" style="color: #3E2723 !important;">{{ __('messages.nav.home') }}</a>
                    </li>

                    <!-- SAFARI Mega Menu -->
                    <li class="nav-item has-mega-menu position-static">
                        <a class="nav-link {{ Route::is('tours.all') || Route::is('safari*') ? 'active' : '' }} px-3" href="{{ route('tours.all') }}" style="color: #3E2723 !important;" id="safariMegaMenu">
                            {{ __('messages.nav.safaris') }} <i class="fas fa-chevron-down ms-1 small"></i>
                        </a>
                        @php
                            $allSafariPackages = \App\Models\SafariPackage::latest()->get();
                            // Show a stable set — featured first, then the newest — so images don't change randomly on every load.
                            $safariPackages = $allSafariPackages->sortByDesc('is_featured')->take(5)->values();
                        @endphp
                        @if($safariPackages->count() > 0)
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
                                                    @foreach($safariPackages as $package)
                                                    <a href="{{ route('safari.show', $package->slug) }}" class="mega-link-item d-flex align-items-center p-2 rounded text-decoration-none"
                                                       data-title="{{ $package->title }}"
                                                       data-description="{{ $package->summary }}"
                                                       data-image="{{ asset($package->image) }}"
                                                       data-url="{{ route('safari.show', $package->slug) }}"
                                                       data-link-text="View {{ $package->title }}">
                                                        <div class="mega-link-icon me-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(139, 69, 19, 0.1);">
                                                            <i class="fas fa-binoculars" style="color: #8B4513;"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center">
                                                                <span class="fw-medium" style="color: #3E2723;">{{ tr($package->title) }}</span>
                                                                <span class="badge ms-2" style="font-size: 0.65rem; background: #8B4513;">{{ $package->days }} {{ __('messages.common.days') }}</span>
                                                            </div>
                                                            <small class="text-muted d-block" style="font-size: 0.75rem;">{{ Str::limit(tr($package->summary), 60) }}</small>
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
                                                        <span class="badge mb-2 safari-badge" style="background: #8B4513; font-size: 0.7rem;">
                                                            <i class="fas fa-star me-1"></i>Featured Safari
                                                        </span>
                                                        <h4 class="fw-bold mb-2 safari-title" style="color: #3E2723; font-family: 'Playfair Display', serif;">{{ tr($safariPackages->first()->title) }}</h4>
                                                        <p class="text-muted mb-3 safari-description" style="font-size: 0.9rem; line-height: 1.6;">{{ Str::limit(tr($safariPackages->first()->summary), 100) }}</p>
                                                        <a href="{{ route('safari.show', $safariPackages->first()->slug) }}" class="btn btn-sm rounded-pill px-4 py-2 text-white safari-btn" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); font-size: 0.85rem;">
                                                            View Details <i class="fas fa-arrow-right ms-2"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mega-menu-image rounded-4 overflow-hidden shadow-lg">
                                                            <img src="{{ asset($safariPackages->first()->image) }}" class="w-100 safari-image" style="height: 220px; object-fit: cover;" alt="{{ $safariPackages->first()->title }}" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='{{ asset('images/logo/logo.png') }}';this.style.objectFit='contain';this.style.background='#fdfaf5';">
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
                            {{ __('messages.nav.kilimanjaro') }} <i class="fas fa-chevron-down ms-1 small"></i>
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
                                                    @php
                                                        $kiliLinks = [
                                                            (object)[
                                                                'title' => 'Why We Set the Gold Standard',
                                                                'description' => '52 reasons to choose us',
                                                                'badge' => '52 Reasons',
                                                                'badge_color' => 'success',
                                                                'icon' => 'fa-trophy',
                                                                'url' => route('kilimanjaro.why-us')
                                                            ],
                                                            (object)[
                                                                'title' => 'Private Tours and Pricing',
                                                                'description' => 'Transparent pricing',
                                                                'badge' => null,
                                                                'badge_color' => 'secondary',
                                                                'icon' => 'fa-user',
                                                                'url' => route('kilimanjaro.private-tours')
                                                            ],
                                                            (object)[
                                                                'title' => 'Group Departures',
                                                                'description' => 'Join scheduled climbs',
                                                                'badge' => '$100 Deposit',
                                                                'badge_color' => 'warning',
                                                                'icon' => 'fa-users',
                                                                'url' => route('kilimanjaro.group-departures')
                                                            ],
                                                            (object)[
                                                                'title' => 'Kilimanjaro Routes',
                                                                'description' => 'Compare all routes',
                                                                'badge' => null,
                                                                'badge_color' => 'secondary',
                                                                'icon' => 'fa-route',
                                                                'url' => route('kilimanjaro.routes')
                                                            ],
                                                            (object)[
                                                                'title' => 'Packing List',
                                                                'description' => 'Essential gear guide',
                                                                'badge' => 'Free PDF',
                                                                'badge_color' => 'info',
                                                                'icon' => 'fa-suitcase',
                                                                'url' => route('kilimanjaro.packing-list')
                                                            ],
                                                            (object)[
                                                                'title' => 'Success Calculator',
                                                                'description' => 'Estimate your success',
                                                                'badge' => 'New',
                                                                'badge_color' => 'danger',
                                                                'icon' => 'fa-calculator',
                                                                'url' => route('kilimanjaro.success-calculator')
                                                            ],
                                                            (object)[
                                                                'title' => 'Helpful Articles',
                                                                'description' => 'Tips & insights',
                                                                'badge' => null,
                                                                'badge_color' => 'secondary',
                                                                'icon' => 'fa-book',
                                                                'url' => route('kilimanjaro.articles')
                                                            ],
                                                            (object)[
                                                                'title' => 'Other Mountains',
                                                                'description' => 'Meru, Ol Doinyo Lengai',
                                                                'badge' => null,
                                                                'badge_color' => 'secondary',
                                                                'icon' => 'fa-mountain',
                                                                'url' => route('kilimanjaro.other-mountains')
                                                            ],
                                                        ];
                                                        $kiliImages = [
                                                            'images/images/4-Kilimanjaro-Jane-at-summit-SC_JW.jpg',
                                                            'images/images/360_F_303354896_Qg6fhfYQhz3kdoKeRvK333UEaD9d6FWN.jpg',
                                                            'images/images/360_F_414252019_kMOC4Xfg0VsgqDmd5sN7BvyV3UBAy1VY.jpg',
                                                            'images/images/360_F_427166955_K3hITkNBHei8hQaUp14JCC9eoj7Qr9W2.jpg',
                                                            'images/images/360_F_471646259_DSsT1dheQRFyU67odrTnwmQBhMwwDncm.jpg',
                                                        ];
                                                    @endphp
                                                    @foreach($kiliLinks as $index => $link)
                                                    <a href="{{ $link->url }}" class="mega-link-item d-flex align-items-center p-2 rounded text-decoration-none"
                                                       data-title="{{ $link->title }}"
                                                       data-description="{{ $link->description }}"
                                                       data-image="{{ asset($kiliImages[$index % count($kiliImages)]) }}"
                                                       data-url="{{ $link->url }}"
                                                       data-link-text="Learn More">
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
                                                            <small class="text-muted d-block" style="font-size: 0.75rem;">{{ $link->description }}</small>
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
                                                        <span class="badge mb-2 kili-badge" style="background: {{ $kiliSection->badge_color == 'success' ? '#28a745' : '#8B4513' }}; font-size: 0.7rem;">
                                                            <i class="fas fa-star me-1"></i>{{ $kiliSection->badge }}
                                                        </span>
                                                        <h4 class="fw-bold mb-2 kili-title" style="color: #3E2723; font-family: 'Playfair Display', serif;">{{ $kiliSection->title }}</h4>
                                                        <p class="text-muted mb-3 kili-description" style="font-size: 0.9rem; line-height: 1.6;">{{ $kiliSection->description }}</p>
                                                        <a href="{{ $kiliSection->link_url }}" class="btn btn-sm rounded-pill px-4 py-2 text-white kili-btn" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); font-size: 0.85rem;">
                                                            {{ $kiliSection->link_text }} <i class="fas fa-arrow-right ms-2"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mega-menu-image rounded-4 overflow-hidden shadow-lg">
                                                            <img src="{{ asset('images/images/4-Kilimanjaro-Jane-at-summit-SC_JW.jpg') }}" class="w-100 kili-image" style="height: 220px; object-fit: cover;" alt="{{ $kiliSection->title }}" loading="lazy" decoding="async">
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
                            {{ __('messages.nav.destinations') }} <i class="fas fa-chevron-down ms-1 small"></i>
                        </a>
                        @php
                            $allDestinations = \App\Models\SafariDestination::active()->ordered()->get();
                            // Show a stable, ordered set so destination images don't change randomly on every load.
                            $destinations = $allDestinations->take(5);
                        @endphp
                        @if($destinations->count() > 0)
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
                                                    @foreach($destinations as $destination)
                                                    <a href="{{ route('destinations.show', $destination->slug) }}" class="mega-link-item d-flex align-items-center p-2 rounded text-decoration-none"
                                                       data-title="{{ $destination->name }}"
                                                       data-description="{{ $destination->tagline }}"
                                                       data-image="{{ $destination->hero_display_image }}"
                                                       data-url="{{ route('destinations.show', $destination->slug) }}"
                                                       data-link-text="Explore {{ $destination->name }}">
                                                        <div class="mega-link-icon me-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(139, 69, 19, 0.1);">
                                                            <i class="fas {{ $destination->icon }}" style="color: #8B4513;"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center">
                                                                <span class="fw-medium" style="color: #3E2723;">{{ tr($destination->name) }}</span>
                                                                @if($destination->badge)
                                                                <span class="badge ms-2" style="font-size: 0.65rem; background: {{ $destination->badge_color == 'success' ? '#28a745' : ($destination->badge_color == 'danger' ? '#dc3545' : ($destination->badge_color == 'warning' ? '#ffc107' : ($destination->badge_color == 'info' ? '#17a2b8' : '#6c757d'))) }};">{{ $destination->badge }}</span>
                                                                @endif
                                                            </div>
                                                            <small class="text-muted d-block" style="font-size: 0.75rem;">{{ tr($destination->tagline) }}</small>
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
                                                        <span class="badge mb-2 dest-badge" style="background: #8B4513; font-size: 0.7rem;">
                                                            <i class="fas fa-compass me-1"></i>Featured Destination
                                                        </span>
                                                        <h4 class="fw-bold mb-2 dest-title" style="color: #3E2723; font-family: 'Playfair Display', serif;">{{ tr($destinations->first()->name) }}</h4>
                                                        <p class="text-muted mb-3 dest-description" style="font-size: 0.9rem; line-height: 1.6;">{{ tr($destinations->first()->tagline) }}</p>
                                                        <a href="{{ route('destinations.show', $destinations->first()->slug) }}" class="btn btn-sm rounded-pill px-4 py-2 text-white dest-btn" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); font-size: 0.85rem;">
                                                            Explore Now <i class="fas fa-arrow-right ms-2"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mega-menu-image rounded-4 overflow-hidden shadow-lg">
                                                            <img src="{{ $destinations->first()->hero_display_image }}" class="w-100 dest-image" style="height: 220px; object-fit: cover;" alt="{{ $destinations->first()->name }}" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='{{ asset('images/logo/logo.png') }}';this.style.objectFit='contain';this.style.background='#fdfaf5';">
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
                        <a class="nav-link {{ Route::is('zanzibar') ? 'active' : '' }} px-3" href="{{ route('zanzibar') }}" style="color: #3E2723 !important;">Zanzibar</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('cultural*') ? 'active' : '' }} px-3" href="{{ route('cultural.index') }}" style="color: #3E2723 !important;">Cultural Safari</a>
                    </li>

                    <!-- IMPACT / GIVING BACK Mega Menu -->
                    <li class="nav-item has-mega-menu position-static">
                        <a class="nav-link {{ Route::is('impact*') ? 'active' : '' }} px-3" href="{{ route('impact') }}" style="color: #3E2723 !important;" id="impactMegaMenu">
                            {{ __('messages.nav.giving_back') }} <i class="fas fa-chevron-down ms-1 small"></i>
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
                                                    @php
                                                        $impactImages = [
                                                            'images/images/africa_tanzania_serengeti_gallery_leopard_and_cub.jpg',
                                                            'images/images/Aerial-View-of-stone-town-and-Zanzibar-Island-Easy-Travel-Tanzania-scaled-1.jpg',
                                                            'images/images/Aerial-view-of-the-crowded-beach-of-Zanzibar-Tanzania.jpg',
                                                            'images/images/360_F_523956441_jpxzXdIaX30EHkDZ2V2b94gJTEfNy8ud.jpg',
                                                            'images/images/360_F_619841928_1JmYmR5kZQBuok5mDPkhQFVvntiLwPnr.jpg',
                                                        ];
                                                    @endphp
                                                    @foreach($impactLinks as $index => $link)
                                                    <a href="{{ $link->url }}" class="mega-link-item d-flex align-items-center p-2 rounded text-decoration-none"
                                                       data-title="{{ $link->title }}"
                                                       data-description="{{ $link->description ?? $impactSection->description }}"
                                                       data-image="{{ asset($impactImages[$index % count($impactImages)]) }}"
                                                       data-url="{{ $link->url }}"
                                                       data-link-text="{{ $link->title }}">
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
                                                        <span class="badge mb-2 impact-badge" style="background: {{ $impactSection->badge_color == 'success' ? '#28a745' : '#8B4513' }}; font-size: 0.7rem;">
                                                            <i class="fas fa-hands-helping me-1"></i>{{ $impactSection->badge }}
                                                        </span>
                                                        <h4 class="fw-bold mb-2 impact-title" style="color: #3E2723; font-family: 'Playfair Display', serif;">{{ $impactSection->title }}</h4>
                                                        <p class="text-muted mb-3 impact-description" style="font-size: 0.9rem; line-height: 1.6;">{{ $impactSection->description }}</p>
                                                        <a href="{{ $impactSection->link_url }}" class="btn btn-sm rounded-pill px-4 py-2 text-white impact-btn" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); font-size: 0.85rem;">
                                                            {{ $impactSection->link_text }} <i class="fas fa-arrow-right ms-2"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mega-menu-image rounded-4 overflow-hidden shadow-lg position-relative">
                                                            <img src="{{ asset('images/images/africa_tanzania_serengeti_gallery_leopard_and_cub.jpg') }}" class="w-100 impact-image" style="height: 220px; object-fit: cover;" alt="{{ $impactSection->title }}" loading="lazy" decoding="async">
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
                        <a class="nav-link {{ Route::is('blog*') ? 'active' : '' }} px-4" href="{{ route('blog') }}" style="color: #3E2723 !important;">{{ __('messages.nav.blog') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('about') ? 'active' : '' }} px-4" href="{{ route('about') }}" style="color: #3E2723 !important;">{{ __('messages.nav.about') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('contact') ? 'active' : '' }} px-3" href="{{ route('contact') }}" style="color: #3E2723 !important;">{{ __('messages.nav.contact') }}</a>
                    </li>
                </ul>
                
                <div class="auth-buttons d-flex gap-3 align-items-center">
                    <div class="d-none d-xl-block">
                        @include('partials.language_switcher', ['variant' => 'compact'])
                    </div>
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
                        {{ __('messages.nav.inquiry_now') }} <i class="fas fa-paper-plane ms-2 small"></i>
                    </a>
                </div>

                <style>
                    /* Base Nav Styles - Compact */
                    .navbar-nav .nav-link {
                        color: #3E2723 !important;
                        font-weight: 600;
                        transition: all 0.3s ease;
                        position: relative;
                        padding: 8px 11px !important;
                        margin: 0 1px;
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

                    /* Full horizontal menu shows at >=1200px. Distribute the links
                       evenly and compact them on smaller desktops so all 10 fit. */
                    .navbar-nav.mx-auto {
                        flex-wrap: nowrap;
                    }

                    @media (min-width: 1200px) and (max-width: 1499px) {
                        .navbar-nav .nav-link {
                            padding: 8px 8px !important;
                            font-size: 0.8rem;
                            margin: 0;
                        }
                        .navbar-brand img {
                            max-height: 46px !important;
                        }
                        .auth-buttons {
                            gap: 0.5rem !important;
                        }
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
                    @media (max-width: 1199px) {
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

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Safari Mega Menu Hover Effect
                        const safariLinks = document.querySelectorAll('#safariMegaMenu').forEach(function(menu) {
                            const wrapper = menu.closest('.has-mega-menu');
                            if (wrapper) {
                                const linkItems = wrapper.querySelectorAll('.mega-link-item');
                                const titleEl = wrapper.querySelector('.safari-title');
                                const descEl = wrapper.querySelector('.safari-description');
                                const imgEl = wrapper.querySelector('.safari-image');
                                const btnEl = wrapper.querySelector('.safari-btn');

                                linkItems.forEach(function(item) {
                                    item.addEventListener('mouseenter', function() {
                                        if (titleEl) titleEl.textContent = this.dataset.title;
                                        if (descEl) descEl.textContent = this.dataset.description;
                                        if (imgEl) imgEl.src = this.dataset.image;
                                        if (btnEl) {
                                            btnEl.href = this.dataset.url;
                                            btnEl.innerHTML = this.dataset.linkText + ' <i class="fas fa-arrow-right ms-2"></i>';
                                        }
                                    });
                                });
                            }
                        });

                        // Kilimanjaro Mega Menu Hover Effect
                        document.querySelectorAll('#kiliMegaMenu').forEach(function(menu) {
                            const wrapper = menu.closest('.has-mega-menu');
                            if (wrapper) {
                                const linkItems = wrapper.querySelectorAll('.mega-link-item');
                                const titleEl = wrapper.querySelector('.kili-title');
                                const descEl = wrapper.querySelector('.kili-description');
                                const imgEl = wrapper.querySelector('.kili-image');
                                const btnEl = wrapper.querySelector('.kili-btn');

                                linkItems.forEach(function(item) {
                                    item.addEventListener('mouseenter', function() {
                                        if (titleEl) titleEl.textContent = this.dataset.title;
                                        if (descEl) descEl.textContent = this.dataset.description;
                                        if (imgEl) imgEl.src = this.dataset.image;
                                        if (btnEl) {
                                            btnEl.href = this.dataset.url;
                                            btnEl.innerHTML = this.dataset.linkText + ' <i class="fas fa-arrow-right ms-2"></i>';
                                        }
                                    });
                                });
                            }
                        });

                        // Destinations Mega Menu Hover Effect
                        document.querySelectorAll('#destMegaMenu').forEach(function(menu) {
                            const wrapper = menu.closest('.has-mega-menu');
                            if (wrapper) {
                                const linkItems = wrapper.querySelectorAll('.mega-link-item');
                                const titleEl = wrapper.querySelector('.dest-title');
                                const descEl = wrapper.querySelector('.dest-description');
                                const imgEl = wrapper.querySelector('.dest-image');
                                const btnEl = wrapper.querySelector('.dest-btn');

                                linkItems.forEach(function(item) {
                                    item.addEventListener('mouseenter', function() {
                                        if (titleEl) titleEl.textContent = this.dataset.title;
                                        if (descEl) descEl.textContent = this.dataset.description;
                                        if (imgEl) imgEl.src = this.dataset.image;
                                        if (btnEl) {
                                            btnEl.href = this.dataset.url;
                                            btnEl.innerHTML = this.dataset.linkText + ' <i class="fas fa-arrow-right ms-2"></i>';
                                        }
                                    });
                                });
                            }
                        });

                        // Impact/Giving Back Mega Menu Hover Effect
                        document.querySelectorAll('#impactMegaMenu').forEach(function(menu) {
                            const wrapper = menu.closest('.has-mega-menu');
                            if (wrapper) {
                                const linkItems = wrapper.querySelectorAll('.mega-link-item');
                                const titleEl = wrapper.querySelector('.impact-title');
                                const descEl = wrapper.querySelector('.impact-description');
                                const imgEl = wrapper.querySelector('.impact-image');
                                const btnEl = wrapper.querySelector('.impact-btn');

                                linkItems.forEach(function(item) {
                                    item.addEventListener('mouseenter', function() {
                                        if (titleEl) titleEl.textContent = this.dataset.title;
                                        if (descEl) descEl.textContent = this.dataset.description;
                                        if (imgEl) imgEl.src = this.dataset.image;
                                        if (btnEl) {
                                            btnEl.href = this.dataset.url;
                                            btnEl.innerHTML = this.dataset.linkText + ' <i class="fas fa-arrow-right ms-2"></i>';
                                        }
                                    });
                                });
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </nav>

    <!-- Mobile Sidebar Drawer -->
    <div class="mobile-sidebar-overlay" id="mobileSidebarOverlay"></div>
    <aside class="mobile-sidebar" id="mobileSidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Go Deep Africa Safari" style="max-height: 40px; width: auto;">
            <button class="sidebar-close" id="mobileSidebarClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-nav">
                <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}"><i class="fas fa-home me-3"></i>{{ __('messages.nav.home') }}</a></li>
                
                <li class="sidebar-dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle">
                        <i class="fas fa-paw me-3"></i>{{ __('messages.nav.safaris') }} <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('tours.all') }}"><i class="fas fa-compass me-2"></i>{{ __('messages.nav.all_tours') }}</a></li>
                        @php
                            $safariSection = \App\Models\MenuSection::forNavItem('safari')->first();
                            $safariLinks = $safariSection ? $safariSection->links()->active()->get() : collect();
                        @endphp
                        @if($safariSection && $safariLinks->count() > 0)
                            @foreach($safariLinks as $link)
                            <li><a href="{{ $link->url }}"><i class="fas {{ $link->icon }} me-2"></i>{{ $link->title }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </li>

                <li class="sidebar-dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle">
                        <i class="fas fa-mountain me-3"></i>{{ __('messages.nav.kilimanjaro') }} <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('kilimanjaro') }}"><i class="fas fa-hiking me-2"></i>Climbing Overview</a></li>
                        <li><a href="{{ route('kilimanjaro.why-us') }}"><i class="fas fa-info-circle me-2"></i>Why With Us</a></li>
                        <li><a href="{{ route('kilimanjaro.private-tours') }}"><i class="fas fa-tags me-2"></i>Pricing</a></li>
                        <li><a href="{{ route('kilimanjaro.group-departures') }}"><i class="fas fa-users me-2"></i>Group Climbs</a></li>
                        <li><a href="{{ route('kilimanjaro.success-calculator') }}"><i class="fas fa-calculator me-2"></i>Cost Calculator</a></li>
                        @php
                            $kiliSection = \App\Models\MenuSection::forNavItem('kilimanjaro')->first();
                            $kiliLinks = $kiliSection ? $kiliSection->links()->active()->get() : collect();
                        @endphp
                        @if($kiliSection && $kiliLinks->count() > 0)
                            @foreach($kiliLinks as $link)
                            <li><a href="{{ $link->url }}"><i class="fas {{ $link->icon }} me-2"></i>{{ $link->title }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </li>

                <li class="sidebar-dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle">
                        <i class="fas fa-map-marker-alt me-3"></i>{{ __('messages.nav.destinations') }} <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('destinations') }}"><i class="fas fa-compass me-2"></i>All Destinations</a></li>
                        @php
                            $destSection = \App\Models\MenuSection::forNavItem('destinations')->first();
                            $destLinks = $destSection ? $destSection->links()->active()->get() : collect();
                        @endphp
                        @if($destSection && $destLinks->count() > 0)
                            @foreach($destLinks as $link)
                            <li><a href="{{ $link->url }}"><i class="fas {{ $link->icon }} me-2"></i>{{ $link->title }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </li>

                <li><a href="{{ route('zanzibar') }}" class="{{ Route::is('zanzibar') ? 'active' : '' }}"><i class="fas fa-umbrella-beach me-3"></i>Zanzibar</a></li>
                <li><a href="{{ route('cultural.index') }}" class="{{ Route::is('cultural*') ? 'active' : '' }}"><i class="fas fa-people-group me-3"></i>Cultural Safari</a></li>

                <li class="sidebar-dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle">
                        <i class="fas fa-heart me-3"></i>{{ __('messages.nav.giving_back') }} <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('impact') }}"><i class="fas fa-hands-helping me-2"></i>Our Impact</a></li>
                        @php
                            $impactSection = \App\Models\MenuSection::forNavItem('impact')->first();
                            $impactLinks = $impactSection ? $impactSection->links()->active()->get() : collect();
                        @endphp
                        @if($impactSection && $impactLinks->count() > 0)
                            @foreach($impactLinks as $link)
                            <li><a href="{{ $link->url }}"><i class="fas {{ $link->icon }} me-2"></i>{{ $link->title }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </li>

                <li><a href="{{ route('blog') }}" class="{{ Route::is('blog*') ? 'active' : '' }}"><i class="fas fa-newspaper me-3"></i>{{ __('messages.nav.blog') }}</a></li>
                <li><a href="{{ route('about') }}" class="{{ Route::is('about') ? 'active' : '' }}"><i class="fas fa-info-circle me-3"></i>{{ __('messages.nav.about') }}</a></li>
                <li><a href="{{ route('contact') }}" class="{{ Route::is('contact') ? 'active' : '' }}"><i class="fas fa-envelope me-3"></i>{{ __('messages.nav.contact') }}</a></li>
            </ul>

            <div class="sidebar-footer">
                <div class="mb-4">
                    <label class="d-block small fw-bold text-uppercase mb-2" style="color: #8B4513; letter-spacing: 1px;">
                        <i class="fas fa-globe me-2"></i>{{ __('messages.lang_switcher.label') }}
                    </label>
                    @include('partials.language_switcher', ['variant' => 'block'])
                </div>
                <div class="contact-info mb-4">
                    <a href="https://wa.me/966542586758" class="d-flex align-items-center gap-3 mb-3 text-decoration-none">
                        <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(37, 211, 102, 0.1);">
                            <i class="fab fa-whatsapp" style="color: #25D366;"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">WhatsApp</small>
                            <span class="fw-bold" style="color: #3E2723;">+966 54 258 6758</span>
                        </div>
                    </a>
                    <a href="mailto:info@godeepafricasafari.com" class="d-flex align-items-center gap-3 mb-3 text-decoration-none">
                        <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(139, 69, 19, 0.1);">
                            <i class="fas fa-envelope" style="color: #8B4513;"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Email</small>
                            <span class="fw-bold" style="color: #3E2723;">info@godeepafricasafari.com</span>
                        </div>
                    </a>
                </div>

                <div class="d-flex gap-2 justify-content-center mb-4">
                    <a href="https://www.facebook.com/share/1DkJwJSKre/" target="_blank" class="sidebar-social-btn" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/godeepafricasafariexpendition?igsh=MWpxc25icmkzZDA3Mg==" target="_blank" class="sidebar-social-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@godeepafrica.safari?_r=1&_t=ZS-96aUetd9NMF" target="_blank" class="sidebar-social-btn" title="TikTok"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.threads.com/@godeepafricasafariexpendition" target="_blank" class="sidebar-social-btn" title="Threads"><i class="fa-brands fa-threads"></i></a>
                </div>
                <a href="#" class="btn btn-earth w-100 py-3 rounded-pill fw-bold text-white text-center" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                    <i class="fas fa-paper-plane me-2"></i>{{ __('messages.nav.inquiry_now') }}
                </a>
            </div>
        </div>
    </aside>

    <style>
        /* Mobile Sidebar Toggle - Hamburger Icon */
        .mobile-sidebar-toggle {
            background: none;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            position: relative;
            z-index: 1050;
        }

        .hamburger-icon {
            display: flex;
            flex-direction: column;
            gap: 5px;
            width: 24px;
        }

        .hamburger-icon span {
            display: block;
            height: 2px;
            width: 100%;
            background-color: #3E2723;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .mobile-sidebar-toggle.active .hamburger-icon span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .mobile-sidebar-toggle.active .hamburger-icon span:nth-child(2) {
            opacity: 0;
        }

        .mobile-sidebar-toggle.active .hamburger-icon span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        /* Mobile Sidebar Overlay */
        .mobile-sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .mobile-sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Mobile Sidebar Drawer */
        .mobile-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 300px;
            max-width: 85vw;
            height: 100%;
            background: #fff;
            z-index: 1050;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 5px 0 30px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
        }

        .mobile-sidebar.active {
            transform: translateX(0);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border-bottom: 1px solid rgba(139, 69, 19, 0.1);
            background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);
        }

        .sidebar-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .sidebar-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 0;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav > li > a {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            color: #3E2723;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            border-bottom: 1px solid rgba(139, 69, 19, 0.08);
            transition: all 0.3s ease;
        }

        .sidebar-nav > li > a:hover {
            background: rgba(139, 69, 19, 0.05);
            color: #8B4513;
            padding-left: 25px;
        }

        .sidebar-nav > li > a.active {
            background: rgba(139, 69, 19, 0.1);
            color: #8B4513;
            border-left: 4px solid #8B4513;
        }

        .sidebar-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }

        .sidebar-dropdown .dropdown-toggle i.fa-chevron-down {
            transition: transform 0.3s ease;
            font-size: 0.7rem;
        }

        .sidebar-dropdown.open .dropdown-toggle i.fa-chevron-down {
            transform: rotate(180deg);
        }

        .sidebar-submenu {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: rgba(139, 69, 19, 0.03);
        }

        .sidebar-dropdown.open .sidebar-submenu {
            max-height: 500px;
        }

        .sidebar-submenu li a {
            display: flex;
            align-items: center;
            padding: 12px 20px 12px 53px;
            color: #5D4037;
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(139, 69, 19, 0.05);
        }

        .sidebar-submenu li a:hover {
            background: rgba(139, 69, 19, 0.08);
            color: #8B4513;
            padding-left: 58px;
        }

        .sidebar-footer {
            padding: 20px;
            background: rgba(139, 69, 19, 0.03);
            border-top: 1px solid rgba(139, 69, 19, 0.1);
        }

        .sidebar-footer .contact-info a small {
            font-size: 0.75rem;
        }

        .sidebar-footer .contact-info span {
            font-size: 0.9rem;
        }

        .sidebar-footer .btn-earth {
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            border: none;
            transition: all 0.3s ease;
        }

        .sidebar-footer .btn-earth:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(139, 69, 19, 0.3);
        }

        .sidebar-social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(139, 69, 19, 0.1);
            color: #8B4513;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .sidebar-social-btn:hover {
            background: #8B4513;
            color: #fff;
            transform: translateY(-2px);
        }

        /* Hide Bootstrap collapse on mobile - using sidebar instead */
        @media (max-width: 991px) {
            .navbar-collapse {
                display: none !important;
            }
        }
    </style>

    <!-- General Inquiry Modal -->
    @include('partials.general_inquiry_modal')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('mobileSidebarToggle');
            const sidebar = document.getElementById('mobileSidebar');
            const sidebarClose = document.getElementById('mobileSidebarClose');
            const sidebarOverlay = document.getElementById('mobileSidebarOverlay');

            function openSidebar() {
                sidebar.classList.add('active');
                sidebarOverlay.classList.add('active');
                sidebarToggle.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                sidebarToggle.classList.remove('active');
                document.body.style.overflow = '';
            }

            sidebarToggle.addEventListener('click', openSidebar);
            sidebarClose.addEventListener('click', closeSidebar);
            sidebarOverlay.addEventListener('click', closeSidebar);

            // Dropdown toggles in sidebar
            const dropdownToggles = document.querySelectorAll('.sidebar-dropdown .dropdown-toggle');
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parent = this.closest('.sidebar-dropdown');
                    parent.classList.toggle('open');
                });
            });

            // Close sidebar when clicking a link
            const sidebarLinks = document.querySelectorAll('.sidebar-nav a, .sidebar-submenu a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (this.getAttribute('href') !== 'javascript:void(0)') {
                        closeSidebar();
                    }
                });
            });

            // General Inquiry Form AJAX Submission
            const inquiryForm = document.getElementById('generalInquiryForm');
            if (inquiryForm) {
                inquiryForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    
                    // Show loading
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>SENDING...';
                    
                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')) || (this.querySelector('input[name="_token"]')?.value) || '',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonColor: '#8b4513',
                                confirmButtonText: '<i class="fas fa-check me-2"></i>OK',
                                customClass: {
                                    confirmButton: 'rounded-pill px-4'
                                }
                            }).then(() => {
                                // Close modal
                                const modal = bootstrap.Modal.getInstance(document.getElementById('generalInquiryModal'));
                                if (modal) {
                                    modal.hide();
                                }
                                // Reset form
                                inquiryForm.reset();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.message || 'Something went wrong. Please try again.',
                                icon: 'error',
                                confirmButtonColor: '#dc3545',
                                confirmButtonText: '<i class="fas fa-times me-2"></i>OK',
                                customClass: {
                                    confirmButton: 'rounded-pill px-4'
                                }
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong. Please try again.',
                            icon: 'error',
                            confirmButtonColor: '#dc3545',
                            confirmButtonText: '<i class="fas fa-times me-2"></i>OK',
                            customClass: {
                                confirmButton: 'rounded-pill px-4'
                            }
                        });
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    });
                });
            }
            
            // Clean up modal backdrop when modal is hidden
            const modalElement = document.getElementById('generalInquiryModal');
            if (modalElement) {
                modalElement.addEventListener('hidden.bs.modal', function() {
                    document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
                        backdrop.remove();
                    });
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                });
            }
        });
    </script>

</header>
