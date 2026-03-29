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

    <style>
        :root {
            --primary-earth: #8B4513;
            --secondary-earth: #A0522D;
            --accent-green: #556B2F;
            --light-earth: #DEB887;
            --dark-earth: #3E2723;
            --beige-bg: #F5F5DC;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--beige-bg);
            color: var(--dark-earth);
            margin: 0;
            overflow-x: hidden;
        }

        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1516422213484-21db3332906c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 20px;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .hero p {
            font-size: 1.5rem;
            max-width: 800px;
            margin-bottom: 30px;
            font-weight: 600;
            color: var(--light-earth);
        }

        .nav-top {
            position: absolute;
            top: 0;
            width: 100%;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
        }

        .logo-img {
            height: 60px;
            width: auto;
        }

        .auth-nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 700;
            padding: 8px 20px;
            border-radius: 25px;
            transition: all 0.3s;
        }

        .btn-login {
            border: 2px solid white;
        }

        .btn-login:hover {
            background: white;
            color: var(--primary-earth);
        }

        .btn-register {
            background: var(--primary-earth);
            border: 2px solid var(--primary-earth);
        }

        .btn-register:hover {
            background: var(--dark-earth);
            border-color: var(--dark-earth);
        }

        .section-title {
            text-align: center;
            margin: 60px 0 40px;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-earth);
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--primary-earth);
            margin: 10px auto;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 0 50px 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .service-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }

        .service-card:hover {
            transform: translateY(-10px);
        }

        .service-image {
            height: 200px;
            background-size: cover;
            background-position: center;
        }

        .service-content {
            padding: 25px;
        }

        .service-content h3 {
            margin-top: 0;
            color: var(--primary-earth);
            font-weight: 800;
        }

        .service-content p {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #555;
        }

        .cta-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 15px 40px;
            background: var(--primary-earth);
            color: white;
            text-decoration: none;
            font-weight: 800;
            border-radius: 30px;
            text-transform: uppercase;
            transition: all 0.3s;
        }

        .cta-btn:hover {
            background: var(--dark-earth);
            transform: scale(1.05);
        }

        footer {
            background: var(--dark-earth);
            color: var(--beige-bg);
            padding: 40px 50px;
            text-align: center;
        }

        .footer-logo {
            height: 50px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .hero p { font-size: 1.1rem; }
            .nav-top { padding: 20px; }
            .logo-img { height: 40px; }
        }
    </style>
</head>
<body>
    @include('partials.header')
    @include('partials.hero')
    @include('partials.discover')
    @include('partials.packages')
    @include('partials.styles')
    @include('partials.testimonials')
    @include('partials.blog')
    
    <!-- Destinations Grid Preview -->
    <section class="destinations-preview py-5" style="background-color: #fdfaf5;">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-uppercase fw-bold mb-3" style="color: #DEB887; letter-spacing: 3px;">Explore Tanzania</h6>
                <h2 class="display-5 fw-bold" style="font-family: 'Playfair Display', serif; color: #3E2723;">Iconic Destinations</h2>
                <div class="mx-auto mt-2 mb-3" style="width: 80px; height: 4px; background: #8B4513;"></div>
            </div>
            
            <div class="row g-4">
                @foreach($destinations ?? [] as $dest)
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp">
                    <div class="destination-card-home rounded-4 overflow-hidden shadow-sm position-relative">
                        <img src="{{ asset($dest->image) }}" class="w-100 object-fit-cover" height="350" alt="{{ $dest->title }}">
                        <div class="dest-overlay position-absolute bottom-0 start-0 w-100 p-4 text-white">
                            <h4 class="fw-bold mb-1" style="font-family: 'Playfair Display', serif;">{{ $dest->title }}</h4>
                            <p class="small mb-3 opacity-75">{{ Str::limit($dest->description, 60) }}</p>
                            <a href="{{ route('destinations.show', $dest->slug) }}" class="btn btn-sm btn-outline-light rounded-pill px-4">EXPLORE</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('destinations') }}" class="btn btn-earth rounded-pill px-5 py-3 fw-bold shadow-sm">VIEW ALL DESTINATIONS</a>
            </div>
        </div>
    </section>

    <!-- Professional Quote/CTA Section -->
    <section class="quote-section py-5 position-relative overflow-hidden" style="background: linear-gradient(rgba(62, 39, 35, 0.9), rgba(62, 39, 35, 0.9)), url('https://images.unsplash.com/photo-1516422213484-21db3332906c?auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center text-white">
                    <h6 class="text-uppercase fw-bold mb-3" style="color: #DEB887; letter-spacing: 3px;">Ready for your next big adventure?</h6>
                    <h2 class="display-4 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Get a Personalized Safari Quote Today</h2>
                    <p class="lead mb-5 opacity-75 mx-auto" style="max-width: 700px;">Tell us your dreams, and our Tanzania-based experts will craft a custom itinerary that fits your budget and interests perfectly.</p>
                    
                    <div class="d-flex flex-wrap justify-content-center gap-4 animate__animated animate__fadeInUp">
                        <div class="quote-feature-item">
                            <div class="icon-circle mb-3 mx-auto" style="background: rgba(222, 184, 135, 0.2); color: #DEB887; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h6 class="fw-bold mb-0">3-Hour Response</h6>
                        </div>
                        <div class="quote-feature-item">
                            <div class="icon-circle mb-3 mx-auto" style="background: rgba(222, 184, 135, 0.2); color: #DEB887; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <h6 class="fw-bold mb-0">Custom Routes</h6>
                        </div>
                        <div class="quote-feature-item">
                            <div class="icon-circle mb-3 mx-auto" style="background: rgba(222, 184, 135, 0.2); color: #DEB887; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h6 class="fw-bold mb-0">Best Price Guarantee</h6>
                        </div>
                    </div>

                    <div class="mt-5">
                        <button class="btn btn-earth btn-lg px-5 py-3 rounded-pill fw-bold text-white shadow-lg pulse-animation" data-bs-toggle="modal" data-bs-target="#generalInquiryModal" style="background-color: #8b4513 !important; border: none !important; color: #ffffff !important;">
                            REQUEST A FREE QUOTE <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.prefooter_cta')
    @include('partials.footer')
    @include('partials.ai_chatbot')
    @include('partials.booking_modal')
    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("input[type=date]", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                minDate: "today",
                animate: true
            });
        });
    </script>
</body>
</html>
