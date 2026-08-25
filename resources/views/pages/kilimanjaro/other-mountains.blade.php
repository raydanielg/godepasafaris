<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', [
        'seoTitle' => 'Mount Meru, Ol Doinyo Lengai & Usambara Treks',
        'seoDescription' => 'Beyond Kilimanjaro: trek Mount Meru, the Ol Doinyo Lengai volcano and the Usambara Mountains. Compare altitude, duration and difficulty with local guides.',
        'seoKeywords' => 'Mount Meru trek, Ol Doinyo Lengai climb, Usambara Mountains hiking, Tanzania mountains',
    ])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .mountains-hero {
            min-height: 60vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 100%),
                        url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
        .mountain-card {
            transition: all 0.3s ease;
        }
        .mountain-card:hover {
            transform: translateY(-10px);
        }
    </style>
</head>
<body>
    @include('partials.header')

    <section class="mountains-hero text-white d-flex align-items-center" data-aos="fade-up">
        <div class="container text-center">
            <span class="badge bg-warning text-dark px-4 py-2 mb-3">
                <i class="fas fa-mountain me-2"></i>Beyond Kilimanjaro
            </span>
            <h1 class="display-3 fw-bold mb-4" style="font-family: 'Nunito', sans-serif;">
                Other Mountains in Tanzania
            </h1>
            <p class="lead mx-auto" style="max-width: 700px;">
                Explore Tanzania's other spectacular peaks and volcanic mountains
            </p>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-4">
            <div class="row g-4">
                <!-- Mount Meru -->
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="mountain-card card h-100 border-0 rounded-4 shadow-lg overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1589553416260-f586c8f1514f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" style="height: 300px; object-fit: cover;" alt="Mount Meru">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3 class="fw-bold mb-1" style="color: #3E2723;">Mount Meru</h3>
                                    <span class="badge bg-secondary">4,566m / 14,980ft</span>
                                </div>
                                <span class="badge bg-success">3-4 Days</span>
                            </div>
                            <p class="text-muted mb-3">
                                Tanzania's second-highest peak and the fifth-highest in Africa. Located in Arusha National Park, this spectacular volcanic cone offers incredible wildlife viewing on the way up.
                            </p>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Perfect warm-up for Kilimanjaro</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>See buffalo, giraffes, and colobus monkeys</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Stunning views of Kili from the summit</li>
                                <li><i class="fas fa-check text-success me-2"></i>Less crowded, more intimate experience</li>
                            </ul>
                            <h5 class="fw-bold mb-3" style="color: #8B4513;">Starting from $850/person</h5>
                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-3 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Enquire About Meru
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Ol Doinyo Lengai -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="mountain-card card h-100 border-0 rounded-4 shadow-lg overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" style="height: 300px; object-fit: cover;" alt="Ol Doinyo Lengai">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3 class="fw-bold mb-1" style="color: #3E2723;">Ol Doinyo Lengai</h3>
                                    <span class="badge bg-danger">Active Volcano</span>
                                </div>
                                <span class="badge bg-success">1-2 Days</span>
                            </div>
                            <p class="text-muted mb-3">
                                Known as the "Mountain of God" in Maasai language, this active volcano near Lake Natron offers a challenging night climb to see the sunrise from the crater rim.
                            </p>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Active volcanic crater</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Sacred Maasai mountain</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Combine with Lake Natron visit</li>
                                <li><i class="fas fa-check text-success me-2"></i>Unique cultural experience</li>
                            </ul>
                            <h5 class="fw-bold mb-3" style="color: #8B4513;">Starting from $400/person</h5>
                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-3 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Enquire About Lengai
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Usambara Mountains -->
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="mountain-card card h-100 border-0 rounded-4 shadow-lg overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" style="height: 300px; object-fit: cover;" alt="Usambara Mountains">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3 class="fw-bold mb-1" style="color: #3E2723;">Usambara Mountains</h3>
                                    <span class="badge bg-info">Hiking Paradise</span>
                                </div>
                                <span class="badge bg-success">1-5 Days</span>
                            </div>
                            <p class="text-muted mb-3">
                                A hiker's paradise in eastern Tanzania, featuring lush forests, dramatic viewpoints, and authentic village experiences in this ancient mountain range.
                            </p>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Over 100km of hiking trails</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Biodiversity hotspot</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Traditional villages & culture</li>
                                <li><i class="fas fa-check text-success me-2"></i>Panoramic viewpoints</li>
                            </ul>
                            <h5 class="fw-bold mb-3" style="color: #8B4513;">Starting from $300/person</h5>
                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-3 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Enquire About Usambara
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Oldeani Mountain -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="mountain-card card h-100 border-0 rounded-4 shadow-lg overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" style="height: 300px; object-fit: cover;" alt="Oldeani Mountain">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3 class="fw-bold mb-1" style="color: #3E2723;">Oldeani Mountain</h3>
                                    <span class="badge bg-secondary">3,188m / 10,459ft</span>
                                </div>
                                <span class="badge bg-success">1 Day</span>
                            </div>
                            <p class="text-muted mb-3">
                                A lesser-known gem near Ngorongoro Crater. This day hike offers incredible views over the highlands and is perfect as an add-on to your safari adventure.
                            </p>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Perfect safari add-on</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Views over Ngorongoro</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Bird watching paradise</li>
                                <li><i class="fas fa-check text-success me-2"></i>Easy day trip</li>
                            </ul>
                            <h5 class="fw-bold mb-3" style="color: #8B4513;">Starting from $150/person</h5>
                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-3 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Enquire About Oldeani
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
        <div class="container py-4 text-center text-white">
            <h2 class="fw-bold mb-3" style="font-family: 'Nunito', sans-serif;">Which Mountain Calls to You?</h2>
            <p class="lead mb-4 opacity-75">Contact us to plan your Tanzanian mountain adventure</p>
            <a href="{{ route('contact') }}" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                <i class="fas fa-envelope me-2"></i>Plan Your Climb
            </a>
        </div>
    </section>

    @include('partials.footer')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>
