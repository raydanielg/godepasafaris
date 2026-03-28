<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - Go Deep Africa Safari</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
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
    <section class="py-5">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 animate__animated animate__fadeInLeft">
                    <h2 class="section-title text-start mb-4">Our Story</h2>
                    <p class="lead">Go Deep Africa Safari was born out of a passion for the raw, untamed beauty of Tanzania.</p>
                    <p>Based in Arusha, the gateway to Africa's most iconic wildlife destinations, we are a locally owned tour operator dedicated to providing authentic and immersive safari experiences. Our team of expert guides has spent decades exploring the Serengeti, Ngorongoro, and the peaks of Kilimanjaro.</p>
                    <p>We don't just show you Africa; we help you "Go Deep" into its culture, its nature, and its spirit. Every itinerary we design is a reflection of our commitment to quality, safety, and responsible tourism.</p>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInRight">
                    <img src="{{ asset('images/images/4GyurGeCrKkxo9FvCd8bnc-1000-80.jpg') }}" alt="Our Story" class="img-fluid rounded-4 shadow-lg">
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

    @include('partials.footer')
    @include('partials.whatsapp')
</body>
</html>
