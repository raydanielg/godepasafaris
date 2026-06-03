<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kilimanjaro Packing List - Essential Gear Guide - Go Deep Africa Safari</title>
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .packing-hero {
            min-height: 60vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 100%),
                        url('https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
        .category-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .category-card:hover {
            transform: translateY(-5px);
            border-color: #8B4513;
        }
        .item-check {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    @include('partials.header')

    <!-- Hero -->
    <section class="packing-hero text-white d-flex align-items-center">
        <div class="container text-center" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-4 py-2 mb-3">
                <i class="fas fa-suitcase me-2"></i>Free PDF Download
            </span>
            <h1 class="display-3 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">
                Kilimanjaro Packing List
            </h1>
            <p class="lead mx-auto mb-4" style="max-width: 700px;">
                Complete gear guide for your summit attempt. Everything you need, nothing you don't.
            </p>
            <a href="#" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                <i class="fas fa-download me-2"></i>Download PDF
            </a>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-5">
        <div class="container py-4">
            <div class="row g-4">
                <!-- Clothing -->
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="category-card card h-100 border-0 rounded-4 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4" style="color: #8B4513;"><i class="fas fa-tshirt me-2"></i>Clothing</h4>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Waterproof jacket</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Thermal layers (3-4)</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Hiking pants (2)</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Warm gloves</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Warm hat/beanie</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Buff/neck gaiter</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Hiking socks (4-5)</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Base layers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Equipment -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="category-card card h-100 border-0 rounded-4 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4" style="color: #8B4513;"><i class="fas fa-hiking me-2"></i>Equipment</h4>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Hiking boots</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Sleeping bag (-20°C)</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Trekking poles</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Headlamp + batteries</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Daypack (30-40L)</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Duffel bag (90L)</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Camp pillow</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Gaiters</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hydration & Nutrition -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="category-card card h-100 border-0 rounded-4 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4" style="color: #8B4513;"><i class="fas fa-tint me-2"></i>Hydration & Nutrition</h4>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Water bottles (2L)</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Water purification</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Energy snacks</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Electrolytes</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Trail mix</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Energy bars</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Health & Safety -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="category-card card h-100 border-0 rounded-4 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4" style="color: #8B4513;"><i class="fas fa-first-aid me-2"></i>Health & Safety</h4>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>First aid kit</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Sunscreen (SPF 50+)</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Sunglasses (UV400)</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Altitude meds</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Lip balm</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Hand sanitizer</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Toilet paper</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Wet wipes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Toiletries -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="category-card card h-100 border-0 rounded-4 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4" style="color: #8B4513;"><i class="fas fa-pump-soap me-2"></i>Toiletries</h4>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Toothbrush/paste</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Biodegradable soap</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Shampoo</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Deodorant</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Towel (quick-dry)</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Feminine hygiene</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="category-card card h-100 border-0 rounded-4 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4" style="color: #8B4513;"><i class="fas fa-passport me-2"></i>Documents</h4>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Passport</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Visa</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Travel insurance</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Cash (USD)</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Credit card</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" class="item-check">
                                        <span>Printed itinerary</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <h2 class="display-5 fw-bold mb-4 text-center" style="color: #3E2723; font-family: 'Playfair Display', serif;" data-aos="fade-up">
                Packing Tips
            </h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 rounded-4 shadow-sm p-4">
                        <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                            <i class="fas fa-weight-hanging text-white fa-lg"></i>
                        </div>
                        <h5 class="fw-bold text-center mb-2" style="color: #3E2723;">Pack Light</h5>
                        <p class="text-muted text-center small">Porters carry up to 15kg. Keep your duffel under this limit.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 rounded-4 shadow-sm p-4">
                        <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                            <i class="fas fa-layer-group text-white fa-lg"></i>
                        </div>
                        <h5 class="fw-bold text-center mb-2" style="color: #3E2723;">Layer System</h5>
                        <p class="text-muted text-center small">Use base, mid, and outer layers for temperature regulation.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card border-0 rounded-4 shadow-sm p-4">
                        <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                            <i class="fas fa-shoe-prints text-white fa-lg"></i>
                        </div>
                        <h5 class="fw-bold text-center mb-2" style="color: #3E2723;">Break In Boots</h5>
                        <p class="text-muted text-center small">Wear your hiking boots for 2-3 weeks before the climb.</p>
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
