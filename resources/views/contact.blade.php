<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - Go Deep Africa Safari</title>
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
    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/images/4GyurGeCrKkxo9FvCd8bnc-1000-80.jpg') }}');">
        <div class="container">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">Contact Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                    <li class="breadcrumb-item active text-white opacity-75" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Contact Info -->
                <div class="col-lg-5 animate__animated animate__fadeInLeft">
                    <h2 class="section-title text-start mb-4">Get in Touch</h2>
                    <p class="mb-5">Have questions about our safari packages or want a custom quote? We're here to help you plan your dream Tanzanian adventure.</p>
                    
                    <div class="contact-info-list">
                        <div class="d-flex gap-3 mb-4">
                            <div class="icon-box-small">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Our Location</h6>
                                <p class="text-muted mb-0">Arusha, Tanzania</p>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mb-4">
                            <div class="icon-box-small">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Call Us</h6>
                                <p class="text-muted mb-0">+255 794 636 471</p>
                                <p class="text-muted mb-0">+966 542 586 758</p>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mb-4">
                            <div class="icon-box-small">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Email Us</h6>
                                <p class="text-muted mb-0">info@godeepafricasafari.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <h6 class="fw-bold mb-3">Follow Us</h6>
                        <div class="d-flex gap-3">
                            <a href="#" class="social-circle-dark"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-circle-dark"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-circle-dark"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7 animate__animated animate__fadeInRight">
                    <div class="contact-card-enhanced p-4 p-md-5">
                        <h3 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Send us a Message</h3>
                        <form id="contactForm">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Your Name</label>
                                    <input type="text" class="form-control" placeholder="Enter your name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold small">Subject</label>
                                    <input type="text" class="form-control" placeholder="How can we help?">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold small">Message</label>
                                    <textarea class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-earth w-100 py-3 mt-2">SEND MESSAGE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <h2 class="section-title mb-5 animate__animated animate__fadeInUp">Travel FAQ</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8 animate__animated animate__fadeInUp">
                    <div class="accordion accordion-flush" id="contactFaq">
                        <div class="accordion-item animate__animated animate__fadeInUp">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    How do I book a safari or trekking tour?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#contactFaq">
                                <div class="accordion-body">
                                    Booking is simple! Start by sending us an inquiry through our contact form or directly via WhatsApp. One of our safari specialists will get back to you within 24 hours to discuss your preferences and help you create a tailored itinerary. Once you're happy with the plan, we'll guide you through the secure booking process.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item animate__animated animate__fadeInUp animate__delay-1s">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    What is your cancellation and refund policy?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#contactFaq">
                                <div class="accordion-body">
                                    We understand that plans can change. Our cancellation policy is designed to be as flexible as possible while respecting our commitments to local lodges and staff. Generally, cancellations made more than 60 days before departure receive a full refund minus a small administrative fee. Detailed terms are provided during the booking stage.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item animate__animated animate__fadeInUp animate__delay-2s">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Is it safe to travel to Tanzania?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#contactFaq">
                                <div class="accordion-body">
                                    Tanzania is one of Africa's most peaceful and stable countries. We prioritize your safety above all else. All our guides are highly trained in safety protocols, and we use well-maintained 4x4 vehicles. We also provide 24/7 support throughout your entire stay in Tanzania.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item animate__animated animate__fadeInUp animate__delay-3s">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Do you offer customized group packages?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#contactFaq">
                                <div class="accordion-body">
                                    Yes, we specialize in both private tailor-made adventures and small group safaris. Whether you're traveling as a couple, a family, or a large group of friends, we can design an itinerary that matches your specific interests and budget.
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
    @include('partials.general_inquiry_modal')
</body>
</html>
