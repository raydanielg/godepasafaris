    <style>
        .hero-slider-section {
            position: relative;
            height: 100vh;
            min-height: 600px;
            overflow: hidden;
        }
        .carousel, .carousel-inner, .carousel-item {
            height: 100%;
        }
        .hero-slide-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transform: scale(1.1);
            transition: transform 8s linear;
            z-index: 1;
        }
        .carousel-item.active .hero-slide-bg {
            transform: scale(1);
        }
        .carousel-caption {
            right: 0;
            left: 0;
            padding: 0;
            text-align: left;
            background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, transparent 100%);
            z-index: 2;
        }
        .hero-text-block {
            padding: 2rem;
            max-width: 800px;
        }
        .hero-text-block h1 {
            line-height: 1.1;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .btn-hero-primary {
            background-color: #8b4513;
            border: 2px solid #8b4513;
            color: white;
            font-weight: 700;
            padding: 12px 35px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-hero-primary:hover {
            background-color: transparent;
            color: white;
            border-color: white;
            transform: translateY(-3px);
        }
        .btn-hero-secondary {
            background-color: rgba(255,255,255,0.1);
            border: 2px solid white;
            color: white;
            font-weight: 700;
            padding: 12px 35px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            backdrop-filter: blur(5px);
        }
        .btn-hero-secondary:hover {
            background-color: white;
            color: #8b4513;
            transform: translateY(-3px);
        }
        @media (max-width: 768px) {
            .hero-slider-section {
                height: 100vh;
            }
            .hero-text-block {
                padding: 1.5rem;
                text-align: center;
            }
            .carousel-caption {
                background: rgba(0,0,0,0.4);
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .hero-text-block h1 {
                font-size: 2.8rem !important;
                margin-bottom: 1rem;
            }
            .hero-text-block p {
                font-size: 1.1rem !important;
                margin-bottom: 2rem !important;
            }
            .hero-buttons {
                justify-content: center;
                gap: 1rem;
            }
            .btn-hero-primary, .btn-hero-secondary {
                width: 100%;
                padding: 15px 20px;
            }
            .hero-features-overlay {
                display: none;
            }
        }
    </style>
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            <!-- Slide 1: Serengeti Balloon Safari -->
            <div class="carousel-item active">
                <div class="hero-slide-bg" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ asset('images/images/3-Days-Serengeti-Balloon-Safaris.webp') }}');"></div>
                <div class="carousel-caption d-flex align-items-center h-100">
                    <div class="container text-start">
                        <div class="hero-text-block animate__animated animate__fadeInLeft">
                            <h1 class="display-3 fw-normal mb-2" style="font-family: 'Playfair Display', serif;">Serengeti Balloon</h1>
                            <h1 class="display-3 fw-normal mb-4" style="font-family: 'Playfair Display', serif;">& Wildlife Safaris</h1>
                            <p class="lead mb-4" style="max-width: 600px; font-size: 1.1rem; line-height: 1.6;">
                                Witness the world's most spectacular wildlife event from above.<br>
                                Expert guides who know every corner of the savanna.
                            </p>
                            <div class="hero-buttons d-flex flex-wrap gap-3">
                                <a href="{{ route('tours.all') }}" class="btn btn-hero-primary rounded-pill px-4 py-2">
                                    <span class="d-none d-md-inline">View Tanzania Safari Packages</span>
                                    <span class="d-inline d-md-none">Safaris</span>
                                </a>
                                <a href="#" class="btn btn-hero-secondary rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                                    <span class="d-none d-md-inline">Get a Custom Safari Quote</span>
                                    <span class="d-inline d-md-none">Get Quote</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Kilimanjaro Summit -->
            <div class="carousel-item">
                <div class="hero-slide-bg" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ asset('images/images/4-Kilimanjaro-Jane-at-summit-SC_JW.jpg') }}');"></div>
                <div class="carousel-caption d-flex align-items-center h-100">
                    <div class="container text-start">
                        <div class="hero-text-block animate__animated animate__fadeInLeft">
                            <h1 class="display-3 fw-normal mb-2" style="font-family: 'Playfair Display', serif;">Kilimanjaro Summit</h1>
                            <h1 class="display-3 fw-normal mb-4" style="font-family: 'Playfair Display', serif;">& Trekking Expeditions</h1>
                            <p class="lead mb-4" style="max-width: 600px; font-size: 1.1rem; line-height: 1.6;">
                                Conquer the Roof of Africa. Professional trekking services<br>
                                with a focus on safety, comfort, and success.
                            </p>
                            <div class="hero-buttons d-flex flex-wrap gap-3">
                                <a href="{{ route('tours.all') }}" class="btn btn-hero-primary rounded-pill px-4 py-2">
                                    <span class="d-none d-md-inline">View Tanzania Safari Packages</span>
                                    <span class="d-inline d-md-none">Safaris</span>
                                </a>
                                <a href="#" class="btn btn-hero-secondary rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                                    <span class="d-none d-md-inline">Get a Custom Safari Quote</span>
                                    <span class="d-inline d-md-none">Get Quote</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Wildlife Encounters -->
            <div class="carousel-item">
                <div class="hero-slide-bg" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ asset('images/images/4GyurGeCrKkxo9FvCd8bnc-1000-80.jpg') }}');"></div>
                <div class="carousel-caption d-flex align-items-center h-100">
                    <div class="container text-start">
                        <div class="hero-text-block animate__animated animate__fadeInLeft">
                            <h1 class="display-3 fw-normal mb-2" style="font-family: 'Playfair Display', serif;">Tanzania Wildlife</h1>
                            <h1 class="display-3 fw-normal mb-4" style="font-family: 'Playfair Display', serif;">& Authentic Encounters</h1>
                            <p class="lead mb-4" style="max-width: 600px; font-size: 1.1rem; line-height: 1.6;">
                                Explore the hidden gems of Tanzania. Discover the massive herds<br>
                                and ancient landscapes with our expert team.
                            </p>
                            <div class="hero-buttons d-flex flex-wrap gap-3">
                                <a href="{{ route('tours.all') }}" class="btn btn-hero-primary rounded-pill px-4 py-2">
                                    <span class="d-none d-md-inline">View Tanzania Safari Packages</span>
                                    <span class="d-inline d-md-none">Safaris</span>
                                </a>
                                <a href="#" class="btn btn-hero-secondary rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                                    <span class="d-none d-md-inline">Get a Custom Safari Quote</span>
                                    <span class="d-inline d-md-none">Get Quote</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Feature Overlay (Static) -->
    <div class="hero-features-overlay">
        <div class="container">
            <div class="hero-features row g-4">
                <div class="col-md-4">
                    <div class="feature-item d-flex gap-3">
                        <div class="feature-icon">
                            <i class="fas fa-user-shield fa-2x"></i>
                        </div>
                        <div class="feature-text text-start">
                            <h4 class="fw-bold">Local Experts</h4>
                            <p>Arusha-based safari specialists with experienced guides and deep knowledge of Tanzania's wildlife.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-item d-flex gap-3">
                        <div class="feature-icon">
                            <i class="fas fa-globe-africa fa-2x"></i>
                        </div>
                        <div class="feature-text text-start">
                            <h4 class="fw-bold">Tailor-Made Adventures</h4>
                            <p>Private and group safaris customized to match your travel style and budget.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-item d-flex gap-3">
                        <div class="feature-icon">
                            <i class="fas fa-leaf fa-2x"></i>
                        </div>
                        <div class="feature-text text-start">
                            <h4 class="fw-bold">Responsible Tourism</h4>
                            <p>Committed to sustainable travel and supporting local communities.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
