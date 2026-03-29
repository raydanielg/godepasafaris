<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $route['title'] }} - Go Deep Africa Safari</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .bg-earth { background-color: #8b4513 !important; }
        .text-earth { color: #8b4513 !important; }
        .btn-earth { background-color: #8b4513 !important; border-color: #8b4513 !important; color: white !important; }
        .btn-earth:hover { background-color: #a0522d !important; border-color: #a0522d !important; }
        .sticky-sidebar { position: sticky; top: 100px; }
        .nav-quick { background: #fff; border-radius: 1rem; padding: 1.5rem; }
        .nav-quick a { display: block; padding: 0.5rem 0; color: #666; text-decoration: none; transition: 0.3s; font-size: 0.9rem; border-bottom: 1px solid #eee; }
        .nav-quick a:last-child { border-bottom: none; }
        .nav-quick a:hover { color: #8b4513; padding-left: 5px; }
        .section-card { background: #fff; border-radius: 1.5rem; padding: 2.5rem; margin-bottom: 2rem; box-shadow: 0 5px 20px rgba(0,0,0,0.03); }
        .success-box { background: #fdf5e6; border-left: 5px solid #8b4513; padding: 1.5rem; border-radius: 0.5rem; }

        /* Overlapping Map Styles */
        .route-explorer-container {
            position: relative;
            background: #f8f9fa;
            border-radius: 1.5rem;
            overflow: hidden;
            width: 100%;
            min-height: 400px;
        }
        .base-map {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            object-fit: contain;
            opacity: 0.4;
            z-index: 1;
        }
        .route-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            object-fit: contain;
            z-index: 2;
        }
    </style>
</head>
<body class="bg-light">
    @include('partials.header')

    <section class="page-header py-5 bg-dark text-white text-center" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/images/4-Kilimanjaro-Jane-at-summit-SC_JW.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container py-5">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">{{ $route['name'] }}</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Everything you need to know about the Whiskey Route</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-sidebar">
                    <div class="section-card p-4 text-center mb-4">
                        <small class="text-muted d-block text-uppercase fw-bold">Price From</small>
                        <h2 class="display-5 fw-bold text-earth mb-3">${{ number_format($route['price']) }}</h2>
                        <a href="https://wa.me/+255794636471" class="btn btn-earth w-100 rounded-pill mb-2"><i class="fab fa-whatsapp me-2"></i> WhatsApp Us</a>
                        <button class="btn btn-outline-dark w-100 py-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#bookingModal">Book This Route</button>
                    </div>

                    <div class="nav-quick shadow-sm mb-4">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">Quick Navigate</h5>
                        <a href="#overview">Overview of the Machame route</a>
                        <a href="#expert">Expert recommendation</a>
                        <a href="#map">Machame route on the map</a>
                        <a href="#success">Summit Success Rate</a>
                        <a href="#itinerary">Detailed Itinerary</a>
                        <a href="#faq">Machame Route FAQ</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-8">
                <div id="overview" class="section-card">
                    <h3 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Overview of the {{ $route['name'] }}</h3>
                    <p class="text-muted lead">{{ $route['overview'] }}</p>
                    <p class="text-muted">Safety first: To maintain our strict safety standards, mountain expeditions are available only to participants aged 12–70 years.</p>
                    <div class="row g-3 mt-4">
                        <div class="col-md-6">
                            <img src="{{ asset('images/images/Serengeti-National-Park-1.jpg') }}" class="img-fluid rounded-4 shadow-sm w-100 h-100 object-fit-cover" style="min-height: 250px;" alt="Climber">
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('images/images/4-Kilimanjaro-Jane-at-summit-SC_JW.jpg') }}" class="img-fluid rounded-4 shadow-sm w-100 h-100 object-fit-cover" style="min-height: 250px;" alt="Summit">
                        </div>
                    </div>
                </div>

                <div id="expert" class="section-card bg-earth text-white">
                    <div class="d-flex gap-4 align-items-center">
                        <i class="fas fa-user-tie fa-4x opacity-50"></i>
                        <div>
                            <h4 class="fw-bold mb-2">Expert Recommendation</h4>
                            <p class="mb-0 opacity-90 italic">"Be careful when choosing between the different variations of this route. Longer itineraries always offer much better summit success rates and are suitable for beginners. Shorter itineraries should be reserved only for experienced trekkers or those already acclimatized."</p>
                            <div class="mt-3">
                                <span class="fw-bold">Dmitry Altezza</span><br>
                                <small class="opacity-75">Kilimanjaro Expedition Coordinator</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="map" class="section-card">
                    <h4 class="fw-bold mb-4">{{ $route['name'] }} on the Map</h4>
                    <div class="route-explorer-container bg-light p-0" style="min-height: 400px; background: #f8f9fa;">
                        <img src="{{ asset('images/maps/kilimanjaro.webp') }}" class="base-map" style="opacity: 0.3;" alt="Kilimanjaro Base Map">
                        <img src="{{ asset('images/maps/' . $route['slug'] . '.webp') }}" class="route-overlay" alt="{{ $route['name'] }} Map">
                    </div>
                </div>

                <div id="success" class="section-card">
                    <h4 class="fw-bold mb-4">Summit Success Rate</h4>
                    <p class="text-muted">At Altezza Travel, since 2014 we have been gathering precise data based on thousands of our Kilimanjaro climbs. Here are the summit success rates for our {{ $route['name'] }} expeditions:</p>
                    <div class="row g-3 text-center">
                        <div class="col-md-12">
                            <div class="p-4 bg-light rounded-4 border-top border-4 border-earth">
                                <h2 class="fw-bold text-earth mb-1">{{ $route['success_rate'] }}</h2>
                                <small class="text-muted fw-bold">Average Success Rate (Uhuru Peak)</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="itinerary" class="section-card">
                    <h4 class="fw-bold mb-4">Detailed Itinerary (7 Days)</h4>
                    <div class="itinerary-list">
                        @for($i=1; $i<=7; $i++)
                        <div class="d-flex gap-4 mb-4 pb-4 border-bottom">
                            <div class="day-badge bg-earth text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px; font-weight: 800;">{{ $i }}</div>
                            <div>
                                <h5 class="fw-bold mb-2">Day {{ $i }}: Destination Details</h5>
                                <p class="text-muted small mb-0">Detailed trekking info for day {{ $i }} of the Machame route. This includes elevation gain, distance, and camp details.</p>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <div id="faq" class="section-card">
                    <h4 class="fw-bold mb-4">Machame Route FAQ</h4>
                    <div class="accordion accordion-flush" id="routeFaq">
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button rounded-4 collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#rfaq1">
                                    Is the Machame route difficult?
                                </button>
                            </h2>
                            <div id="rfaq1" class="accordion-collapse collapse" data-bs-parent="#routeFaq">
                                <div class="accordion-body text-muted">No technical skills are required, but it is physically demanding.</div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button rounded-4 collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#rfaq2">
                                    Why is it called the Whiskey Route?
                                </button>
                            </h2>
                            <div id="rfaq2" class="accordion-collapse collapse" data-bs-parent="#routeFaq">
                                <div class="accordion-body text-muted">Because it's considered tougher than the Marangu (Coca-Cola) route.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.whatsapp')
    @include('partials.booking_modal')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookingModal = document.getElementById('bookingModal');
            if (bookingModal) {
                bookingModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const tourTitle = "{{ $route['name'] }}";
                    const modalTitle = bookingModal.querySelector('.modal-title');
                    const tourNameInput = bookingModal.querySelector('#modal_tour_name');
                    modalTitle.textContent = 'Book Your Trek: ' + tourTitle;
                    if (tourNameInput) tourNameInput.value = tourTitle;
                });
            }
        });
    </script>
</body>
</html>
