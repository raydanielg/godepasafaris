<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        // Primary target: "affordable Tanzania safari packages from Arusha"
        // Supporting:     "3 day Serengeti safari from Arusha"
        $seoTitle = 'Affordable Tanzania Safari Packages from Arusha | Go Deep Africa';
        $seoDescription = 'Book affordable Tanzania safari packages from Arusha — from 3-day Serengeti & Ngorongoro trips to luxury tours. Private, all-inclusive, expert local guides. Free quote in 24 hours.';
        $seoKeywords = 'affordable Tanzania safari packages from Arusha, 3 day Serengeti safari from Arusha, Tanzania safari tours, Serengeti Ngorongoro safari, budget safari Arusha, Tanzania safari cost';

        // FAQ shown on-page AND emitted as FAQPage schema (kept in sync).
        $safariFaqs = [
            [
                'q' => 'How much does a Tanzania safari from Arusha cost?',
                'a' => 'Affordable Tanzania safari packages from Arusha start from around $240 for a 1-day trip, while a popular 3-day Serengeti and Ngorongoro safari typically ranges from a few hundred dollars per person per day depending on season, group size and accommodation. Joining a shared group departure is the cheapest option — we send exact current pricing in your free quote within 24 hours.',
            ],
            [
                'q' => 'What is the best short safari from Arusha?',
                'a' => 'Our most popular short option is the 3-day Serengeti safari from Arusha, combining the Serengeti plains and the Ngorongoro Crater with up to four game drives. Park fees, a 4x4 game-drive vehicle, a professional guide, meals and accommodation are all included.',
            ],
            [
                'q' => 'What is included in your Tanzania safari packages?',
                'a' => 'Every package includes national park entry fees, a 4x4 safari vehicle with a pop-up roof, a professional English-speaking guide, and the accommodation and meals stated in the itinerary. International flights and personal items are excluded. We confirm every detail before you pay.',
            ],
            [
                'q' => 'When is the best time to go on a Tanzania safari?',
                'a' => 'June to October is the peak dry season with the best wildlife viewing and the Great Migration river crossings in the Serengeti. The green season (November to March) is quieter, greener and better value, with excellent resident game and birdlife.',
            ],
        ];

        $safariSchema = [
            [
                '@context' => 'https://schema.org',
                '@type' => 'ItemList',
                'name' => 'Tanzania Safari Packages from Arusha',
                'itemListElement' => collect($packages)->values()->map(function ($pkg, $i) {
                    return [
                        '@type' => 'ListItem',
                        'position' => $i + 1,
                        'item' => [
                            '@type' => 'Product',
                            'name' => $pkg->title,
                            'url' => route('safari.show', $pkg->slug),
                            'image' => asset($pkg->image),
                            'offers' => [
                                '@type' => 'Offer',
                                'price' => (string) (int) $pkg->price,
                                'priceCurrency' => 'USD',
                                'availability' => 'https://schema.org/InStock',
                            ],
                        ],
                    ];
                })->all(),
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => collect($safariFaqs)->map(fn ($f) => [
                    '@type' => 'Question',
                    'name' => $f['q'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
                ])->all(),
            ],
        ];
        $seoSchema = json_encode($safariSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    @endphp
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .safari-hero {
            min-height: 70vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 100%),
                        url('{{ bg('bg_safari', 'https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .package-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            overflow: hidden;
        }
        .package-card:hover {
            transform: translateY(-15px) scale(1.02);
            border-color: #8B4513;
            box-shadow: 0 25px 50px rgba(139, 69, 19, 0.25);
        }
        .package-card .package-img-wrapper {
            overflow: hidden;
        }
        .package-card .package-img-wrapper img {
            transition: transform 0.6s ease;
        }
        .package-card:hover .package-img-wrapper img {
            transform: scale(1.1);
        }
        .wishlist-btn {
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(-10px);
        }
        .package-card:hover .wishlist-btn {
            opacity: 1;
            transform: translateY(0);
        }
        .wishlist-btn:hover {
            background: #8B4513 !important;
            color: white !important;
        }
        .price-badge {
            position: absolute;
            bottom: 15px;
            left: 15px;
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
        }
        .filter-btn {
            transition: all 0.3s ease;
        }
        .filter-btn.active {
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            color: white;
            border-color: transparent;
        }
        .filter-btn:hover:not(.active) {
            background: rgba(139, 69, 19, 0.1);
            border-color: #8B4513;
        }
    </style>
</head>
<body>
    @include('partials.header')

    <!-- Hero Section -->
    <section class="safari-hero text-white d-flex align-items-center">
        <div class="container text-center" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-4 py-2 mb-3">
                <i class="fas fa-binoculars me-2"></i>Explore Tanzania
            </span>
            <h1 class="display-3 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">
                Affordable Tanzania Safari Packages from Arusha
            </h1>
            <p class="lead mx-auto mb-4" style="max-width: 720px;">
                Locally owned and based in Arusha, we run private and small-group Tanzania safaris to the Serengeti, Ngorongoro Crater and Tarangire — from quick 3-day getaways to luxury adventures. Find your trip below and get a free quote in 24 hours.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-check-circle text-success me-2"></i>Expert Guides
                </span>
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-check-circle text-success me-2"></i>Luxury Vehicles
                </span>
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-check-circle text-success me-2"></i>Best Locations
                </span>
            </div>
        </div>
    </section>

    <!-- SEO intro / internal linking -->
    <section class="py-5 bg-white">
        <div class="container" style="max-width: 920px;" data-aos="fade-up">
            <h2 class="fw-bold mb-3" style="color: #3E2723; font-family: 'Playfair Display', serif;">
                Tanzania Safari Packages from Arusha — for Every Budget
            </h2>
            <p class="text-muted mb-3">
                Arusha is the gateway to Northern Tanzania's legendary parks, and every safari below departs from here.
                Whether you want an <strong>affordable 3-day Serengeti safari from Arusha</strong>, a week-long Northern Circuit,
                or a private luxury adventure, our locally born guides handle everything — park permits, a 4x4 game-drive
                vehicle, meals and comfortable accommodation — so you just enjoy the wildlife.
            </p>
            <p class="text-muted mb-0">
                Popular routes take in the <a href="{{ route('destinations') }}" class="fw-semibold text-decoration-none" style="color:#8B4513;">Serengeti, Ngorongoro Crater and Tarangire</a>.
                Want more than game drives? Add a <a href="{{ route('zanzibar') }}" class="fw-semibold text-decoration-none" style="color:#8B4513;">Zanzibar beach holiday</a>
                after your safari, or take on a <a href="{{ route('kilimanjaro') }}" class="fw-semibold text-decoration-none" style="color:#8B4513;">Mount Kilimanjaro climb</a>.
                Not sure which package fits? <a href="{{ route('contact') }}" class="fw-semibold text-decoration-none" style="color:#8B4513;">Tell us your dates and budget</a> and we'll tailor-make one for you.
            </p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-4 bg-white sticky-top shadow-sm" style="z-index: 100;">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <button class="btn btn-outline-dark rounded-pill filter-btn active" onclick="filterPackages('all')">All Packages</button>
                <button class="btn btn-outline-dark rounded-pill filter-btn" onclick="filterPackages('short')">Short Safaris (1-3 Days)</button>
                <button class="btn btn-outline-dark rounded-pill filter-btn" onclick="filterPackages('medium')">Medium (4-7 Days)</button>
                <button class="btn btn-outline-dark rounded-pill filter-btn" onclick="filterPackages('long')">Extended (8+ Days)</button>
                <button class="btn btn-outline-dark rounded-pill filter-btn" onclick="filterPackages('luxury')">Luxury</button>
            </div>
        </div>
    </section>

    <!-- Packages Grid -->
    <section class="py-5">
        <div class="container py-4">
            <h2 class="fw-bold mb-4 text-center" style="color: #3E2723; font-family: 'Playfair Display', serif;" data-aos="fade-up">
                Popular Tanzania Safari Packages from Arusha
            </h2>
            <div class="row g-4" id="packages-grid">
                @foreach($packages as $pkg)
                @php
                $days = $pkg->days;
                $category = $days <= 3 ? 'short' : ($days <= 7 ? 'medium' : 'long');
                @endphp
                <div class="col-lg-4 col-md-6 package-item" data-category="{{ $category }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="package-card card h-100 border-0 rounded-4 shadow-sm bg-white position-relative">
                        <a href="{{ route('safari.show', $pkg->slug) }}" class="text-decoration-none">
                            <div class="package-img-wrapper" style="height: 280px; position: relative;">
                                <img src="{{ asset($pkg->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $pkg->title }}" loading="lazy" decoding="async">
                                <button class="wishlist-btn position-absolute top-0 end-0 m-3 border-0 bg-white rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="far fa-heart text-dark"></i>
                                </button>
                                <div class="price-badge">
                                    ${{ number_format($pkg->price, 0) }}
                                </div>
                            </div>
                        </a>
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-clock me-1"></i>{{ $pkg->days }} Days
                                </span>
                                <div class="rating">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                </div>
                            </div>
                            <a href="{{ route('safari.show', $pkg->slug) }}" class="text-decoration-none">
                                <h5 class="fw-bold mb-3" style="color: #3E2723; font-family: 'Playfair Display', serif; min-height: 3rem;">{{ tr($pkg->title) }}</h5>
                            </a>
                            <p class="text-muted small mb-4">{{ Str::limit(tr($pkg->summary), 120) }}</p>
                            
                            <div class="mt-auto">
                                <div class="d-flex gap-2 mb-3 flex-wrap">
                                    <span class="badge bg-light text-dark small">
                                        <i class="fas fa-map-marker-alt me-1"></i>Multiple Parks
                                    </span>
                                    <span class="badge bg-light text-dark small">
                                        <i class="fas fa-camera me-1"></i>Game Drives
                                    </span>
                                </div>
                                <a href="{{ route('safari.show', $pkg->slug) }}" class="btn w-100 rounded-pill py-2 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                    <i class="fas fa-eye me-2"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <h2 class="display-5 fw-bold mb-4 text-center" style="color: #3E2723; font-family: 'Playfair Display', serif;" data-aos="fade-up">
                Featured Destinations
            </h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-100" style="height: 200px; object-fit: cover;" alt="Serengeti">
                        <div class="card-body p-3 text-center">
                            <h5 class="fw-bold mb-0" style="color: #3E2723;">Serengeti National Park</h5>
                            <small class="text-muted">Great Migration</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-100" style="height: 200px; object-fit: cover;" alt="Ngorongoro">
                        <div class="card-body p-3 text-center">
                            <h5 class="fw-bold mb-0" style="color: #3E2723;">Ngorongoro Crater</h5>
                            <small class="text-muted">World's Wonder</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1612036782180-6f0b6cd846fe?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-100" style="height: 200px; object-fit: cover;" alt="Tarangire">
                        <div class="card-body p-3 text-center">
                            <h5 class="fw-bold mb-0" style="color: #3E2723;">Tarangire National Park</h5>
                            <small class="text-muted">Elephant Paradise</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section (mirrors FAQPage schema in <head>) -->
    <section class="py-5 bg-white">
        <div class="container py-2" style="max-width: 860px;">
            <h2 class="fw-bold mb-4 text-center" style="color: #3E2723; font-family: 'Playfair Display', serif;" data-aos="fade-up">
                Tanzania Safari from Arusha — Frequently Asked Questions
            </h2>
            @foreach($safariFaqs as $faq)
            <details class="mb-3 p-3 rounded-4 border" style="background:#fdfaf5;" @if($loop->first) open @endif>
                <summary class="fw-bold" style="cursor:pointer; color:#3E2723; list-style:none;">
                    <i class="fas fa-chevron-right me-2" style="font-size:.8rem; color:#8B4513;"></i>{{ $faq['q'] }}
                </summary>
                <p class="text-muted mt-3 mb-0">{{ $faq['a'] }}</p>
            </details>
            @endforeach
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
        <div class="container py-4 text-center text-white">
            <h2 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Can't Find What You're Looking For?</h2>
            <p class="lead mb-4 opacity-75">Let us create a custom safari just for you</p>
            <a href="{{ route('contact') }}" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                <i class="fas fa-magic me-2"></i>Request Custom Safari
            </a>
        </div>
    </section>

    @include('partials.footer')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        function filterPackages(category) {
            const items = document.querySelectorAll('.package-item');
            const buttons = document.querySelectorAll('.filter-btn');
            
            // Update active button
            buttons.forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // Filter items
            items.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = '';
                    setTimeout(() => item.style.opacity = '1', 10);
                } else {
                    item.style.opacity = '0';
                    setTimeout(() => item.style.display = 'none', 300);
                }
            });
        }
    </script>
</body>
</html>
