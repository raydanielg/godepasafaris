<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo')
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header')

    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/images/4-Kilimanjaro-Jane-at-summit-SC_JW.jpg') }}');">
        <div class="container text-center">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">Kilimanjaro Trekking</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Conquer the Roof of Africa with Expert Guides</p>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 animate__animated animate__fadeInLeft">
                    <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm h-100">
                        <h2 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Climbing the Roof of Africa</h2>
                        <p class="text-muted lead mb-4">Climbing Kilimanjaro is a high-altitude trek to the summit of Africa’s highest mountain, which rises to 5,895 m (19,341 ft) above sea level. Often called the “Roof of Africa,” it is the tallest free-standing mountain in the world.</p>
                        <p class="text-muted">Unlike many famous peaks, reaching the summit does not require technical mountaineering skills. With proper acclimatization and preparation, most travelers with good general fitness can successfully complete the climb.</p>
                        <div class="row g-3 mt-2">
                            <div class="col-6 col-md-3 text-center">
                                <div class="p-3 bg-light rounded-4">
                                    <h4 class="fw-bold mb-1 text-earth">5,895m</h4>
                                    <small class="text-muted">Elevation</small>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 text-center">
                                <div class="p-3 bg-light rounded-4">
                                    <h4 class="fw-bold mb-1 text-earth">98%</h4>
                                    <small class="text-muted">Success Rate</small>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 text-center">
                                <div class="p-3 bg-light rounded-4">
                                    <h4 class="fw-bold mb-1 text-earth">5</h4>
                                    <small class="text-muted">Climate Zones</small>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 text-center">
                                <div class="p-3 bg-light rounded-4">
                                    <h4 class="fw-bold mb-1 text-earth">7-8</h4>
                                    <small class="text-muted">Avg. Days</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 animate__animated animate__fadeInRight">
                    <div class="bg-earth text-white p-4 p-md-5 rounded-4 shadow-sm h-100">
                        <h4 class="fw-bold mb-4">Why Climb With Us?</h4>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3 d-flex gap-3">
                                <i class="fas fa-check-circle mt-1"></i>
                                <span>Expert WFR certified guides</span>
                            </li>
                            <li class="mb-3 d-flex gap-3">
                                <i class="fas fa-check-circle mt-1"></i>
                                <span>Unlimited bottled oxygen</span>
                            </li>
                            <li class="mb-3 d-flex gap-3">
                                <i class="fas fa-check-circle mt-1"></i>
                                <span>High-quality mountain gear</span>
                            </li>
                            <li class="mb-3 d-flex gap-3">
                                <i class="fas fa-check-circle mt-1"></i>
                                <span>Delicious & nutritious meals</span>
                            </li>
                            <li class="d-flex gap-3">
                                <i class="fas fa-check-circle mt-1"></i>
                                <span>Safety-first approach</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <h3 class="fw-bold mb-4 text-center animate__animated animate__fadeIn" style="font-family: 'Playfair Display', serif;">Kilimanjaro Routes</h3>
            
            <div class="route-explorer-container mb-5 shadow-sm">
                <!-- Navigation Tabs (Sidebar) -->
                <div class="route-sidebar p-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active shadow-sm mb-2" id="v-pills-machame-tab" data-bs-toggle="pill" data-bs-target="#v-pills-machame" type="button" role="tab"><i class="fas fa-map-marker-alt me-2"></i> Machame Route</button>
                        <button class="nav-link shadow-sm mb-2" id="v-pills-lemosho-tab" data-bs-toggle="pill" data-bs-target="#v-pills-lemosho" type="button" role="tab"><i class="fas fa-map-marker-alt me-2"></i> Lemosho Route</button>
                        <button class="nav-link shadow-sm mb-2" id="v-pills-marangu-tab" data-bs-toggle="pill" data-bs-target="#v-pills-marangu" type="button" role="tab"><i class="fas fa-map-marker-alt me-2"></i> Marangu Route</button>
                        <button class="nav-link shadow-sm mb-2" id="v-pills-rongai-tab" data-bs-toggle="pill" data-bs-target="#v-pills-rongai" type="button" role="tab"><i class="fas fa-map-marker-alt me-2"></i> Rongai Route</button>
                        <button class="nav-link shadow-sm mb-2" id="v-pills-umbwe-tab" data-bs-toggle="pill" data-bs-target="#v-pills-umbwe" type="button" role="tab"><i class="fas fa-map-marker-alt me-2"></i> Umbwe Route</button>
                        <button class="nav-link shadow-sm" id="v-pills-northern-tab" data-bs-toggle="pill" data-bs-target="#v-pills-northern" type="button" role="tab"><i class="fas fa-map-marker-alt me-2"></i> Northern Circuit Route</button>
                    </div>
                </div>

                <!-- Map Visualization Area -->
                <div class="route-map-visual">
                    <img src="{{ asset('images/maps/kilimanjaro.webp') }}" class="base-map" alt="Kilimanjaro Base Map">
                    <div class="tab-content h-100" id="v-pills-tabContent">
                        <div class="tab-pane fade show active h-100" id="v-pills-machame" role="tabpanel">
                            <img src="{{ asset('images/maps/machame.webp') }}" class="route-overlay" alt="Machame Route Map">
                            <div class="route-info-overlay animate__animated animate__fadeInUp">
                                <h4 class="fw-bold mb-3"><i class="fas fa-route text-earth me-2"></i> Machame Route</h4>
                                <p class="text-muted small">The Machame hiking trail is the second most popular on Kilimanjaro. It starts in the tropical rainforest on the southern slope of the mountain. Beginners should choose the seven-day option for a better acclimatization profile.</p>
                                <a href="{{ route('kilimanjaro.route.show', 'machame') }}" class="btn-more-about">MORE ABOUT MACHAME</a>
                            </div>
                        </div>
                        <div class="tab-pane fade h-100" id="v-pills-lemosho" role="tabpanel">
                            <img src="{{ asset('images/maps/lemosho.webp') }}" class="route-overlay" alt="Lemosho Route Map">
                            <div class="route-info-overlay animate__animated animate__fadeInUp">
                                <h4 class="fw-bold mb-3"><i class="fas fa-route text-earth me-2"></i> Lemosho Route</h4>
                                <p class="text-muted small">The Lemosho Route is widely considered the most scenic on Kilimanjaro. It offers an excellent acclimatization profile and higher success rates. It begins from the west and joins the Machame route on day three.</p>
                                <a href="{{ route('kilimanjaro.route.show', 'lemosho') }}" class="btn-more-about">MORE ABOUT LEMOSHO</a>
                            </div>
                        </div>
                        <div class="tab-pane fade h-100" id="v-pills-marangu" role="tabpanel">
                            <img src="{{ asset('images/maps/marangu.webp') }}" class="route-overlay" alt="Marangu Route Map">
                            <div class="route-info-overlay animate__animated animate__fadeInUp">
                                <h4 class="fw-bold mb-3"><i class="fas fa-route text-earth me-2"></i> Marangu Route</h4>
                                <p class="text-muted small">Known as the "Coca-Cola" route, Marangu is the oldest and most established route. It is the only route that provides hut accommodation, making it popular during the rainy season.</p>
                                <a href="{{ route('kilimanjaro.route.show', 'marangu') }}" class="btn-more-about">MORE ABOUT MARANGU</a>
                            </div>
                        </div>
                        <div class="tab-pane fade h-100" id="v-pills-rongai" role="tabpanel">
                            <img src="{{ asset('images/maps/rongai.webp') }}" class="route-overlay" alt="Rongai Route Map">
                            <div class="route-info-overlay animate__animated animate__fadeInUp">
                                <h4 class="fw-bold mb-3"><i class="fas fa-route text-earth me-2"></i> Rongai Route</h4>
                                <p class="text-muted small">The Rongai route is the only trail that approaches Kilimanjaro from the north. It is one of the quietest and driest routes, making it a great choice during the wet season.</p>
                                <a href="{{ route('kilimanjaro.route.show', 'rongai') }}" class="btn-more-about">MORE ABOUT RONGAI</a>
                            </div>
                        </div>
                        <div class="tab-pane fade h-100" id="v-pills-umbwe" role="tabpanel">
                            <img src="{{ asset('images/maps/umbwe.webp') }}" class="route-overlay" alt="Umbwe Route Map">
                            <div class="route-info-overlay animate__animated animate__fadeInUp">
                                <h4 class="fw-bold mb-3"><i class="fas fa-route text-earth me-2"></i> Umbwe Route</h4>
                                <p class="text-muted small">The Umbwe route is the shortest, steepest and most direct route on Kilimanjaro. It is considered very difficult and only suitable for experienced hikers.</p>
                                <a href="{{ route('kilimanjaro.route.show', 'umbwe') }}" class="btn-more-about">MORE ABOUT UMBWE</a>
                            </div>
                        </div>
                        <div class="tab-pane fade h-100" id="v-pills-northern" role="tabpanel">
                            <img src="{{ asset('images/maps/northern-circuit.webp') }}" class="route-overlay" alt="Northern Circuit Map">
                            <div class="route-info-overlay animate__animated animate__fadeInUp">
                                <h4 class="fw-bold mb-3"><i class="fas fa-route text-earth me-2"></i> Northern Circuit Route</h4>
                                <p class="text-muted small">The Northern Circuit is the longest route on Kilimanjaro, offering the best acclimatization and the highest success rate. It circles around the quiet northern slopes.</p>
                                <a href="{{ route('kilimanjaro.route.show', 'northern') }}" class="btn-more-about">MORE ABOUT NORTHERN</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="fw-bold mb-4 text-center animate__animated animate__fadeIn" style="font-family: 'Playfair Display', serif;">Our Expedition Packages</h3>
            <div class="row g-4 mb-5">
                @foreach($packages->take(4) as $pkg)
                <div class="col-lg-3 col-md-6 animate__animated animate__fadeInUp">
                    <div class="package-card h-100 rounded-4 overflow-hidden border-0 shadow-sm bg-white">
                        <div class="package-img-wrapper" style="height: 200px; position: relative; overflow: hidden;">
                            <img src="{{ asset($pkg->image) }}" class="w-100 h-100 object-fit-cover transition-all" alt="{{ $pkg->title }}">
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-earth rounded-pill px-3 py-2 shadow-sm">Tanzania</span>
                            </div>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <h6 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; min-height: 2.5rem;">
                                <a href="{{ route('kilimanjaro.show', $pkg->slug) }}" class="text-dark text-decoration-none hover-primary">{{ $pkg->title }}</a>
                            </h6>
                            
                            <div class="tour-rating mb-3">
                                <div class="stars d-inline-block text-warning small">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <span class="fw-bold ms-2 small">5/5</span>
                            </div>

                            <div class="price-section mb-4 mt-auto">
                                <div class="d-flex align-items-baseline gap-1">
                                    <span class="text-muted small">from</span>
                                    <span class="fw-bold fs-4 text-earth">${{ number_format($pkg->price, 0) }}</span>
                                </div>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-earth flex-grow-1 py-2 rounded-pill text-white small" data-bs-toggle="modal" data-bs-target="#bookingModal" data-tour-title="{{ $pkg->title }}" data-tour-id="{{ $pkg->id }}">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mb-5">
                <a href="{{ route('kilimanjaro') }}?all=1" class="btn btn-outline-earth rounded-pill px-5 py-2 fw-bold">VIEW ALL KILIMANJARO PACKAGES</a>
            </div>

            <!-- Detailed Information Section -->
            <div class="row g-5 mt-5">
                <div class="col-lg-8">
                    <div class="info-content-card bg-white p-4 p-md-5 rounded-4 shadow-sm mb-4">
                        <h3 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Success Rates & Planning</h3>
                        <p class="text-muted">Routes like Lemosho, Machame, Rongai, and the Northern Circuit have the highest summit success rates on Kilimanjaro with itineraries of 7 days or longer. We recommend choosing a 7–8 day climb as the optimal length to give your body enough time to acclimatize and to greatly reduce the risk of Acute Mountain Sickness (AMS).</p>
                        
                        <div class="mt-5">
                            <h4 class="fw-bold mb-3">Best Time to Climb</h4>
                            <p class="text-muted">Late December to early March and mid-June to late October are the best times for a Kilimanjaro climb. This is when the Kilimanjaro weather is nearly ideal. Although other months have rain, it doesn't mean there are constant heavy showers.</p>
                        </div>

                        <div class="mt-5">
                            <h4 class="fw-bold mb-3">Training & Preparation</h4>
                            <p class="text-muted">A moderate fitness level is key. You should be able to run 5 km (3 mi) without difficulty and hike 10 km (6+ mi) in a day. Best training includes swimming, cycling, running, and hiking.</p>
                        </div>
                    </div>

                    <div class="faq-section bg-white p-4 p-md-5 rounded-4 shadow-sm">
                        <h3 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Frequently Asked Questions</h3>
                        <div class="accordion accordion-flush" id="kiliFaq">
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button rounded-4 collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        Can a Beginner Climb Kilimanjaro?
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#kiliFaq">
                                    <div class="accordion-body text-muted">
                                        Yes, Kilimanjaro is accessible to beginners with no trekking experience. The key factor isn’t hiking skills but proper acclimatization, which is best achieved on a 7–8-day route.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button rounded-4 collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        How Much Does It Cost?
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#kiliFaq">
                                    <div class="accordion-body text-muted">
                                        As of 2026, a comfortable and safe 7-day group climb costs about $3,040. A shorter 5-6-day adventure or a season-discounted trip comes at $2,200-$2,700. This includes park fees (about 35% of total cost).
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button rounded-4 collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                        How Do I Get to Kilimanjaro?
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#kiliFaq">
                                    <div class="accordion-body text-muted">
                                        The easiest way is flying into Kilimanjaro International Airport (JRO). Major airlines such as Turkish Airlines, Qatar Airways, KLM, and Ethiopian Airlines offer regular flights.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px;">
                        <div class="bg-white p-4 rounded-4 shadow-sm mb-4 border-top border-4 border-earth">
                            <h5 class="fw-bold mb-3">Quick Facts</h5>
                            <div class="small">
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">First Climb</span>
                                    <span class="fw-bold">1889</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">First Female Ascent</span>
                                    <span class="fw-bold">1927</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Climate Zones</span>
                                    <span class="fw-bold">5 Unique Zones</span>
                                </div>
                                <div class="d-flex justify-content-between py-2">
                                    <span class="text-muted">Status</span>
                                    <span class="fw-bold text-success">UNESCO Site</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-dark text-white p-4 rounded-4 shadow-sm">
                            <h5 class="fw-bold mb-3">Need Help?</h5>
                            <p class="small opacity-75 mb-4">Our expert team is based in Tanzania and ready to help you plan your climb.</p>
                            <a href="https://wa.me/255794636471" class="btn btn-earth w-100 rounded-pill mb-2"><i class="fab fa-whatsapp me-2"></i> WhatsApp Us</a>
                            <button class="btn btn-outline-light w-100 rounded-pill" data-bs-toggle="modal" data-bs-target="#bookingModal">Request Custom Quote</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
    @include('partials.whatsapp')
    @include('partials.booking_modal')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookingModal = document.getElementById('bookingModal');
        if (bookingModal) {
            bookingModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const tourTitle = button.getAttribute('data-tour-title');
                const tourId = button.getAttribute('data-tour-id');
                
                const modalTitle = bookingModal.querySelector('.modal-title');
                const tourIdInput = bookingModal.querySelector('#modal_tour_id');
                const tourNameInput = bookingModal.querySelector('#modal_tour_name');
                
                modalTitle.textContent = 'Book Your Trek: ' + tourTitle;
                if (tourIdInput) tourIdInput.value = tourId;
                if (tourNameInput) tourNameInput.value = tourTitle;
            });
        }
    });
    </script>
    
    <style>
        .hover-primary:hover { color: #8b4513 !important; }
        .bg-earth { background-color: #8b4513 !important; }
        .text-earth { color: #8b4513 !important; }
        .btn-earth { background-color: #8b4513 !important; border-color: #8b4513 !important; color: white !important; }
        .btn-earth:hover { background-color: #a0522d !important; border-color: #a0522d !important; }
        .btn-outline-earth { color: #8b4513 !important; border-color: #8b4513 !important; }
        .btn-outline-earth:hover { background-color: #8b4513 !important; color: white !important; }
        
        /* Routes Tab Styling */
        #v-pills-tab .nav-link {
            color: #495057;
            background-color: transparent;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        #v-pills-tab .nav-link:hover {
            background-color: #f8f9fa;
            color: #8b4513;
        }
        #v-pills-tab .nav-link.active {
            color: #8b4513;
            background-color: #fdf5e6;
            border-left: 4px solid #8b4513 !important;
        }
        .tab-content {
            border-left: 1px solid #dee2e6;
        }

        /* Route Map Overlapping Style */
        .route-explorer-container {
            position: relative;
            background: #e9e9e9;
            border-radius: 1.5rem;
            overflow: hidden;
            padding: 2rem;
            min-height: 600px;
        }
        .route-map-visual {
            position: absolute;
            top: 0;
            right: 0;
            width: 70%;
            height: 100%;
            z-index: 1;
        }
        .base-map {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            object-fit: contain;
            opacity: 0.8;
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
        .route-sidebar {
            position: relative;
            z-index: 3;
            width: 300px;
        }
        .route-info-overlay {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            width: 400px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 1.5rem;
            z-index: 4;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        #v-pills-tab .nav-link {
            background: #f5f5f5;
            border: 1px solid #ddd;
            margin-bottom: 0.75rem;
            color: #333;
            border-radius: 0.5rem;
            text-align: left;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        #v-pills-tab .nav-link.active {
            background: #fff;
            border-color: #8b4513;
            color: #000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .btn-more-about {
            background-color: #5d7c27;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            margin-top: 1rem;
            display: inline-block;
            text-decoration: none;
        }
        .btn-more-about:hover {
            background-color: #4a631f;
            color: white;
        }
        @media (max-width: 991.98px) {
            .route-explorer-container {
                display: flex;
                flex-direction: column;
                min-height: auto;
                padding: 1rem;
            }
            .route-sidebar {
                width: 100%;
                margin-bottom: 1.5rem;
            }
            .route-map-visual {
                position: relative;
                width: 100%;
                height: 350px;
            }
            .route-info-overlay {
                position: relative;
                width: 100%;
                bottom: auto;
                left: auto;
                margin-top: 1rem;
                background: #fff;
            }
        }

        @media (max-width: 991.98px) {
            .tab-content {
                border-left: none;
                border-top: 1px solid #dee2e6;
                margin-top: 1.5rem;
            }
        }
    </style>
</body>
</html>
