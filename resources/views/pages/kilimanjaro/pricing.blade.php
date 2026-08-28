<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', [
        'seoTitle' => 'Private Kilimanjaro Tours & Climb Pricing | Go Deep Africa',
        'seoDescription' => 'Private Kilimanjaro treks with clear, all-inclusive pricing. Choose your route, dates and group size, guided by experienced local Tanzanian mountain crews.',
        'seoKeywords' => 'Kilimanjaro cost, private Kilimanjaro tour, Kilimanjaro climb price, how much to climb Kilimanjaro',
        'seoSchema' => json_encode([[
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Kilimanjaro', 'item' => route('kilimanjaro')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Private Tours & Pricing', 'item' => route('kilimanjaro.private-tours')],
            ],
        ]], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
    ])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .pricing-hero {
            min-height: 60vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 100%),
                        url('{{ bg('bg_kili_pricing', 'https://images.unsplash.com/photo-1589553416260-f586c8f1514f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') }}');
            background-size: cover;
            background-position: center;
        }
        .price-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .price-card:hover {
            transform: translateY(-10px);
            border-color: #8B4513;
        }
        .price-card.featured {
            border-color: #8B4513;
            transform: scale(1.02);
        }
        .price-badge {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            color: white;
            padding: 8px 24px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
        }
        .feature-check {
            color: #28a745;
        }
        .feature-x {
            color: #dc3545;
        }
    </style>
</head>
<body>
    @include('partials.header')

    <!-- Hero -->
    <section class="pricing-hero text-white d-flex align-items-center">
        <div class="container text-center" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-4 py-2 mb-3">
                <i class="fas fa-tag me-2"></i>Transparent Pricing
            </span>
            <h1 class="display-3 fw-bold mb-4" style="font-family: 'Nunito', sans-serif;">
                Private Kilimanjaro Tours & Pricing
            </h1>
            <p class="lead mx-auto mb-4" style="max-width: 700px;">
                No hidden fees. No surprises. Just world-class service at honest prices.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-check-circle text-success me-2"></i>All-Inclusive
                </span>
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-check-circle text-success me-2"></i>Best Price Guarantee
                </span>
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-check-circle text-success me-2"></i>Flexible Booking
                </span>
            </div>
        </div>
    </section>

    <!-- Pricing Cards -->
    <section class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3" style="color: #3E2723; font-family: 'Nunito', sans-serif;">
                    Choose Your Experience
                </h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">
                    All packages include: Park fees, transfers, meals, equipment, guides, and 24/7 support
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Standard Package -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="price-card card h-100 border-0 rounded-4 shadow-sm position-relative">
                        <div class="card-body p-4 p-lg-5">
                            <h4 class="fw-bold mb-2" style="color: #3E2723;">Standard Trek</h4>
                            <p class="text-muted small mb-4">Perfect for budget-conscious adventurers</p>
                            
                            <div class="mb-4">
                                <span class="display-4 fw-bold" style="color: #8B4513;">$1,850</span>
                                <span class="text-muted">/person</span>
                                <p class="small text-muted mb-0">6-day Machame Route</p>
                            </div>

                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>All park fees included</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Professional guides (3:1 ratio)</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Mountain tents & sleeping bags</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>3 hot meals daily</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Airport transfers</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Emergency oxygen</li>
                                <li class="mb-2 text-muted"><i class="fas fa-times feature-x me-2"></i>Portable toilet</li>
                                <li class="mb-2 text-muted"><i class="fas fa-times feature-x me-2"></i>Hot showers</li>
                                <li class="text-muted"><i class="fas fa-times feature-x me-2"></i>Private camp</li>
                            </ul>

                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-3 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Enquire Now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Comfort Package (Featured) -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="price-card featured card h-100 border-0 rounded-4 shadow-lg position-relative">
                        <span class="price-badge">Most Popular</span>
                        <div class="card-body p-4 p-lg-5">
                            <h4 class="fw-bold mb-2" style="color: #3E2723;">Comfort Climb</h4>
                            <p class="text-muted small mb-4">Enhanced comfort for serious climbers</p>
                            
                            <div class="mb-4">
                                <span class="display-4 fw-bold" style="color: #8B4513;">$2,450</span>
                                <span class="text-muted">/person</span>
                                <p class="small text-muted mb-0">7-day Lemosho Route</p>
                            </div>

                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i><strong>Everything in Standard</strong></li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Portable toilet tent</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Camp cot with mattress</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Hot water bottles</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Welcome hotel night</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Fresh coffee daily</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Celebration dinner</li>
                                <li class="mb-2 text-muted"><i class="fas fa-times feature-x me-2"></i>Hot showers</li>
                                <li class="text-muted"><i class="fas fa-times feature-x me-2"></i>Private camp</li>
                            </ul>

                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-3 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Book This Package
                            </a>
                        </div>
                    </div>
                </div>

                <!-- VIP Package -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="price-card card h-100 border-0 rounded-4 shadow-sm position-relative">
                        <div class="card-body p-4 p-lg-5">
                            <h4 class="fw-bold mb-2" style="color: #3E2723;">VIP Summit Experience</h4>
                            <p class="text-muted small mb-4">Ultimate luxury on Kilimanjaro</p>
                            
                            <div class="mb-4">
                                <span class="display-4 fw-bold" style="color: #8B4513;">$3,850</span>
                                <span class="text-muted">/person</span>
                                <p class="small text-muted mb-0">8-day Northern Circuit</p>
                            </div>

                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i><strong>Everything in Comfort</strong></li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Private camp (no sharing)</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Portable hot showers</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Chef-prepared meals</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Solar charging station</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>2:1 guide ratio</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Luxury hotel 2 nights</li>
                                <li class="mb-2"><i class="fas fa-check feature-check me-2"></i>Summit champagne</li>
                                <li><i class="fas fa-check feature-check me-2"></i>Professional photography</li>
                            </ul>

                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-3 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Enquire for VIP
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Group Size Discounts -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="display-5 fw-bold mb-4" style="color: #3E2723; font-family: 'Nunito', sans-serif;">
                        Group Size Discounts
                    </h2>
                    <p class="text-muted mb-4">
                        The more, the merrier! Bring your friends and save on your Kilimanjaro adventure.
                    </p>
                    <div class="card border-0 rounded-4 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                <div>
                                    <h6 class="fw-bold mb-0">Solo Climber</h6>
                                    <small class="text-muted">Just you and our team</small>
                                </div>
                                <span class="badge bg-secondary">Standard Price</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                <div>
                                    <h6 class="fw-bold mb-0">2-4 People</h6>
                                    <small class="text-muted">Perfect for couples & small groups</small>
                                </div>
                                <span class="badge bg-success">5% OFF each</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                <div>
                                    <h6 class="fw-bold mb-0">5-9 People</h6>
                                    <small class="text-muted">Friends & family adventure</small>
                                </div>
                                <span class="badge bg-success">10% OFF each</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <h6 class="fw-bold mb-0" style="color: #8B4513;">10+ People</h6>
                                    <small class="text-muted">Corporate groups, clubs, large families</small>
                                </div>
                                <span class="badge bg-warning text-dark">15% OFF each</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1533240332313-0db49b459ad6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" style="height: 300px; object-fit: cover;" alt="Group climbing">
                        <div class="card-body p-4" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
                            <h4 class="fw-bold text-white mb-2">Corporate & Charity Groups</h4>
                            <p class="text-white-75 mb-3">Special rates for team-building events and charity fundraisers.</p>
                            <a href="{{ route('contact') }}" class="btn btn-light rounded-pill px-4">
                                <i class="fas fa-building me-2"></i>Corporate Inquiry
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What's Included -->
    <section class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3" style="color: #3E2723; font-family: 'Nunito', sans-serif;">
                    What's Included (No Hidden Costs!)
                </h2>
            </div>
            <div class="row g-4">
                @php
                $inclusions = [
                    ['icon' => 'fa-receipt', 'title' => 'Park Fees', 'desc' => 'Conservation & camping fees'],
                    ['icon' => 'fa-bus', 'title' => 'Airport Transfers', 'desc' => 'Both arrival & departure'],
                    ['icon' => 'fa-utensils', 'title' => 'All Meals', 'desc' => 'Breakfast, lunch & dinner'],
                    ['icon' => 'fa-user-tie', 'title' => 'Professional Guides', 'desc' => 'Certified mountain guides'],
                    ['icon' => 'fa-campground', 'title' => 'Camping Equipment', 'desc' => 'Tents, sleeping bags, mats'],
                    ['icon' => 'fa-first-aid', 'title' => 'Safety Equipment', 'desc' => 'Emergency oxygen, first aid'],
                    ['icon' => 'fa-weight-hanging', 'title' => 'Porters', 'desc' => 'Carry your gear up the mountain'],
                    ['icon' => 'fa-coffee', 'title' => 'Drinks', 'desc' => 'Tea, coffee, drinking water'],
                ];
                @endphp

                @foreach($inclusions as $item)
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="text-center p-3">
                        <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 70px; height: 70px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                            <i class="fas {{ $item['icon'] }} text-white fa-lg"></i>
                        </div>
                        <h6 class="fw-bold mb-1" style="color: #3E2723;">{{ $item['title'] }}</h6>
                        <small class="text-muted">{{ $item['desc'] }}</small>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Not Included -->
    <div class="mt-5 p-4 rounded-4" style="background: #f8f9fa;" data-aos="fade-up">
        <h5 class="fw-bold mb-3" style="color: #3E2723;">Not Included (Budget Separately):</h5>
        <div class="row g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-plane text-muted"></i>
                            <span>International flights to Tanzania</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-passport text-muted"></i>
                            <span>Visa ($50-100 depending on nationality)</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-hospital text-muted"></i>
                            <span>Travel insurance (required)</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-tshirt text-muted"></i>
                            <span>Personal clothing & gear</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-gift text-muted"></i>
                            <span>Tips for guides & porters ($200-300 recommended)</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-cocktail text-muted"></i>
                            <span>Alcoholic beverages & sodas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Payment Options -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="card border-0 rounded-4 shadow-lg overflow-hidden">
                <div class="row g-0">
                    <div class="col-lg-6 p-5" data-aos="fade-right">
                        <h2 class="fw-bold mb-4" style="color: #3E2723; font-family: 'Nunito', sans-serif;">
                            Flexible Payment Options
                        </h2>
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle bg-success text-white" style="width: 50px; height: 50px;">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">$100 Deposit Only</h6>
                                    <small class="text-muted">Secure your spot today</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                    <i class="fas fa-calendar-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">Pay Balance 30 Days Before</h6>
                                    <small class="text-muted">Easy payment schedule</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width: 50px; height: 50px;">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">Multiple Payment Methods</h6>
                                    <small class="text-muted">Bank transfer, card, or PayPal</small>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('contact') }}" class="btn rounded-pill px-5 py-3 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                            <i class="fas fa-calculator me-2"></i>Get Custom Quote
                        </a>
                    </div>
                    <div class="col-lg-6" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);" data-aos="fade-left">
                        <div class="h-100 p-5 text-white d-flex flex-column justify-content-center">
                            <h4 class="fw-bold mb-3">Why Book With Us?</h4>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3"><i class="fas fa-check-circle me-2" style="color: #DEB887;"></i>Lowest deposit in the industry</li>
                                <li class="mb-3"><i class="fas fa-check-circle me-2" style="color: #DEB887;"></i>Free date changes (30+ days notice)</li>
                                <li class="mb-3"><i class="fas fa-check-circle me-2" style="color: #DEB887;"></i>100% refund if trip cancelled by us</li>
                                <li class="mb-3"><i class="fas fa-check-circle me-2" style="color: #DEB887;"></i>Price match guarantee</li>
                                <li><i class="fas fa-check-circle me-2" style="color: #DEB887;"></i>Trusted by 8,000+ climbers</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
        <div class="container py-4 text-center text-white">
            <h2 class="fw-bold mb-3" style="font-family: 'Nunito', sans-serif;">Ready to Climb?</h2>
            <p class="lead mb-4 opacity-75">Get a personalized quote for your Kilimanjaro adventure</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('contact') }}" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                    <i class="fas fa-envelope me-2"></i>Request Quote
                </a>
                <a href="{{ route('kilimanjaro') }}" class="btn btn-lg btn-outline-light rounded-pill px-5 fw-bold">
                    <i class="fas fa-mountain me-2"></i>View Routes
                </a>
            </div>
        </div>
    </section>

    @include('partials.footer')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>
