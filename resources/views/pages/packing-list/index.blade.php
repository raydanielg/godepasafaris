<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Packing Lists - Go Deep Africa Safari</title>
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .packing-hero {
            min-height: 60vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 50%, rgba(62,39,35,0.9) 100%),
                        url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
        }
        .category-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .category-card:hover {
            transform: translateY(-5px);
            border-color: #8B4513;
            box-shadow: 0 15px 40px rgba(139, 69, 19, 0.15);
        }
        .list-card {
            transition: all 0.3s ease;
        }
        .list-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .essential-badge {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #3E2723;
        }
    </style>
</head>
<body>
    @include('partials.header')

    <!-- Hero Section -->
    <section class="packing-hero text-white position-relative">
        <div class="container text-center" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-4 py-2 mb-3 animate__animated animate__fadeInDown">
                <i class="fas fa-suitcase me-2"></i>Travel Preparation
            </span>
            <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInUp" style="font-family: 'Playfair Display', serif; text-shadow: 2px 4px 20px rgba(0,0,0,0.5);">
                What to Pack for Your Safari
            </h1>
            <p class="lead mx-auto mb-4 animate__animated animate__fadeInUp" style="max-width: 700px; text-shadow: 1px 2px 10px rgba(0,0,0,0.5);">
                Comprehensive packing guides for Kilimanjaro climbs, safari adventures, and general travel to Tanzania.
            </p>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="row g-4 justify-content-center">
                @php
                    $categories = [
                        'kilimanjaro' => ['name' => 'Kilimanjaro', 'icon' => 'fa-mountain', 'desc' => 'Climbing essentials', 'color' => '#8B4513'],
                        'safari' => ['name' => 'Safari', 'icon' => 'fa-paw', 'desc' => 'Wildlife adventure', 'color' => '#D2691E'],
                        'general' => ['name' => 'General', 'icon' => 'fa-suitcase', 'desc' => 'Travel basics', 'color' => '#6c757d'],
                    ];
                @endphp
                
                @foreach($categories as $key => $cat)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <a href="{{ route('packing-list.category', $key) }}" class="text-decoration-none">
                        <div class="category-card card h-100 border-0 rounded-4 shadow-sm text-center p-4">
                            <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 70px; height: 70px; background: {{ $cat['color'] }}20;">
                                <i class="fas {{ $cat['icon'] }} fa-2x" style="color: {{ $cat['color'] }};"></i>
                            </div>
                            <h4 class="fw-bold mb-2" style="color: #3E2723;">{{ $cat['name'] }}</h4>
                            <p class="text-muted mb-0">{{ $cat['desc'] }}</p>
                            <span class="badge mt-3 align-self-center" style="background: {{ $cat['color'] }};">
                                {{ $packingLists->where('category', $key)->count() }} lists
                            </span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- All Packing Lists -->
    <section class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3" style="color: #3E2723; font-family: 'Playfair Display', serif;">
                    Our Packing Lists
                </h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">
                    Expert-curated packing guides to ensure you're fully prepared for your adventure
                </p>
            </div>

            <div class="row g-4">
                @forelse($packingLists as $list)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="list-card card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                        @if($list->image)
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $list->image) }}" class="w-100" style="height: 200px; object-fit: cover;" alt="{{ $list->title }}">
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge text-white" style="background: {{ $list->category == 'kilimanjaro' ? '#8B4513' : ($list->category == 'safari' ? '#D2691E' : '#6c757d') }};">
                                    {{ ucfirst($list->category) }}
                                </span>
                            </div>
                        </div>
                        @endif
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle" style="width: 45px; height: 45px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                    <i class="fas {{ $list->icon }} text-white"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0" style="color: #3E2723;">{{ $list->title }}</h5>
                                </div>
                            </div>
                            <p class="text-muted small mb-3">{{ Str::limit($list->description, 100) }}</p>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-list me-1"></i>{{ $list->items->count() }} items
                                </span>
                                <span class="essential-badge badge">
                                    <i class="fas fa-star me-1"></i>{{ $list->items->where('is_essential', true)->count() }} essential
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 p-4 pt-0">
                            <a href="{{ route('packing-list.show', $list->slug) }}" class="btn w-100 rounded-pill text-white fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                View List <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-suitcase fa-3x text-light mb-3"></i>
                    <h5 class="text-muted">No packing lists available yet</h5>
                    <p class="text-muted small">Check back soon for our comprehensive guides</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
        <div class="container py-4 text-center text-white">
            <h2 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Need Help Deciding?</h2>
            <p class="lead mb-4 opacity-75">Our travel experts can help you prepare for your specific adventure</p>
            <a href="{{ route('contact') }}" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                <i class="fas fa-phone me-2"></i>Contact Our Experts
            </a>
        </div>
    </section>

    @include('partials.footer')
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>
