<section class="hero-slider-section animate__animated animate__fadeIn">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            <!-- Slide 1: Serengeti Balloon Safari -->
            <div class="carousel-item active">
                <div class="hero-slide-bg" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ asset('images/images/360_F_294846823_EDmzSopDAYZ9x5cX3y0ZcNmo0LXDYXDc.jpg') }}');"></div>
                <div class="carousel-caption d-flex align-items-center h-100">
                    <div class="container">
                        <div class="hero-text-block animate__animated animate__fadeInLeft text-start">
                            <h1 class="hero-title mb-2">Serengeti Balloon</h1>
                            <h1 class="hero-title mb-4">& Wildlife Safaris</h1>
                            <p class="hero-description mb-4">
                                Witness the world's most spectacular wildlife event from above. Expert guides who know every corner of the savanna.
                            </p>
                            <div class="hero-buttons d-flex flex-column flex-sm-row gap-3">
                                <a href="{{ route('tours.all') }}" class="btn btn-hero-primary rounded-pill px-4 py-3">
                                    <span>Safari Packages</span>
                                </a>
                                <a href="#" class="btn btn-hero-secondary rounded-pill px-4 py-3" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                                    <span>Free Quote</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Kilimanjaro Summit -->
            <div class="carousel-item">
                <div class="hero-slide-bg" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ asset('images/images/3-Days-Serengeti-Balloon-Safaris.webp') }}');"></div>
                <div class="carousel-caption d-flex align-items-center h-100">
                    <div class="container">
                        <div class="hero-text-block animate__animated animate__fadeInLeft text-start">
                            <h1 class="hero-title mb-2">Kilimanjaro Summit</h1>
                            <h1 class="hero-title mb-4">& Trekking Expeditions</h1>
                            <p class="hero-description mb-4">
                                Conquer the Roof of Africa. Professional trekking services with a focus on safety, comfort, and success.
                            </p>
                            <div class="hero-buttons d-flex flex-column flex-sm-row gap-3">
                                <a href="{{ route('tours.all') }}" class="btn btn-hero-primary rounded-pill px-4 py-3">
                                    <span>Safari Packages</span>
                                </a>
                                <a href="#" class="btn btn-hero-secondary rounded-pill px-4 py-3" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                                    <span>Free Quote</span>
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
                    <div class="container">
                        <div class="hero-text-block animate__animated animate__fadeInLeft text-start">
                            <h1 class="hero-title mb-2">Tanzania Wildlife</h1>
                            <h1 class="hero-title mb-4">& Authentic Encounters</h1>
                            <p class="hero-description mb-4">
                                Explore the hidden gems of Tanzania. Discover the massive herds and ancient landscapes with our expert team.
                            </p>
                            <div class="hero-buttons d-flex flex-column flex-sm-row gap-3">
                                <a href="{{ route('tours.all') }}" class="btn btn-hero-primary rounded-pill px-4 py-3">
                                    <span>Safari Packages</span>
                                </a>
                                <a href="#" class="btn btn-hero-secondary rounded-pill px-4 py-3" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                                    <span>Free Quote</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev d-none d-md-flex" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon p-3 rounded-circle" style="background-color: rgba(139, 69, 19, 0.5);" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next d-none d-md-flex" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon p-3 rounded-circle" style="background-color: rgba(139, 69, 19, 0.5);" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Feature Overlay (Static) -->
    <div class="hero-features-overlay">
        <div class="container">
            <div class="hero-features row g-3 g-md-4">
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp">
                    <div class="feature-item d-flex gap-3 align-items-center">
                        <div class="feature-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="feature-text text-start">
                            <h4 class="fw-bold mb-1">Local Experts</h4>
                            <p class="mb-0">Arusha-based safari specialists with experienced guides.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="feature-item d-flex gap-3 align-items-center">
                        <div class="feature-icon">
                            <i class="fas fa-globe-africa"></i>
                        </div>
                        <div class="feature-text text-start">
                            <h4 class="fw-bold mb-1">Tailor-Made</h4>
                            <p class="mb-0">Private and group safaris customized to your style.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="feature-item d-flex gap-3 align-items-center">
                        <div class="feature-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div class="feature-text text-start">
                            <h4 class="fw-bold mb-1">Responsible</h4>
                            <p class="mb-0">Committed to sustainable travel and local communities.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
            .hero-slider-section {
                position: relative;
                overflow: hidden;
                background: transparent !important;
                min-height: 100vh;
            }
            .carousel-inner, .carousel-item {
                background: transparent !important;
                height: 100vh;
                min-height: -webkit-fill-available;
            }
            .hero-slide-bg {
                height: 100vh;
                min-height: -webkit-fill-available;
                background-size: cover !important;
                background-position: center !important;
                background-repeat: no-repeat !important;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                z-index: -1;
            }
            /* Lighter overlay to show more of the image */
            .hero-slide-bg::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.3) !important;
                z-index: 1;
            }
    .carousel-item.active .hero-slide-bg {
        animation: zoomInImage 20s linear infinite alternate;
    }
    @keyframes zoomInImage {
        from { transform: scale(1); }
        to { transform: scale(1.1); }
    }
    .carousel-caption {
        z-index: 2;
        background: transparent !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        padding: 0 !important;
        width: 100%;
        height: 100%;
        display: flex !important;
        align-items: center;
        justify-content: center;
        margin: 0 !important;
    }
    .hero-features-overlay {
        position: relative;
        margin-top: -100px; /* Pull it up into the hero */
        z-index: 10;
        padding-bottom: 60px;
        background: transparent;
    }

    .feature-item {
        background: rgba(62, 39, 35, 0.75);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        padding: 25px;
        border-radius: 20px;
        border: 1px solid rgba(222, 184, 135, 0.3);
        transition: all 0.3s ease;
        height: 100%;
        color: white;
    }

    .feature-item:hover {
        transform: translateY(-5px);
        background: rgba(62, 39, 35, 0.9);
        border-color: #DEB887;
    }

    .feature-icon {
        width: 55px;
        height: 55px;
        background: linear-gradient(135deg, #8B4513, #3E2723);
        color: #DEB887;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
        box-shadow: 0 8px 15px rgba(0,0,0,0.3);
    }

    .feature-text h4 {
        font-size: 1.15rem;
        color: #DEB887;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .feature-text p {
        font-size: 0.9rem;
        opacity: 0.9;
        line-height: 1.4;
    }

    @media (max-width: 768px) {
        .hero-features-overlay {
            margin-top: -150px;
            padding: 0 20px 50px;
            background: transparent;
        }
        .feature-item {
            padding: 20px;
            margin-bottom: 15px;
            background: rgba(62, 39, 35, 0.85);
            border-left: 4px solid #DEB887;
        }
        .feature-icon {
            width: 45px;
            height: 45px;
            font-size: 1.2rem;
        }
        .hero-slide-bg {
            height: 95vh;
        }
        .hero-title {
            font-size: 2.2rem !important;
            text-align: center;
            width: 100%;
        }
        .hero-description {
            font-size: 1.1rem !important;
            text-align: center;
        }
        .hero-buttons {
            flex-direction: column;
            gap: 15px !important;
            width: 100%;
        }
        .hero-buttons .btn {
            width: 100%;
            padding: 15px !important;
        }
        .hero-text-block {
            margin-top: 80px;
        }
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 4rem;
        font-weight: 700;
        line-height: 1.1;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
    }
    .hero-description {
        max-width: 650px;
        font-size: 1.25rem;
        line-height: 1.6;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.3);
    }
    .btn-hero-primary {
        background-color: #8B4513;
        color: white;
        border: 2px solid #8B4513;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .btn-hero-primary:hover {
        background-color: transparent;
        color: white;
        border-color: white;
    }
                color: #DEB887;
                text-shadow: 0 4px 15px rgba(0,0,0,0.5);
                animation: zoomInFade 1.2s cubic-bezier(0.2, 0.8, 0.2, 1) both;
            }
            .hero-description {
                font-size: 1.2rem !important;
                line-height: 1.5;
                color: #fff;
                opacity: 0.9;
                margin-bottom: 2.5rem !important;
                animation: fadeInUpCustom 1s ease-out 0.5s both;
            }
            .hero-text-block {
                text-align: center !important;
                padding: 0 25px;
                z-index: 5;
                width: 100%;
            }
            .hero-buttons {
                flex-direction: column;
                gap: 18px !important;
                animation: fadeInUpCustom 1s ease-out 0.8s both;
            }
            .hero-buttons .btn {
                width: 100%;
                padding: 16px 30px !important;
                font-size: 1.15rem;
                font-weight: 800;
                border-radius: 50px !important;
                text-transform: uppercase;
                letter-spacing: 2px;
                box-shadow: 0 8px 25px rgba(0,0,0,0.4);
                border-width: 2px !important;
            }
            .btn-hero-primary {
                background: #8B4513 !important;
                border-color: #8B4513 !important;
                color: #fff !important;
            }
            .btn-hero-secondary {
                background: transparent !important;
                border-color: #DEB887 !important;
                color: #DEB887 !important;
            }
            .carousel-caption {
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                padding: 0 !important;
                width: 100%;
                height: 100%;
                display: flex !important;
                align-items: center;
                justify-content: center;
                margin: 0 !important;
            }
            .hero-text-block {
                text-align: center !important;
                padding: 0 25px;
                z-index: 5;
                width: 100%;
                margin-top: 60px; /* Offset for absolute header */
            }
        }

        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes zoomInFade {
            from {
                opacity: 0;
                transform: scale(0.8) translateY(20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes fadeInUpCustom {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.2rem !important;
            }
            .hero-description {
                font-size: 1.1rem !important;
            }
        }
    </style>
