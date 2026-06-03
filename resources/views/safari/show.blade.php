<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $package->title }} - Go Deep Africa Safari</title>
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .safari-hero {
            min-height: 60vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 100%),
                        url('{{ asset($package->image) }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .timeline-line {
            position: absolute;
            left: 24px;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(180deg, #8B4513 0%, #D2691E 100%);
            border-radius: 3px;
        }
        .timeline-dot {
            position: absolute;
            left: 15px;
            width: 22px;
            height: 22px;
            background: #8B4513;
            border: 3px solid #fff;
            box-shadow: 0 2px 8px rgba(139,69,19,0.3);
        }
        .booking-card {
            position: sticky;
            top: 100px;
        }
        .amenity-card {
            transition: all 0.3s ease;
        }
        .amenity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(139, 69, 19, 0.2);
        }
    </style>
</head>
<body class="bg-light">
    @include('partials.header')

    <!-- Hero Section -->
    <section class="safari-hero text-white d-flex align-items-center">
        <div class="container" data-aos="fade-up">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('safari') }}" class="text-white">Safari</a></li>
                    <li class="breadcrumb-item active text-white opacity-75" aria-current="page">{{ Str::limit($package->title, 30) }}</li>
                </ol>
            </nav>
            <h1 class="display-3 fw-bold mb-3" style="font-family: 'Playfair Display', serif;">{{ $package->title }}</h1>
            <div class="d-flex gap-3 flex-wrap mb-4">
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-clock me-2"></i>{{ $package->days }} Days
                </span>
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-star text-warning me-2"></i>5.0 Rating
                </span>
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-users me-2"></i>Private Safari
                </span>
            </div>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Overview -->
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm mb-4" data-aos="fade-up">
                    <h2 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif; color: #3E2723;">Safari Overview</h2>
                    <p class="lead text-muted mb-4">{{ $package->summary }}</p>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="text-center p-3 rounded-3" style="background: rgba(139, 69, 19, 0.1);">
                                <i class="fas fa-map-marker-alt fa-2x mb-2" style="color: #8B4513;"></i>
                                <h6 class="fw-bold mb-0" style="color: #3E2723;">Multiple Parks</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 rounded-3" style="background: rgba(139, 69, 19, 0.1);">
                                <i class="fas fa-binoculars fa-2x mb-2" style="color: #8B4513;"></i>
                                <h6 class="fw-bold mb-0" style="color: #3E2723;">Game Drives</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 rounded-3" style="background: rgba(139, 69, 19, 0.1);">
                                <i class="fas fa-camera fa-2x mb-2" style="color: #8B4513;"></i>
                                <h6 class="fw-bold mb-0" style="color: #3E2723;">Photography</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Itinerary -->
                @php
                    $itinerary = is_array($package->itinerary) ? $package->itinerary : (is_string($package->itinerary) ? json_decode($package->itinerary, true) : []);
                    if (!is_array($itinerary) || count($itinerary) == 0) {
                        // Default itinerary based on package days
                        $itinerary = [];
                        for($i = 1; $i <= $package->days; $i++) {
                            $itinerary[] = [
                                'day' => $i,
                                'title' => 'Day ' . $i . ' - Safari Adventure',
                                'description' => 'Experience the best of Tanzania\'s wildlife with morning and afternoon game drives. Enjoy delicious meals and comfortable accommodation. Our expert guides will ensure you have an unforgettable safari experience.',
                                'image' => null
                            ];
                        }
                    }
                @endphp
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-circle-lg d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                            <i class="fas fa-route text-white fa-lg"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif; color: #3E2723;">Detailed Itinerary</h2>
                            <p class="text-muted small mb-0">{{ count($itinerary) }} Days of Adventure</p>
                        </div>
                    </div>
                    
                    <div class="timeline position-relative">
                        <div class="timeline-line"></div>
                        
                        @foreach($itinerary as $step)
                        <div class="timeline-item position-relative ps-5 pb-4">
                            <div class="timeline-dot d-flex align-items-center justify-content-center rounded-circle">
                                <span class="text-white fw-bold" style="font-size: 10px;">{{ $step['day'] ?? $loop->iteration }}</span>
                            </div>
                            
                            <div class="card border-0 rounded-4 shadow-sm overflow-hidden" style="background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);">
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

                <!-- Amenities -->
                @php
                    $inclusions = is_array($package->inclusions) ? $package->inclusions : (is_string($package->inclusions) ? json_decode($package->inclusions, true) : []);
                    $exclusions = is_array($package->exclusions) ? $package->exclusions : (is_string($package->exclusions) ? json_decode($package->exclusions, true) : []);
                    if (!is_array($inclusions)) $inclusions = [];
                    if (!is_array($exclusions)) $exclusions = [];
                    
                    $iconMap = [
                        'flight' => 'fa-plane', 'airport' => 'fa-plane-arrival', 'pickup' => 'fa-car',
                        'accommodation' => 'fa-bed', 'lodge' => 'fa-hotel', 'camp' => 'fa-campground',
                        'meal' => 'fa-utensils', 'food' => 'fa-utensils', 'breakfast' => 'fa-coffee',
                        'lunch' => 'fa-hamburger', 'dinner' => 'fa-wine-glass', 'park' => 'fa-tree',
                        'fee' => 'fa-ticket-alt', 'transport' => 'fa-bus', 'vehicle' => 'fa-car-side',
                        'guide' => 'fa-user-tie', 'water' => 'fa-tint', 'drink' => 'fa-glass-water',
                        'tax' => 'fa-receipt', 'insurance' => 'fa-shield-alt', 'visa' => 'fa-passport',
                        'tip' => 'fa-hand-holding-usd', 'personal' => 'fa-shopping-bag', 'alcohol' => 'fa-wine-bottle',
                        'wifi' => 'fa-wifi', 'internet' => 'fa-wifi', 'medical' => 'fa-medkit',
                        'camera' => 'fa-camera', 'photo' => 'fa-camera', 'game' => 'fa-binoculars',
                        'drive' => 'fa-route', 'transfer' => 'fa-exchange-alt',
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
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-circle-lg d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                            <i class="fas fa-clipboard-list text-white fa-lg"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif; color: #3E2723;">What's Included</h2>
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
                                            <div class="d-flex align-items-start gap-3 p-3 rounded-3 amenity-card" style="background: rgba(255,255,255,0.7);">
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
                                            <div class="d-flex align-items-start gap-3 p-3 rounded-3 amenity-card" style="background: rgba(255,255,255,0.7);">
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

                <!-- Related Packages -->
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm" data-aos="fade-up" data-aos-delay="300">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-circle-lg d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                            <i class="fas fa-compass text-white fa-lg"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif; color: #3E2723;">You might also like...</h2>
                            <p class="text-muted small mb-0">Similar safari adventures</p>
                        </div>
                    </div>
                    
                    <div class="row g-4">
                        @foreach($relatedPackages as $rp)
                        <div class="col-md-4">
                            <a href="{{ route('safari.show', $rp->slug) }}" class="text-decoration-none">
                                <div class="package-card h-100 rounded-4 overflow-hidden border-0 shadow-sm bg-white position-relative" style="cursor: pointer;">
                                    <div class="package-img-wrapper" style="height: 200px; position: relative; overflow: hidden;">
                                        <img src="{{ asset($rp->image) }}" class="w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;" alt="{{ $rp->title }}">
                                        <div class="position-absolute bottom-0 start-0 end-0 p-2" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                                            <span class="badge text-white" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); font-size: 11px;">
                                                <i class="fas fa-clock me-1"></i>{{ $rp->days }} Days
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h6 class="fw-bold mb-2 text-dark" style="font-size: 0.95rem; line-height: 1.4; min-height: 2.7rem;">{{ $rp->title }}</h6>
                                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                            <div class="price-info">
                                                <small class="text-muted d-block" style="font-size: 0.75rem;">Starting from</small>
                                                <span class="fw-bold fs-5" style="color: #8B4513;">${{ number_format($rp->price, 0) }}</span>
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
                    
                    <div class="text-center mt-4">
                        <a href="{{ route('safari') }}" class="btn btn-lg rounded-pill px-5 py-3 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                            <i class="fas fa-th-large me-2"></i>View All Safari Tours
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar: Booking -->
            <div class="col-lg-4">
                <div class="booking-card p-4 rounded-4 shadow-lg bg-white border-0" data-aos="fade-left">
                    <h4 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif; color: #3E2723;">Book This Safari</h4>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3" style="background: rgba(139, 69, 19, 0.1);">
                            <span class="text-muted"><i class="fas fa-clock me-2"></i>Duration</span>
                            <span class="fw-bold">{{ $package->days }} Days</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3" style="background: rgba(139, 69, 19, 0.1);">
                            <span class="text-muted"><i class="fas fa-tag me-2"></i>Price</span>
                            <span class="fw-bold fs-4" style="color: #8B4513;">${{ number_format($package->price, 0) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3" style="background: rgba(139, 69, 19, 0.1);">
                            <span class="text-muted"><i class="fas fa-user me-2"></i>Per Person</span>
                            <span class="badge bg-success">All Inclusive</span>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: #3E2723;">Quick Inclusions</h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="d-flex align-items-center gap-2 small">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Professional Guides</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center gap-2 small">
                                    <i class="fas fa-check text-success"></i>
                                    <span>All Meals</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center gap-2 small">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Accommodation</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center gap-2 small">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Transportation</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center gap-2 small">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Park Fees</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center gap-2 small">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Game Drives</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn w-100 rounded-pill py-3 fw-bold mb-3" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                        <i class="fas fa-calendar-check me-2"></i>Book Now
                    </button>
                    
                    <button type="button" class="btn w-100 rounded-pill py-3 fw-bold" style="background: transparent; border: 2px solid #8B4513; color: #8B4513;" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                        <i class="fas fa-envelope me-2"></i>Send Inquiry
                    </button>
                </div>

                <div class="mt-4 p-4 rounded-4 shadow-sm" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);" data-aos="fade-left" data-aos-delay="100">
                    <h5 class="fw-bold mb-3 text-white">Why Book With Us?</h5>
                    <ul class="list-unstyled small text-white" style="opacity: 0.95;">
                        <li class="mb-2 d-flex align-items-center"><i class="fas fa-check-circle me-2" style="color: #8B4513;"></i> <span>Free cancellation up to 24 hours</span></li>
                        <li class="mb-2 d-flex align-items-center"><i class="fas fa-check-circle me-2" style="color: #8B4513;"></i> <span>Trusted by 100K+ travelers</span></li>
                        <li class="mb-2 d-flex align-items-center"><i class="fas fa-check-circle me-2" style="color: #8B4513;"></i> <span>Best price guarantee</span></li>
                        <li class="mb-0 d-flex align-items-center"><i class="fas fa-check-circle me-2" style="color: #8B4513;"></i> <span>24/7 customer support</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- General Inquiry Modal -->
    <div class="modal fade" id="generalInquiryModal" tabindex="-1" aria-labelledby="generalInquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
                    <h5 class="modal-title text-white fw-bold" id="generalInquiryModalLabel">Book This Safari</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="generalInquiryForm" action="{{ route('safari.enquire', $package->slug) }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name *</label>
                                <input type="text" name="name" class="form-control rounded-3" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email Address *</label>
                                <input type="email" name="email" class="form-control rounded-3" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone Number *</label>
                                <input type="tel" name="phone" class="form-control rounded-3" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Number of Travelers *</label>
                                <input type="number" name="travelers" class="form-control rounded-3" min="1" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Preferred Travel Date *</label>
                                <input type="date" name="travel_date" class="form-control rounded-3" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Budget Range</label>
                                <select name="budget" class="form-select rounded-3">
                                    <option value="">Select budget</option>
                                    <option value="budget">Budget</option>
                                    <option value="mid-range">Mid-Range</option>
                                    <option value="luxury">Luxury</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Additional Requirements</label>
                                <textarea name="message" class="form-control rounded-3" rows="4" placeholder="Tell us about your preferences, special requests, or any questions..."></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn w-100 rounded-pill py-3 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Inquiry
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>
</html>
