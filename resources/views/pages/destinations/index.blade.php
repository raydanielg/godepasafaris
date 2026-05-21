<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Safari Destinations - Go Deep Africa Safari</title>
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .destinations-hero {
            min-height: 70vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.85) 0%, rgba(139,69,19,0.8) 50%, rgba(62,39,35,0.85) 100%),
                        url('https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .destination-card {
            transition: all 0.4s ease;
            overflow: hidden;
        }
        .destination-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(139, 69, 19, 0.2);
        }
        .destination-card:hover .card-img {
            transform: scale(1.1);
        }
        .card-img {
            transition: transform 0.5s ease;
        }
        .featured-card {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
        }
        .featured-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 70%;
            background: linear-gradient(to top, rgba(62,39,35,0.95) 0%, transparent 100%);
        }
    </style>
</head>
<body>
    @include('partials.header')

    <!-- Hero Section -->
    <section class="destinations-hero text-white d-flex align-items-center">
        <div class="container text-center" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-4 py-2 mb-3 animate__animated animate__fadeInDown">
                <i class="fas fa-map-marked-alt me-2"></i>Explore Tanzania
            </span>
            <h1 class="display-2 fw-bold mb-4 animate__animated animate__fadeInUp" style="font-family: 'Playfair Display', serif;">
                Safari Destinations
            </h1>
            <p class="lead mx-auto mb-4 animate__animated animate__fadeInUp" style="max-width: 800px; text-shadow: 1px 2px 10px rgba(0,0,0,0.5);">
                Discover Tanzania's most spectacular national parks and game reserves. From the endless plains of the Serengeti to the wildlife-filled Ngorongoro Crater.
            </p>
        </div>
    </section>

    <!-- Featured Destination -->
    @if($featured)
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="row g-0 featured-card shadow-lg" data-aos="fade-up">
                <div class="col-lg-7">
                    <img src="{{ $featured->display_image }}" 
                         class="w-100 h-100 object-fit-cover" style="min-height: 450px;" alt="{{ $featured->name }}">
                </div>
                <div class="col-lg-5 d-flex align-items-center">
                    <div class="p-5 w-100" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
                        <span class="badge bg-warning text-dark mb-3">
                            <i class="fas fa-star me-1"></i>Featured Destination
                        </span>
                        <h2 class="display-5 fw-bold text-white mb-3" style="font-family: 'Playfair Display', serif;">
                            {{ $featured->name }}
                        </h2>
                        <p class="text-white-75 lead mb-4">{{ $featured->tagline }}</p>
                        <p class="text-white-50 mb-4">{{ Str::limit($featured->description, 200) }}</p>
                        
                        <div class="d-flex gap-3 mb-4">
                            <div class="text-center">
                                <h5 class="fw-bold text-white mb-0">{{ $featured->area }}</h5>
                                <small class="text-white-50">Area</small>
                            </div>
                            <div class="text-center border-start border-white-25 ps-3">
                                <h5 class="fw-bold text-white mb-0">{{ $featured->established }}</h5>
                                <small class="text-white-50">Established</small>
                            </div>
                            <div class="text-center border-start border-white-25 ps-3">
                                <h5 class="fw-bold text-white mb-0">{{ $featured->activities->count() }}+</h5>
                                <small class="text-white-50">Activities</small>
                            </div>
                        </div>

                        <a href="{{ route('destinations.show', $featured->slug) }}" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                            Explore {{ $featured->name }} <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- All Destinations Grid -->
    <section class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3" style="color: #3E2723; font-family: 'Playfair Display', serif;">
                    All Safari Destinations
                </h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">
                    From iconic national parks to hidden gems, explore Tanzania's diverse wilderness
                </p>
            </div>

            <div class="row g-4">
                @foreach($destinations as $destination)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="destination-card card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                        <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img src="{{ $destination->display_image }}" 
                                 class="card-img w-100 h-100 object-fit-cover" alt="{{ $destination->name }}">
                            @if($destination->badge)
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge" style="background: {{ $destination->badge_color == 'danger' ? '#dc3545' : ($destination->badge_color == 'warning' ? '#ffc107' : '#6c757d') }}; color: {{ $destination->badge_color == 'warning' ? '#000' : '#fff' }};">
                                    {{ $destination->badge }}
                                </span>
                            </div>
                            @endif
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                    <i class="fas {{ $destination->icon }} text-white"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1" style="color: #3E2723;">{{ $destination->name }}</h5>
                                    <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>{{ $destination->location }}</small>
                                </div>
                            </div>
                            
                            <p class="text-muted small mb-3">{{ $destination->tagline }}</p>
                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @foreach($destination->activities->take(3) as $activity)
                                <span class="badge bg-light text-dark">
                                    <i class="fas {{ $activity->icon }} me-1 text-muted"></i>{{ $activity->name }}
                                </span>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <div>
                                    <small class="text-muted d-block">Best time:</small>
                                    <small class="fw-bold" style="color: #8B4513;">{{ $destination->best_time }}</small>
                                </div>
                                <a href="{{ route('destinations.show', $destination->slug) }}" class="btn rounded-pill px-4" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                    Explore <i class="fas fa-arrow-right ms-1 small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
        <div class="container py-4 text-center text-white">
            <h2 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Can't Decide Where to Go?</h2>
            <p class="lead mb-4 opacity-75">Let our experts help you plan the perfect Tanzania safari</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('tours.all') }}" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                    <i class="fas fa-compass me-2"></i>View All Tours
                </a>
                <a href="{{ route('contact') }}" class="btn btn-lg btn-outline-light rounded-pill px-5 fw-bold">
                    <i class="fas fa-phone me-2"></i>Get Expert Advice
                </a>
            </div>
        </div>
    </section>

    @include('partials.footer')
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>
