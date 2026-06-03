<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kilimanjaro Articles - Tips & Insights - Go Deep Africa Safari</title>
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .articles-hero {
            min-height: 60vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 100%),
                        url('https://images.unsplash.com/photo-1516422213484-21db3332906c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
        .article-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .article-card:hover {
            transform: translateY(-10px);
            border-color: #8B4513;
        }
    </style>
</head>
<body>
    @include('partials.header')

    <!-- Hero -->
    <section class="articles-hero text-white d-flex align-items-center">
        <div class="container text-center" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-4 py-2 mb-3">
                <i class="fas fa-book me-2"></i>Tips & Insights
            </span>
            <h1 class="display-3 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">
                Kilimanjaro Articles
            </h1>
            <p class="lead mx-auto mb-4" style="max-width: 700px;">
                Expert guides, training tips, and insider knowledge to help you prepare for your Kilimanjaro adventure.
            </p>
        </div>
    </section>

    <!-- Articles Grid -->
    <section class="py-5">
        <div class="container py-4">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="article-card card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-100" style="height: 200px; object-fit: cover;" alt="Training">
                        <div class="card-body p-4">
                            <span class="badge bg-light text-dark mb-2">Training</span>
                            <h5 class="fw-bold mb-2" style="color: #3E2723;">How to Prepare for Kilimanjaro</h5>
                            <p class="text-muted small mb-3">Essential training tips and preparation guide for your summit attempt.</p>
                            <a href="#" class="btn btn-sm rounded-pill" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="article-card card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1504173010664-32509aeebb62?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-100" style="height: 200px; object-fit: cover;" alt="Altitude">
                        <div class="card-body p-4">
                            <span class="badge bg-light text-dark mb-2">Health</span>
                            <h5 class="fw-bold mb-2" style="color: #3E2723;">Altitude Sickness Prevention</h5>
                            <p class="text-muted small mb-3">How to avoid and manage altitude sickness for a safe climb.</p>
                            <a href="#" class="btn btn-sm rounded-pill" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="article-card card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1533240332313-0db49b459ad6?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-100" style="height: 200px; object-fit: cover;" alt="Weather">
                        <div class="card-body p-4">
                            <span class="badge bg-light text-dark mb-2">Planning</span>
                            <h5 class="fw-bold mb-2" style="color: #3E2723;">Best Time to Climb Kilimanjaro</h5>
                            <p class="text-muted small mb-3">Seasonal guide for optimal climbing conditions and weather.</p>
                            <a href="#" class="btn btn-sm rounded-pill" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="article-card card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1516422213484-21db3332906c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-100" style="height: 200px; object-fit: cover;" alt="Summit">
                        <div class="card-body p-4">
                            <span class="badge bg-light text-dark mb-2">Summit Day</span>
                            <h5 class="fw-bold mb-2" style="color: #3E2723;">What to Expect on Summit Day</h5>
                            <p class="text-muted small mb-3">A detailed guide to the final ascent to Uhuru Peak.</p>
                            <a href="#" class="btn btn-sm rounded-pill" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="article-card card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-100" style="height: 200px; object-fit: cover;" alt="Packing">
                        <div class="card-body p-4">
                            <span class="badge bg-light text-dark mb-2">Gear</span>
                            <h5 class="fw-bold mb-2" style="color: #3E2723;">Packing Tips for Kilimanjaro</h5>
                            <p class="text-muted small mb-3">How to pack efficiently for your climb with essential gear.</p>
                            <a href="#" class="btn btn-sm rounded-pill" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="article-card card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1504173010664-32509aeebb62?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-100" style="height: 200px; object-fit: cover;" alt="Photography">
                        <div class="card-body p-4">
                            <span class="badge bg-light text-dark mb-2">Photography</span>
                            <h5 class="fw-bold mb-2" style="color: #3E2723;">Kilimanjaro Photography Guide</h5>
                            <p class="text-muted small mb-3">Capture your adventure with stunning photos and videos.</p>
                            <a href="#" class="btn btn-sm rounded-pill" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Article -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="card border-0 rounded-4 shadow-lg overflow-hidden" data-aos="fade-up">
                <div class="row g-0">
                    <div class="col-lg-6">
                        <img src="https://images.unsplash.com/photo-1533240332313-0db49b459ad6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100 h-100" style="object-fit: cover;" alt="Featured">
                    </div>
                    <div class="col-lg-6 p-5 d-flex flex-column justify-content-center">
                        <span class="badge bg-warning text-dark mb-3" style="width: fit-content;">Featured Article</span>
                        <h2 class="fw-bold mb-3" style="color: #3E2723; font-family: 'Playfair Display', serif;">52 Reasons to Choose Us for Kilimanjaro</h2>
                        <p class="text-muted mb-4">Discover why thousands of climbers trust Go Deep Africa Safari for their Kilimanjaro adventure. From our 98% success rate to our expert guides, learn what sets us apart.</p>
                        <a href="{{ route('kilimanjaro.why-us') }}" class="btn rounded-pill px-4" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white; width: fit-content;">
                            Read Full Article
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
        <div class="container py-4 text-center text-white">
            <h2 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Still Have Questions?</h2>
            <p class="lead mb-4 opacity-75">Our team is here to help you prepare for your adventure</p>
            <a href="{{ route('contact') }}" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                <i class="fas fa-comments me-2"></i>Contact Us
            </a>
        </div>
    </section>

    @include('partials.footer')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>
