<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header')

    <!-- Page Header -->
    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/images/4-Kilimanjaro-Jane-at-summit-SC_JW.jpg') }}');">
        <div class="container">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">About Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                    <li class="breadcrumb-item active text-white opacity-75" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-5 overflow-hidden">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 animate__animated animate__fadeInLeft">
                    <h6 class="text-earth fw-bold text-uppercase mb-2" style="letter-spacing: 2px;">Our Chimbuko</h6>
                    <h2 class="display-5 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">A Journey Born from Passion</h2>
                    <p class="lead text-dark fw-bold mb-4">Go Deep Africa Safari was born out of a passion for the raw, untamed beauty of Tanzania.</p>
                    <p class="mb-4">Based in Arusha, the gateway to Africa's most iconic wildlife destinations, we are a locally owned tour operator dedicated to providing authentic and immersive safari experiences. Our founders, born and raised in the shadow of Mount Kilimanjaro, envisioned a company that doesn't just "show" Africa, but allows travelers to "Go Deep" into its soul.</p>
                    <p class="mb-4">Our team of expert guides has spent decades exploring the Serengeti, Ngorongoro, and the peaks of Kilimanjaro. We understand that a safari is more than just a holiday—it's a transformative experience that stays with you forever.</p>
                    <div class="row g-4 mt-2">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-check-circle text-earth"></i>
                                <span class="fw-bold">100% Local Guides</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-check-circle text-earth"></i>
                                <span class="fw-bold">Tailor-made Tours</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInRight position-relative">
                    <div class="image-stack">
                        <img src="{{ asset('images/images/4GyurGeCrKkxo9FvCd8bnc-1000-80.jpg') }}" alt="Safari Experience" class="img-fluid rounded-4 shadow-lg main-img">
                        <img src="{{ asset('images/images/3-Days-Serengeti-Balloon-Safaris.webp') }}" alt="Balloon Safari" class="img-fluid rounded-4 shadow-lg sub-img d-none d-md-block">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-5 bg-dark text-white">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 animate__animated animate__fadeInUp">
                    <div class="p-5 rounded-4" style="background: rgba(255,255,255,0.05); border-left: 5px solid #8b4513;">
                        <i class="fas fa-bullseye fa-3x mb-4 text-earth"></i>
                        <h3 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Our Mission</h3>
                        <p class="opacity-75">To provide extraordinary, personalized safari and trekking experiences that connect our guests with the heart of Tanzania while promoting sustainable tourism and supporting local communities.</p>
                    </div>
                </div>
                <div class="col-md-6 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="p-5 rounded-4" style="background: rgba(255,255,255,0.05); border-left: 5px solid #deb887;">
                        <i class="fas fa-eye fa-3x mb-4 text-earth"></i>
                        <h3 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Our Vision</h3>
                        <p class="opacity-75">To be the most trusted and respected safari operator in East Africa, known for our local expertise, exceptional service, and commitment to preserving the wild spirit of Africa.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row align-items-center g-5 flex-row-reverse">
                <div class="col-lg-6 animate__animated animate__fadeInRight">
                    <h2 class="display-5 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Expertise in Every Expedition</h2>
                    <p class="mb-4">From the technical challenges of the Machame Route on Kilimanjaro to the patient stalking of a leopard in the Serengeti, our expertise covers every aspect of Tanzanian travel.</p>
                    <div class="experience-list">
                        <div class="d-flex gap-3 mb-4">
                            <div class="icon-circle bg-light shadow-sm">
                                <i class="fas fa-mountain text-earth"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">High-Altitude Trekking</h5>
                                <p class="text-muted">Our mountain guides are certified and highly trained in altitude safety and first aid.</p>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mb-4">
                            <div class="icon-circle bg-light shadow-sm">
                                <i class="fas fa-binoculars text-earth"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Wildlife Specialists</h5>
                                <p class="text-muted">Expert spotters who understand animal behavior and the intricacies of the ecosystem.</p>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="icon-circle bg-light shadow-sm">
                                <i class="fas fa-umbrella-beach text-earth"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Coastal Escapes</h5>
                                <p class="text-muted">Seamless logistics for Zanzibar beach holidays and cultural tours in Stone Town.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInLeft">
                    <img src="{{ asset('images/images/Elephants Maryam Laura Moazedi.jpg') }}" alt="Expertise" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Core Values</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">These are the principles that guide everything we do at Go Deep Africa Safari.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3 animate__animated animate__fadeInUp">
                    <div class="value-card p-4 text-center h-100">
                        <div class="value-icon mb-3">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                        <h5 class="fw-bold">Integrity</h5>
                        <p class="small text-muted">Honesty and transparency in every booking and every interaction.</p>
                    </div>
                </div>
                <div class="col-md-3 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="value-card p-4 text-center h-100">
                        <div class="value-icon mb-3">
                            <i class="fas fa-hand-holding-heart fa-2x"></i>
                        </div>
                        <h5 class="fw-bold">Passion</h5>
                        <p class="small text-muted">A deep-rooted love for our heritage and the nature we protect.</p>
                    </div>
                </div>
                <div class="col-md-3 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="value-card p-4 text-center h-100">
                        <div class="value-icon mb-3">
                            <i class="fas fa-award fa-2x"></i>
                        </div>
                        <h5 class="fw-bold">Quality</h5>
                        <p class="small text-muted">Excellence in service, from transportation to luxury accommodation.</p>
                    </div>
                </div>
                <div class="col-md-3 animate__animated animate__fadeInUp animate__delay-3s">
                    <div class="value-card p-4 text-center h-100">
                        <div class="value-icon mb-3">
                            <i class="fas fa-globe-africa fa-2x"></i>
                        </div>
                        <h5 class="fw-bold">Sustainability</h5>
                        <p class="small text-muted">Preserving Tanzania for future generations of adventurers.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Us -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <h2 class="section-title mb-5 animate__animated animate__fadeInUp">Why Choose Us</h2>
            <div class="row g-4">
                <div class="col-md-4 animate__animated animate__fadeInUp">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="icon-box-large mb-4 mx-auto">
                            <i class="fas fa-leaf fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Eco-Friendly</h4>
                        <p class="text-muted">We prioritize sustainable travel practices that protect Tanzania's natural environment and wildlife.</p>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="icon-box-large mb-4 mx-auto">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Local Expertise</h4>
                        <p class="text-muted">Our guides are Arusha locals with deep knowledge of the land, its animals, and its people.</p>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="icon-box-large mb-4 mx-auto">
                            <i class="fas fa-heart fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Personalized</h4>
                        <p class="text-muted">Every safari is tailored to your specific interests, budget, and pace for a truly unique adventure.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5">
        <div class="container py-5">
            <h2 class="section-title mb-5 animate__animated animate__fadeInUp">Frequently Asked Questions</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8 animate__animated animate__fadeInUp">
                    <div class="accordion accordion-flush shadow-sm rounded-4 overflow-hidden" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    What is the best time to visit Tanzania?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    The best time for wildlife viewing is during the dry season from late June to October. For the Great Migration, July to September is peak. Kilimanjaro can be climbed year-round, but January-March and June-October offer the best weather.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Do I need a visa for Tanzania?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Most visitors require a visa. You can obtain an e-visa online before your trip or a visa on arrival at major airports like Kilimanjaro International (JRO) or Dar es Salaam (DAR).
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    What should I pack for a safari?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Light, neutral-colored clothing, a warm jacket for early morning drives, comfortable walking shoes, sunscreen, binoculars, and a camera. Don't forget your personal medications and insect repellent.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .text-earth { color: #8b4513 !important; }
        .bg-earth { background-color: #8b4513 !important; }
        .icon-circle { width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
        .value-icon { color: #8b4513; }
        .icon-box-large { width: 80px; height: 80px; background: #fdf5e6; color: #8b4513; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .accordion-button:not(.collapsed) { background-color: #fdf5e6; color: #8b4513; }
        .accordion-button:focus { border-color: #8b4513; box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.1); }
    </style>
    @include('partials.footer')
    @include('partials.ai_chatbot')
    @include('partials.general_inquiry_modal')
</body>
</html>
