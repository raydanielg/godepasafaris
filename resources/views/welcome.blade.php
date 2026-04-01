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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Global Mobile Optimizations */
        @media (max-width: 768px) {
            .main-header {
                position: absolute;
                top: 0;
                width: 100%;
                z-index: 1000;
            }
            .top-header {
                display: none !important; /* Hide black top bar on mobile */
            }
            .bottom-header {
                margin: 10px !important;
                background-color: rgba(255, 255, 255, 0.9) !important;
                backdrop-filter: blur(10px);
            }
            .section-title {
                font-size: 1.8rem !important;
                margin: 40px 0 25px !important;
            }
            .container {
                padding-left: 20px !important;
                padding-right: 20px !important;
            }
            p.lead {
                font-size: 1rem !important;
            }
        }

        /* Flatpickr Custom Styling */
        .flatpickr-calendar {
            border-radius: 15px !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
            border: none !important;
            background: #fff !important;
        }
        .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange {
            background: #8b4513 !important;
            border-color: #8b4513 !important;
        }
        .flatpickr-months .flatpickr-month, .flatpickr-current-month .flatpickr-monthDropdown-months, .flatpickr-current-month input.cur-year {
            color: #3E2723 !important;
            fill: #3E2723 !important;
        }
        .flatpickr-weekday {
            background: transparent !important;
            color: #3E2723 !important;
            font-weight: bold !important;
        }

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
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1516422213484-21db3332906c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 20px 15px;
            position: relative;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 150px;
            background: linear-gradient(to top, var(--beige-bg), transparent);
            pointer-events: none;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 4px 10px rgba(0,0,0,0.5);
        }

        .hero p {
            font-size: 1.25rem;
            max-width: 800px;
            margin-bottom: 30px;
            font-weight: 600;
            color: #fff;
            text-shadow: 1px 2px 5px rgba(0,0,0,0.5);
        }

        .nav-top {
            position: absolute;
            top: 0;
            width: 100%;
            padding: 20px 30px;
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
            padding: 0 30px 60px;
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

        .destination-card-home {
            height: 400px;
            transition: all 0.5s ease;
            cursor: pointer;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        }

        .destination-card-home:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(139, 69, 19, 0.2) !important;
        }

        .destination-card-home img {
            transition: all 0.5s ease;
        }

        .destination-card-home:hover img {
            transform: scale(1.1);
        }

        .dest-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 60%, transparent 100%);
            transition: all 0.4s ease;
            height: 60%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .destination-card-home:hover .dest-overlay {
            height: 100%;
            background: linear-gradient(to top, rgba(139, 69, 19, 0.9) 0%, rgba(0,0,0,0.4) 100%);
        }

        .dest-overlay p {
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s ease;
            margin-bottom: 0 !important;
        }

        .destination-card-home:hover .dest-overlay p {
            max-height: 100px;
            margin-bottom: 1rem !important;
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
            padding: 40px 30px;
            text-align: center;
        }

        .footer-logo {
            height: 50px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .hero {
                height: 80vh;
                background-attachment: scroll;
                padding-top: 60px;
            }
            .hero h1 {
                font-size: 2rem !important;
                letter-spacing: 1px;
            }
            .hero p {
                font-size: 1rem !important;
                margin-bottom: 20px;
            }
            .nav-top {
                padding: 15px 20px;
            }
            .logo-img {
                height: 45px;
            }
        }

        @media (max-width: 576px) {
            .hero { padding: 15px 10px; }
            .services-grid { 
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 0 15px 30px; 
            }
            .section-title { margin: 35px 0 25px; font-size: 1.75rem !important; }
            .cta-btn {
                width: 100%;
                text-align: center;
                padding: 12px 25px;
            }
        }
    </style>
</head>
<body>
    @include('partials.header')
    @include('partials.hero')
    @include('partials.discover')
    @include('partials.packages')
    
    <!-- Giving Back / Impact Section -->
    <section class="giving-back-section py-5 position-relative overflow-hidden" style="background: linear-gradient(rgba(62, 39, 35, 0.95), rgba(62, 39, 35, 0.95)), url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-white animate__animated animate__fadeInLeft">
                    <h6 class="text-uppercase fw-bold mb-3" style="color: #DEB887; letter-spacing: 3px;">Safari with a Purpose</h6>
                    <h2 class="display-4 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Your Journey Changes Lives</h2>
                    <p class="lead mb-4 opacity-75">At Go Deep Africa Safari, a portion of every booking goes directly to supporting orphans, vulnerable children, and marginalized women in Tanzania. When you travel with us, you are giving back to the heart of Africa.</p>
                    <div class="d-flex flex-wrap gap-4 mb-5">
                        <div class="impact-mini-card">
                            <i class="fas fa-heart mb-2 d-block" style="color: #DEB887; font-size: 1.5rem;"></i>
                            <span class="fw-bold">Supporting Orphans</span>
                        </div>
                        <div class="impact-mini-card">
                            <i class="fas fa-female mb-2 d-block" style="color: #DEB887; font-size: 1.5rem;"></i>
                            <span class="fw-bold">Empowering Women</span>
                        </div>
                    </div>
                    <a href="{{ Route::has('impact') ? route('impact') : url('/impact') }}" class="btn btn-lg px-5 py-3 rounded-pill fw-bold text-white shadow-lg pulse-animation d-inline-block border-0" style="background-color: #8B4513 !important;">
                        SEE OUR IMPACT <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInRight">
                    <div class="row g-3">
                        <div class="col-6">
                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=400&q=80" class="img-fluid rounded-4 shadow-lg mb-3" alt="Supporting orphans and children in Tanzania - Go Deep Africa Safari">
                            <img src="https://images.unsplash.com/photo-1509059852496-f3822ae057bf?auto=format&fit=crop&w=400&q=80" class="img-fluid rounded-4 shadow-lg" alt="Community impact and wildlife conservation in Tanzania">
                        </div>
                        <div class="col-6 pt-lg-5">
                            <img src="https://images.unsplash.com/photo-1526622055182-4c07e3c9c47a?auto=format&fit=crop&w=400&q=80" class="img-fluid rounded-4 shadow-lg mb-3" alt="Empowering local women through sustainable tourism">
                            <img src="https://images.unsplash.com/photo-1489914169085-9b54fdd8f2a2?auto=format&fit=crop&w=400&q=80" class="img-fluid rounded-4 shadow-lg" alt="Educational support for marginalized youth in Tanzania">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.styles')
    @include('partials.testimonials')
    @include('partials.blog')
    
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

                    <div class="mt-5 text-center">
                        <button class="btn btn-lg px-5 py-3 rounded-pill fw-bold text-white shadow-lg pulse-animation d-inline-block border-0" style="background-color: #8B4513 !important; font-size: 1.1rem; letter-spacing: 1px; white-space: nowrap; min-width: auto;" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
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
    <!-- Auto Cache Clear Script -->
    <script>
        setInterval(function() {
            const cacheClearUrl = @json(Route::has('cache.clear.ajax') ? route('cache.clear.ajax') : url('/clear-cache'));
            fetch(cacheClearUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .catch(error => {
                // Background error handling without console noise
            });
        }, 60000); // 60 seconds
    </script>
</body>
</html>
