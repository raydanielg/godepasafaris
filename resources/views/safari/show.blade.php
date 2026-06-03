<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.head')
    <title>{{ $package->title }} - Go Deep Africa Safari</title>
</head>
<body class="bg-light">
    @include('partials.header')

    <!-- Page Header -->
    <section class="page-header-details animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset($package->image) }}');">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('safari') }}" class="text-white">Safari</a></li>
                    <li class="breadcrumb-item active text-white opacity-75" aria-current="page">{{ Str::limit($package->title, 20) }}</li>
                </ol>
            </nav>
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">{{ $package->title }}</h1>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm animate__animated animate__fadeInUp">
                    <div class="mb-5">
                        <h2 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Overview</h2>
                        <p class="lead text-muted">{{ $package->summary }}</p>
                    </div>

                    @php
                        $itinerary = is_array($package->itinerary) ? $package->itinerary : (is_string($package->itinerary) ? json_decode($package->itinerary, true) : []);
                        if (!is_array($itinerary)) $itinerary = [];
                    @endphp
                    @if(count($itinerary) > 0)
                    <div class="itinerary-section mb-5 pt-4 border-top">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="icon-circle-lg d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                <i class="fas fa-route text-white fa-lg"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif; color: #3E2723;">Detailed Itinerary</h3>
                                <p class="text-muted small mb-0">{{ count($itinerary) }} Days of Adventure</p>
                            </div>
                        </div>
                        
                        <div class="timeline position-relative">
                            <div class="timeline-line position-absolute" style="left: 24px; top: 0; bottom: 0; width: 3px; background: linear-gradient(180deg, #8B4513 0%, #D2691E 100%); border-radius: 3px;"></div>
                            
                            @foreach($itinerary as $step)
                            <div class="timeline-item position-relative ps-5 pb-4">
                                <div class="timeline-dot position-absolute d-flex align-items-center justify-content-center rounded-circle" style="left: 15px; width: 22px; height: 22px; background: #8B4513; border: 3px solid #fff; box-shadow: 0 2px 8px rgba(139,69,19,0.3);">
                                    <span class="text-white fw-bold" style="font-size: 10px;">{{ $step['day'] ?? $loop->iteration }}</span>
                                </div>
                                
                                <div class="card border-0 rounded-4 shadow-sm overflow-hidden hover-shadow transition-all" style="background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);">
                                    @if(isset($step['image']) && $step['image'])
                                    <div class="card-img-top" style="height: 200px; overflow: hidden;">
                                        <img src="{{ asset($step['image']) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $step['title'] ?? '' }}">
                                    </div>
                                    @endif
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="badge rounded-pill px-3 py-1" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white; font-size: 11px;">DAY {{ $step['day'] ?? $loop->iteration }}</span>
                                            @if($loop->first)
                                            <span class="badge bg-success rounded-pill px-2 py-1" style="font-size: 10px;"><i class="fas fa-play me-1"></i>START</span>
                                            @elseif($loop->last)
                                            <span class="badge bg-primary rounded-pill px-2 py-1" style="font-size: 10px;"><i class="fas fa-flag-checkered me-1"></i>FINISH</span>
                                            @endif
                                        </div>
                                        <h5 class="fw-bold mb-3" style="color: #3E2723; font-family: 'Playfair Display', serif;">{{ $step['title'] ?? 'Day ' . $loop->iteration }}</h5>
                                        <p class="text-muted mb-0" style="line-height: 1.7;">{{ $step['description'] ?? 'Exciting safari activities planned for this day.' }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="itinerary-section mb-5 pt-4 border-top">
                        <div class="text-center py-5 px-4 rounded-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                            <div class="icon-circle-lg d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                <i class="fas fa-map-marked-alt text-white fa-2x"></i>
                            </div>
                            <h5 class="fw-bold mb-2" style="color: #3E2723;">Detailed Itinerary Available</h5>
                            <p class="text-muted mb-3">Contact our team for the complete day-by-day itinerary breakdown.</p>
                            <a href="#inquiry" class="btn rounded-pill px-4 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                <i class="fas fa-envelope me-2"></i>Request Full Itinerary
                            </a>
                        </div>
                    </div>
                    @endif

                    @php
                        $inclusions = is_array($package->inclusions) ? $package->inclusions : (is_string($package->inclusions) ? json_decode($package->inclusions, true) : []);
                        $exclusions = is_array($package->exclusions) ? $package->exclusions : (is_string($package->exclusions) ? json_decode($package->exclusions, true) : []);
                        if (!is_array($inclusions)) $inclusions = [];
                        if (!is_array($exclusions)) $exclusions = [];
                        
                        // Icon mapping for common items
                        $iconMap = [
                            'flight' => 'fa-plane',
                            'airport' => 'fa-plane-arrival',
                            'pickup' => 'fa-car',
                            'accommodation' => 'fa-bed',
                            'lodge' => 'fa-hotel',
                            'camp' => 'fa-campground',
                            'meal' => 'fa-utensils',
                            'food' => 'fa-utensils',
                            'breakfast' => 'fa-coffee',
                            'lunch' => 'fa-hamburger',
                            'dinner' => 'fa-wine-glass',
                            'park' => 'fa-tree',
                            'fee' => 'fa-ticket-alt',
                            'transport' => 'fa-bus',
                            'vehicle' => 'fa-car-side',
                            'guide' => 'fa-user-tie',
                            'water' => 'fa-tint',
                            'drink' => 'fa-glass-water',
                            'tax' => 'fa-receipt',
                            'insurance' => 'fa-shield-alt',
                            'visa' => 'fa-passport',
                            'tip' => 'fa-hand-holding-usd',
                            'personal' => 'fa-shopping-bag',
                            'alcohol' => 'fa-wine-bottle',
                            'flight' => 'fa-plane',
                            'fly' => 'fa-plane',
                            'wifi' => 'fa-wifi',
                            'internet' => 'fa-wifi',
                            'medical' => 'fa-medkit',
                            'camera' => 'fa-camera',
                            'photo' => 'fa-camera',
                            'game' => 'fa-binoculars',
                            'drive' => 'fa-route',
                            'transfer' => 'fa-exchange-alt',
                        ];
                        
                        function getIconForItem($item, $iconMap) {
                            $itemLower = strtolower($item);
                            foreach ($iconMap as $keyword => $icon) {
                                if (strpos($itemLower, $keyword) !== false) {
                                    return $icon;
                                }
                            }
                            return 'fa-check';
                        }
                    @endphp
                    
                    @if(count($inclusions) > 0 || count($exclusions) > 0)
                    <div class="mt-5 pt-4">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="icon-circle-lg d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                                <i class="fas fa-clipboard-list text-white fa-lg"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif; color: #3E2723;">What's Included</h3>
                                <p class="text-muted small mb-0">Everything covered in your package</p>
                            </div>
                        </div>
                        
                        <div class="row g-4">
                            @if(count($inclusions) > 0)
                            <div class="col-md-6">
                                <div class="card border-0 rounded-4 h-100" style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                                    <div class="card-body p-4">
                                        <h5 class="fw-bold mb-4 d-flex align-items-center gap-2" style="color: #155724;">
                                            <i class="fas fa-check-circle"></i> Package Includes
                                        </h5>
                                        <div class="row g-3">
                                            @foreach($inclusions as $inc)
                                            <div class="col-12">
                                                <div class="d-flex align-items-start gap-3 p-3 rounded-3" style="background: rgba(255,255,255,0.7);">
                                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 36px; height: 36px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                                                        <i class="fas {{ getIconForItem($inc, $iconMap) }} text-white" style="font-size: 14px;"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span class="fw-semibold" style="color: #155724; font-size: 14px;">{{ $inc }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            @if(count($exclusions) > 0)
                            <div class="col-md-6">
                                <div class="card border-0 rounded-4 h-100" style="background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);">
                                    <div class="card-body p-4">
                                        <h5 class="fw-bold mb-4 d-flex align-items-center gap-2" style="color: #721c24;">
                                            <i class="fas fa-times-circle"></i> Not Included
                                        </h5>
                                        <div class="row g-3">
                                            @foreach($exclusions as $exc)
                                            <div class="col-12">
                                                <div class="d-flex align-items-start gap-3 p-3 rounded-3" style="background: rgba(255,255,255,0.7);">
                                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 36px; height: 36px; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
                                                        <i class="fas {{ getIconForItem($exc, $iconMap) }} text-white" style="font-size: 14px;"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span class="fw-semibold" style="color: #721c24; font-size: 14px;">{{ $exc }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- You might also like section -->
                <div class="mt-5 pt-5 border-top">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-circle-lg d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                            <i class="fas fa-compass text-white fa-lg"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif; color: #3E2723;">You might also like...</h3>
                            <p class="text-muted small mb-0">Similar safari adventures</p>
                        </div>
                    </div>
                    
                    <div class="row g-4">
                        @foreach($relatedPackages as $rp)
                        <div class="col-md-4">
                            <a href="{{ route('safari.show', $rp->slug) }}" class="text-decoration-none">
                                <div class="package-card h-100 rounded-4 overflow-hidden border-0 shadow-sm bg-white position-relative hover-lift transition-all" style="cursor: pointer;">
                                    <div class="package-img-wrapper" style="height: 200px; position: relative; overflow: hidden;">
                                        <img src="{{ asset($rp->image) }}" class="w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;" alt="{{ $rp->title }}" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                        <div class="position-absolute bottom-0 start-0 end-0 p-2" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                                            <span class="badge text-white" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); font-size: 11px;">
                                                <i class="fas fa-clock me-1"></i>{{ $rp->days }} Days
                                            </span>
                                        </div>
                                        <button class="wishlist-btn position-absolute top-0 end-0 m-3 border-0 bg-white rounded-circle shadow-sm d-flex align-items-center justify-content-center hover-scale" style="width: 35px; height: 35px; transition: all 0.3s;" onclick="event.preventDefault(); event.stopPropagation(); toggleWishlist({{ $rp->id }})">
                                            <i class="far fa-heart text-dark" style="font-size: 14px;"></i>
                                        </button>
                                    </div>
                                    <div class="p-4">
                                        <h6 class="fw-bold mb-2 text-dark" style="font-size: 0.95rem; line-height: 1.4; min-height: 2.7rem;">{{ $rp->title }}</h6>
                                        <div class="d-flex align-items-center gap-2 mb-3">
                                            <span class="badge bg-light text-dark border" style="font-size: 10px;"><i class="fas fa-paw me-1 text-warning"></i>Safari</span>
                                            <span class="badge bg-light text-dark border" style="font-size: 10px;"><i class="fas fa-user-friends me-1 text-primary"></i>Private</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                            <div class="price-info">
                                                <small class="text-muted d-block" style="font-size: 0.75rem;">Starting from</small>
                                                <span class="fw-bold fs-5" style="color: #8B4513;">${{ number_format($rp->price, 0) }}</span>
                                                <small class="text-muted" style="font-size: 0.7rem;">/person</small>
                                            </div>
                                            <span class="btn btn-sm rounded-pill px-3" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white; font-size: 12px;">
                                                View <i class="fas fa-arrow-right ms-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="text-center mt-5">
                        <a href="{{ route('tours.all') }}" class="btn btn-lg rounded-pill px-5 py-3 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white; box-shadow: 0 4px 15px rgba(139,69,19,0.3);">
                            <i class="fas fa-th-large me-2"></i>View All Safari Tours
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar: Trip Info -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <div class="booking-card p-4 rounded-4 shadow-lg bg-white border-0 animate__animated animate__fadeInRight">
                        <h4 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Trip Details</h4>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Duration</span>
                                <span class="fw-bold">{{ $package->days }} Days</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Price</span>
                                <span class="fw-bold fs-4 text-dark">${{ number_format($package->price, 0) }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Per Person</span>
                                <span class="badge bg-earth-light text-primary">All Inclusive</span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">What's Included</h6>
                            <ul class="list-unstyled small">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Professional guides</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> All meals</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Accommodation</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Transportation</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i> Park fees</li>
                            </ul>
                        </div>

                        <button type="button" class="btn btn-earth w-100 py-3 fw-bold" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                            BOOK THIS SAFARI <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>

                    <div class="mt-4 p-4 rounded-4 shadow-sm animate__animated animate__fadeInRight animate__delay-1s" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
                        <h5 class="fw-bold mb-3 text-white">Why booking with Us?</h5>
                        <ul class="list-unstyled small text-white" style="opacity: 0.95;">
                            <li class="mb-2 d-flex align-items-center"><i class="fas fa-check-circle me-2" style="color: #8B4513;"></i> <span>Free cancellation up to 24 hours</span></li>
                            <li class="mb-2 d-flex align-items-center"><i class="fas fa-check-circle me-2" style="color: #8B4513;"></i> <span>Trusted by 100K+ travelers</span></li>
                            <li class="mb-2 d-flex align-items-center"><i class="fas fa-check-circle me-2" style="color: #8B4513;"></i> <span>Get the lowest prices</span></li>
                            <li class="mb-0 d-flex align-items-center"><i class="fas fa-check-circle me-2" style="color: #8B4513;"></i> <span>24-hour support</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.scripts')

    <script>
    // Wishlist toggle function
    function toggleWishlist(tourId) {
        const btn = event.currentTarget;
        const icon = btn.querySelector('i');
        
        // Toggle heart icon
        if (icon.classList.contains('far')) {
            icon.classList.remove('far');
            icon.classList.add('fas');
            icon.style.color = '#dc3545';
            
            // Show toast notification
            showToast('Added to your wishlist!');
        } else {
            icon.classList.remove('fas');
            icon.classList.add('far');
            icon.style.color = '';
            
            showToast('Removed from wishlist');
        }
        
        // Here you would normally send an AJAX request to save to database
        // fetch('/wishlist/add', { method: 'POST', body: JSON.stringify({tour_id: tourId}) })
    }
    
    // Simple toast notification
    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'position-fixed top-0 end-0 m-3 p-3 rounded-4 text-white fw-bold';
        toast.style.cssText = 'background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); z-index: 9999; animation: slideIn 0.3s ease;';
        toast.innerHTML = '<i class="fas fa-heart me-2"></i>' + message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 2000);
    }
    </script>
    
    <style>
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    </style>
</body>
</html>
