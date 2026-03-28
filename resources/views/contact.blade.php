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
                    <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5">
                        <form id="contactForm">
                            <div class="row g-3">
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

    @include('partials.footer')
    @include('partials.whatsapp')
</body>
</html>
