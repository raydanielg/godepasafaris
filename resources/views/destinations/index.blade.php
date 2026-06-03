<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>African Safari Destinations - Go Deep Africa Safari</title>
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .destinations-hero {
            min-height: 70vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 100%),
                        url('https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .destination-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            overflow: hidden;
        }
        .destination-card:hover {
            transform: translateY(-15px) scale(1.02);
            border-color: #8B4513;
            box-shadow: 0 25px 50px rgba(139, 69, 19, 0.25);
        }
        .destination-card .dest-img-wrapper {
            overflow: hidden;
        }
        .destination-card .dest-img-wrapper img {
            transition: transform 0.6s ease;
        }
        .destination-card:hover .dest-img-wrapper img {
            transform: scale(1.1);
        }
        .country-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .category-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(255, 255, 255, 0.95);
            color: #8B4513;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            z-index: 2;
            text-transform: uppercase;
        }
        .filter-btn {
            border: 2px solid #8B4513;
            color: #8B4513;
            border-radius: 50px;
            padding: 10px 30px;
            transition: all 0.3s ease;
            background: white;
            font-weight: 600;
            text-decoration: none;
        }
        .filter-btn:hover, .filter-btn.active {
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            color: white !important;
            border-color: transparent;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
            transform: translateY(-2px);
        }
        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            background: rgba(139, 69, 19, 0.05);
            border-radius: 10px;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    @include('partials.header')

    <!-- Hero Section -->
    <section class="destinations-hero text-white d-flex align-items-center">
        <div class="container text-center" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-4 py-2 mb-3">
                <i class="fas fa-globe-africa me-2"></i>Explore Africa
            </span>
            <h1 class="display-3 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">
                African Safari Destinations
            </h1>
            <p class="lead mx-auto mb-4" style="max-width: 700px;">
                Discover the breathtaking beauty of Africa's diverse landscapes, from the Serengeti plains to Kilimanjaro's peaks
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-map-marker-alt me-2"></i>Tanzania
                </span>
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-map-marker-alt me-2"></i>Kenya
                </span>
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-map-marker-alt me-2"></i>Uganda
                </span>
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-map-marker-alt me-2"></i>Rwanda
                </span>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-4">
            <!-- Filters -->
            <div class="destination-filters mb-5 d-flex flex-wrap justify-content-center gap-2" data-aos="fade-up">
                <a href="{{ route('destinations') }}" 
                   class="filter-btn {{ !request('category') ? 'active' : '' }}">
                    <i class="fas fa-th-large me-2"></i>All Destinations
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('destinations', ['category' => $cat]) }}" 
                   class="filter-btn {{ request('category') == $cat ? 'active' : '' }}">
                    {{ $cat }}
                </a>
                @endforeach
            </div>

            <!-- Destinations Grid -->
            <div class="row g-4">
                @foreach($destinations as $dest)
                @php
                    // Only show African countries
                    $africanCountries = ['Tanzania', 'Kenya', 'Uganda', 'Rwanda', 'Burundi', 'Ethiopia', 'South Africa', 'Botswana', 'Namibia', 'Zambia', 'Zimbabwe', 'Mozambique', 'Malawi', 'Democratic Republic of Congo'];
                    $country = $dest->country ?? 'Tanzania';
                    if (!in_array($country, $africanCountries)) continue;
                @endphp
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="destination-card card h-100 border-0 shadow-sm rounded-4">
                        <a href="{{ route('destinations.show', $dest->slug) }}" class="text-decoration-none">
                            <div class="dest-img-wrapper position-relative" style="height: 280px;">
                                <img src="{{ asset($dest->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $dest->title }}">
                                <div class="country-badge">
                                    <i class="fas fa-flag"></i> {{ $country }}
                                </div>
                                <div class="category-badge">
                                    {{ $dest->category }}
                                </div>
                            </div>
                        </a>
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3" style="color: #3E2723; font-family: 'Playfair Display', serif;">
                                <a href="{{ route('destinations.show', $dest->slug) }}" class="text-dark text-decoration-none">
                                    {{ $dest->title }}
                                </a>
                            </h4>
                            <p class="text-muted small mb-4" style="line-height: 1.6;">{{ Str::limit($dest->description, 140) }}</p>
                            
                            <div class="mb-4">
                                <div class="info-item">
                                    <i class="fas fa-money-bill-wave" style="color: #8B4513;"></i>
                                    <span class="small"><strong>Rate:</strong> {{ $dest->rate_range }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="far fa-calendar-alt" style="color: #8B4513;"></i>
                                    <span class="small"><strong>Best time:</strong> {{ $dest->best_time }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-sun" style="color: #8B4513;"></i>
                                    <span class="small"><strong>High season:</strong> {{ $dest->high_season }}</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('destinations.show', $dest->slug) }}" class="btn w-100 rounded-pill py-2 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Explore {{ $dest->title }} <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- African Countries Section -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <h2 class="display-5 fw-bold mb-4 text-center" style="color: #3E2723; font-family: 'Playfair Display', serif;" data-aos="fade-up">
                African Countries We Cover
            </h2>
            <div class="row g-4">
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 rounded-4 shadow-sm p-4 text-center">
                        <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                            <i class="fas fa-flag text-white fa-lg"></i>
                        </div>
                        <h5 class="fw-bold mb-0" style="color: #3E2723;">Tanzania</h5>
                        <small class="text-muted">Serengeti, Kilimanjaro</small>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 rounded-4 shadow-sm p-4 text-center">
                        <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                            <i class="fas fa-flag text-white fa-lg"></i>
                        </div>
                        <h5 class="fw-bold mb-0" style="color: #3E2723;">Kenya</h5>
                        <small class="text-muted">Masai Mara, Amboseli</small>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card border-0 rounded-4 shadow-sm p-4 text-center">
                        <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                            <i class="fas fa-flag text-white fa-lg"></i>
                        </div>
                        <h5 class="fw-bold mb-0" style="color: #3E2723;">Uganda</h5>
                        <small class="text-muted">Gorillas, Wildlife</small>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="card border-0 rounded-4 shadow-sm p-4 text-center">
                        <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                            <i class="fas fa-flag text-white fa-lg"></i>
                        </div>
                        <h5 class="fw-bold mb-0" style="color: #3E2723;">Rwanda</h5>
                        <small class="text-muted">Volcanoes, Primates</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
        <div class="container py-4 text-center text-white">
            <h2 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Plan Your African Adventure</h2>
            <p class="lead mb-4 opacity-75">Let us help you create the perfect safari experience</p>
            <a href="{{ route('contact') }}" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                <i class="fas fa-envelope me-2"></i>Contact Us
            </a>
        </div>
    </section>

    @include('partials.footer')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>
</html>
