<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', [
        'seoTitle' => 'Giving Back: How Go Deep Africa Safari Supports Tanzanian Communities',
        'seoDescription' => 'Discover how Go Deep Africa Safari gives back through community projects, conservation and fair local employment across Tanzania. Travel that makes a real difference.',
    ])
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header')

    <!-- Hero Section -->
    <section class="impact-hero d-flex align-items-center justify-content-center text-center text-white position-relative" style="min-height: 80vh; background: linear-gradient(135deg, rgba(62,39,35,0.85) 0%, rgba(139,69,19,0.75) 50%, rgba(62,39,35,0.85) 100%), url('{{ bg('bg_impact', 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="container position-relative z-2">
            <span class="badge bg-warning text-dark px-4 py-2 mb-4 animate__animated animate__fadeInDown" style="font-size: 0.9rem; letter-spacing: 2px;">
                <i class="fas fa-heart me-2"></i>Safari with Purpose
            </span>
            <h1 class="display-2 fw-bold mb-4 animate__animated animate__fadeInUp" style="font-family: 'Nunito', sans-serif; text-shadow: 2px 4px 20px rgba(0,0,0,0.5);">Transforming Lives Through Travel</h1>
            <p class="lead mx-auto mb-5 animate__animated animate__fadeInUp animate__delay-1s" style="max-width: 900px; font-size: 1.35rem; text-shadow: 1px 2px 10px rgba(0,0,0,0.5);">Every safari you book with us creates ripples of hope across Tanzania. Together, we've touched thousands of lives.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3 animate__animated animate__fadeInUp animate__delay-2s">
                <a href="#impact-numbers" class="btn btn-lg px-5 py-3 rounded-pill fw-bold shadow-lg" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); border: none; color: #3E2723;">
                    <i class="fas fa-chart-line me-2"></i>See Our Impact
                </a>
                <a href="#how-it-works" class="btn btn-lg btn-outline-light px-5 py-3 rounded-pill fw-bold">
                    <i class="fas fa-play-circle me-2"></i>How It Works
                </a>
            </div>
        </div>
        <div class="scroll-indicator position-absolute bottom-0 mb-4 animate__animated animate__bounce animate__infinite">
            <a href="#impact-numbers" class="text-white opacity-75">
                <i class="fas fa-chevron-down fa-2x"></i>
            </a>
        </div>
    </section>

    <!-- Impact Numbers Section - Animated Counters -->
    <section id="impact-numbers" class="py-5 position-relative" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 50%, #3E2723 100%);">
        <div class="container py-4">
            <div class="row text-center g-4">
                @forelse($stats as $stat)
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="counter-box p-4">
                        <div class="counter-icon mb-3" style="color: #DEB887; font-size: 2.5rem;">
                            <i class="fas {{ $stat->icon }}"></i>
                        </div>
                        <h2 class="display-4 fw-bold text-white counter" data-target="{{ $stat->value }}">0</h2>
                        <p class="text-white-50 text-uppercase fw-bold mb-0" style="font-size: 0.85rem; letter-spacing: 1px;">{{ $stat->label }}</p>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-white-50 py-4">
                    <p>No statistics available at this time.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <span class="text-uppercase fw-bold" style="color: #8B4513; letter-spacing: 3px; font-size: 0.9rem;">Our Commitment</span>
                    <h2 class="display-5 fw-bold mb-4 mt-3" style="color: #3E2723; font-family: 'Nunito', sans-serif;">Why We Give Back</h2>
                    <p class="text-muted fs-5 mb-4">At Go Deep Africa Safari, we believe that tourism should be a force for good. Born and raised in the shadow of Kilimanjaro, our founders witnessed firsthand the challenges faced by vulnerable communities. That's why 10% of every booking goes directly to transforming lives across Tanzania.</p>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle" style="color: #8B4513;"></i>
                            <span class="fw-bold">Transparent Giving</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle" style="color: #8B4513;"></i>
                            <span class="fw-bold">100% Local Impact</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle" style="color: #8B4513;"></i>
                            <span class="fw-bold">Verified Results</span>
                        </div>
                    </div>
                    <a href="#gallery" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold">
                        <i class="fas fa-images me-2"></i>See Our Work
                    </a>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="position-relative">
                        <div class="rounded-4 overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" alt="African Children" style="height: 450px; object-fit: cover;">
                        </div>
                        <div class="position-absolute bottom-0 start-0 m-3 bg-white rounded-4 p-3 shadow-lg" style="max-width: 250px;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%);">
                                    <i class="fas fa-heart text-white"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0" style="color: #3E2723;">Pure Love</h6>
                                    <small class="text-muted">For Our Community</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-5" style="background: linear-gradient(135deg, #fdfaf5 0%, #f5e6d3 100%);">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-uppercase fw-bold" style="color: #8B4513; letter-spacing: 3px; font-size: 0.9rem;">The Process</span>
                <h2 class="display-5 fw-bold mb-3 mt-3" style="color: #3E2723; font-family: 'Nunito', sans-serif;">How It Works</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">From your safari booking to community impact - see the journey of your contribution</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                    <div class="process-card h-100 text-center p-4 bg-white rounded-4 shadow-sm">
                        <div class="process-number mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold text-white" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); border-radius: 50%; font-size: 1.5rem;">1</div>
                        <div class="mb-3" style="color: #8B4513; font-size: 2rem;">
                            <i class="fas fa-suitcase-rolling"></i>
                        </div>
                        <h5 class="fw-bold mb-2">You Book a Safari</h5>
                        <p class="text-muted small mb-0">Choose your dream adventure with Go Deep Africa Safari</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="process-card h-100 text-center p-4 bg-white rounded-4 shadow-sm">
                        <div class="process-number mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold text-white" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); border-radius: 50%; font-size: 1.5rem;">2</div>
                        <div class="mb-3" style="color: #8B4513; font-size: 2rem;">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <h5 class="fw-bold mb-2">10% Allocated</h5>
                        <p class="text-muted small mb-0">Portion of profits automatically goes to our foundation</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="process-card h-100 text-center p-4 bg-white rounded-4 shadow-sm">
                        <div class="process-number mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold text-white" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); border-radius: 50%; font-size: 1.5rem;">3</div>
                        <div class="mb-3" style="color: #8B4513; font-size: 2rem;">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Direct Support</h5>
                        <p class="text-muted small mb-0">Funds reach orphans, women & street children directly</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="process-card h-100 text-center p-4 bg-white rounded-4 shadow-sm">
                        <div class="process-number mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold text-white" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); border-radius: 50%; font-size: 1.5rem;">4</div>
                        <div class="mb-3" style="color: #8B4513; font-size: 2rem;">
                            <i class="fas fa-smile-beam"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Lives Changed</h5>
                        <p class="text-muted small mb-0">You receive updates on the impact you've created</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Support Categories - Enhanced -->
    <section id="orphans" class="categories-section py-5" style="background-color: #fdfaf5;">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-uppercase fw-bold" style="color: #8B4513; letter-spacing: 3px; font-size: 0.9rem;">Our Focus Areas</span>
                <h2 class="display-5 fw-bold mb-3 mt-3" style="color: #3E2723; font-family: 'Nunito', sans-serif;">Who We Support</h2>
                <div class="mx-auto mt-2 mb-4" style="width: 80px; height: 4px; background: #8B4513;"></div>
                <p class="text-muted mx-auto" style="max-width: 700px;">We focus on three key areas where we can make the most meaningful impact in Tanzanian communities</p>
            </div>
            <div class="row g-4">
                <div id="orphans-card" class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="category-card p-5 text-center bg-white rounded-4 shadow-sm h-100 transition-all position-relative overflow-hidden">
                        <div class="category-bg-icon position-absolute top-0 end-0 opacity-10" style="font-size: 10rem; color: #8B4513; transform: translate(30%, -30%);">
                            <i class="fas fa-child"></i>
                        </div>
                        <div class="icon-box mb-4 mx-auto" style="width: 90px; height: 90px; background: linear-gradient(135deg, #fdf5e6 0%, #f5deb3 100%); color: #8B4513; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem;">
                            <i class="fas fa-child"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Orphans & Vulnerable Children</h4>
                        <p class="text-muted">We provide educational materials, food, healthcare support, and safe spaces to local orphanages in Arusha and surrounding areas. Every child deserves a future.</p>
                        <div class="mt-3 pt-3 border-top">
                            <small class="text-muted"><i class="fas fa-map-marker-alt me-1" style="color: #8B4513;"></i> 15+ Orphanages Supported</small>
                        </div>
                    </div>
                </div>
                <div id="women" class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="category-card p-5 text-center bg-white rounded-4 shadow-sm h-100 transition-all position-relative overflow-hidden">
                        <div class="category-bg-icon position-absolute top-0 end-0 opacity-10" style="font-size: 10rem; color: #8B4513; transform: translate(30%, -30%);">
                            <i class="fas fa-female"></i>
                        </div>
                        <div class="icon-box mb-4 mx-auto" style="width: 90px; height: 90px; background: linear-gradient(135deg, #fdf5e6 0%, #f5deb3 100%); color: #8B4513; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem;">
                            <i class="fas fa-female"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Empowering Women</h4>
                        <p class="text-muted">Supporting local women's groups through micro-finance, skill-building projects, and entrepreneurship training to help them achieve financial independence and dignity.</p>
                        <div class="mt-3 pt-3 border-top">
                            <small class="text-muted"><i class="fas fa-briefcase me-1" style="color: #8B4513;"></i> 850+ Women Trained</small>
                        </div>
                    </div>
                </div>
                <div id="street" class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="category-card p-5 text-center bg-white rounded-4 shadow-sm h-100 transition-all position-relative overflow-hidden">
                        <div class="category-bg-icon position-absolute top-0 end-0 opacity-10" style="font-size: 10rem; color: #8B4513; transform: translate(30%, -30%);">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div class="icon-box mb-4 mx-auto" style="width: 90px; height: 90px; background: linear-gradient(135deg, #fdf5e6 0%, #f5deb3 100%); color: #8B4513; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem;">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Street Children</h4>
                        <p class="text-muted">Collaborating with local initiatives to provide shelter, rehabilitation, education, and vocational training for children living on the streets, giving them a second chance at life.</p>
                        <div class="mt-3 pt-3 border-top">
                            <small class="text-muted"><i class="fas fa-home me-1" style="color: #8B4513;"></i> 8 Rehabilitation Centers</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Gallery Section -->
    <section id="gallery" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-uppercase fw-bold" style="color: #8B4513; letter-spacing: 3px; font-size: 0.9rem;">Visual Stories</span>
                <h2 class="display-5 fw-bold mb-3 mt-3" style="color: #3E2723; font-family: 'Nunito', sans-serif;">Moments of Impact</h2>
                <div class="mx-auto mt-2 mb-4" style="width: 80px; height: 4px; background: #8B4513;"></div>
                <p class="text-muted mx-auto" style="max-width: 700px;">Glimpses of the lives we've touched and the communities we've helped transform</p>
            </div>
            <div class="row g-3">
                @forelse($gallery as $item)
                <div class="col-md-{{ $item->column_width }}" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="gallery-item position-relative rounded-4 overflow-hidden" style="height: 280px;">
                        <img src="{{ asset($item->image) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $item->title }}">
                        <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end p-4" style="background: linear-gradient(to top, rgba(62,39,35,0.9) 0%, transparent 100%);">
                            <div class="text-white">
                                <h6 class="fw-bold mb-1">{{ $item->title }}</h6>
                                <small class="opacity-75">{{ $item->subtitle ?? $item->location }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">No gallery images available.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Success Stories Section -->
    <section id="stories" class="py-5" style="background: linear-gradient(135deg, #fdfaf5 0%, #f5e6d3 100%);">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-uppercase fw-bold" style="color: #8B4513; letter-spacing: 3px; font-size: 0.9rem;">Real Stories</span>
                <h2 class="display-5 fw-bold mb-3 mt-3" style="color: #3E2723; font-family: 'Nunito', sans-serif;">Lives We've Transformed</h2>
                <div class="mx-auto mt-2 mb-4" style="width: 80px; height: 4px; background: #8B4513;"></div>
            </div>
            <div class="row g-4">
                @forelse($stories as $story)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="story-card bg-white rounded-4 shadow-sm h-100 overflow-hidden">
                        <div class="position-relative" style="height: 200px;">
                            <img src="{{ asset($story->image) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $story->name }}'s Story">
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">{{ $story->badge }}</span>
                            </div>
                            @if($story->is_featured)
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i>Featured</span>
                            </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h5 class="fw-bold mb-2" style="color: #3E2723;">{{ $story->title }}</h5>
                            <p class="text-muted small mb-3">"{{ $story->quote }}"</p>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-map-marker-alt" style="color: #8B4513;"></i>
                                <small class="text-muted">{{ $story->location }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">No stories available at this time.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Impact Timeline Section -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-uppercase fw-bold" style="color: #8B4513; letter-spacing: 3px; font-size: 0.9rem;">Our Journey</span>
                <h2 class="display-5 fw-bold mb-3 mt-3" style="color: #3E2723; font-family: 'Nunito', sans-serif;">Milestones of Impact</h2>
                <div class="mx-auto mt-2 mb-4" style="width: 80px; height: 4px; background: #8B4513;"></div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="timeline position-relative">
                        @forelse($timeline as $event)
                        <div class="timeline-item d-flex {{ !$loop->last ? 'mb-5' : '' }}" data-aos="{{ $loop->iteration % 2 == 0 ? 'fade-left' : 'fade-right' }}">
                            <div class="timeline-year text-end pe-4" style="min-width: 100px;">
                                <span class="fw-bold" style="color: #8B4513; font-size: 1.5rem;">{{ $event->year }}</span>
                            </div>
                            <div class="timeline-dot position-relative">
                                <div class="rounded-circle" style="width: 20px; height: 20px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); border: 4px solid #fff; box-shadow: 0 0 0 4px #8B4513;">
                                    @if($event->icon)
                                    <i class="fas {{ $event->icon }}" style="font-size: 8px; color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="timeline-content ps-4 {{ !$loop->last ? 'pb-4' : '' }}" style="border-left: 2px solid #e0e0e0;">
                                <h5 class="fw-bold mb-2" style="color: #3E2723;">{{ $event->title }}</h5>
                                <p class="text-muted mb-0">{{ $event->description }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <p class="text-muted">No timeline events available.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section id="partners" class="py-5" style="background-color: #fdfaf5;">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-uppercase fw-bold" style="color: #8B4513; letter-spacing: 3px; font-size: 0.9rem;">Collaboration</span>
                <h2 class="display-5 fw-bold mb-3 mt-3" style="color: #3E2723; font-family: 'Nunito', sans-serif;">Our Partners</h2>
                <div class="mx-auto mt-2 mb-4" style="width: 80px; height: 4px; background: #8B4513;"></div>
                <p class="text-muted mx-auto" style="max-width: 700px;">Working together with local and international organizations to maximize our impact</p>
            </div>
            <div class="row g-4 justify-content-center">
                @forelse($partners as $partner)
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="partner-card bg-white rounded-4 p-4 text-center shadow-sm h-100 d-flex align-items-center justify-content-center">
                        <div>
                            <i class="fas {{ $partner->icon }} fa-3x mb-3" style="color: #8B4513;"></i>
                            <h6 class="fw-bold mb-0">{{ $partner->name }}</h6>
                            @if($partner->description)
                            <small class="text-muted d-block mt-2">{{ Str::limit($partner->description, 60) }}</small>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">No partners available.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Get Involved / Volunteer Section -->
    <section id="volunteer" class="py-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, rgba(62,39,35,0.95) 0%, rgba(139,69,19,0.9) 100%), url('https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="container py-5 position-relative z-2">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-white" data-aos="fade-right">
                    <span class="badge bg-warning text-dark px-3 py-2 mb-3">Join Us</span>
                    <h2 class="display-5 fw-bold mb-4" style="font-family: 'Nunito', sans-serif;">Get Involved</h2>
                    <p class="lead opacity-75 mb-4">Beyond booking a safari, there are many ways to support our mission and make a lasting impact in Tanzanian communities.</p>
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px; background: rgba(222, 184, 135, 0.2);">
                                    <i class="fas fa-hand-holding-heart" style="color: #DEB887;"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Donate Directly</h6>
                                    <small class="opacity-75">Support specific projects</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px; background: rgba(222, 184, 135, 0.2);">
                                    <i class="fas fa-users" style="color: #DEB887;"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Volunteer</h6>
                                    <small class="opacity-75">Join our programs</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px; background: rgba(222, 184, 135, 0.2);">
                                    <i class="fas fa-share-alt" style="color: #DEB887;"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Spread the Word</h6>
                                    <small class="opacity-75">Share our story</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px; background: rgba(222, 184, 135, 0.2);">
                                    <i class="fas fa-briefcase" style="color: #DEB887;"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Corporate Partnership</h6>
                                    <small class="opacity-75">Partner with us</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="btn btn-lg px-5 py-3 rounded-pill fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); border: none; color: #3E2723;">
                        <i class="fas fa-envelope me-2"></i>Contact Us
                    </a>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="bg-white rounded-4 p-5 shadow-lg">
                        <h4 class="fw-bold mb-4 text-center" style="color: #3E2723;">Stay Updated</h4>
                        <p class="text-muted text-center mb-4">Subscribe to receive impact reports and success stories from the communities we support.</p>
                        <form class="needs-validation" novalidate>
                            <div class="mb-3">
                                <input type="text" class="form-control form-control-lg rounded-pill px-4" placeholder="Your Name" required style="border: 2px solid #e0e0e0;">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control form-control-lg rounded-pill px-4" placeholder="Your Email" required style="border: 2px solid #e0e0e0;">
                            </div>
                            <button type="submit" class="btn btn-lg w-100 rounded-pill fw-bold text-white" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); border: none;">
                                <i class="fas fa-paper-plane me-2"></i>Subscribe to Updates
                            </button>
                        </form>
                        <p class="small text-muted text-center mt-3 mb-0"><i class="fas fa-lock me-1"></i>We respect your privacy. Unsubscribe anytime.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final Call to Action -->
    <section class="impact-cta py-5 text-white" style="background: #3E2723;">
        <div class="container py-5 text-center">
            <span class="badge bg-warning text-dark px-4 py-2 mb-4">Make a Difference Today</span>
            <h2 class="display-4 fw-bold mb-4" style="font-family: 'Nunito', sans-serif;">Ready to Change Lives?</h2>
            <p class="lead mb-5 opacity-75 mx-auto" style="max-width: 800px;">When you book your safari with us, you are not just a traveler; you are a partner in bringing hope and change to Tanzania. Every journey creates a ripple of positive impact.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">
                <a href="{{ route('tours.all') }}" class="btn btn-lg px-5 py-3 rounded-pill fw-bold shadow-lg" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); border: none; color: #3E2723;">
                    <i class="fas fa-suitcase me-2"></i>BOOK A SAFARI
                </a>
                <a href="{{ route('contact') }}" class="btn btn-lg btn-outline-light px-5 py-3 rounded-pill fw-bold">
                    <i class="fas fa-comments me-2"></i>LEARN MORE
                </a>
            </div>
            <div class="row justify-content-center g-4 mt-3">
                <div class="col-6 col-md-3">
                    <div class="text-center">
                        <i class="fas fa-shield-alt fa-2x mb-2 opacity-75"></i>
                        <p class="small mb-0 opacity-75">Transparent Operations</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="text-center">
                        <i class="fas fa-certificate fa-2x mb-2 opacity-75"></i>
                        <p class="small mb-0 opacity-75">Certified NGO Partner</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="text-center">
                        <i class="fas fa-chart-line fa-2x mb-2 opacity-75"></i>
                        <p class="small mb-0 opacity-75">Track Your Impact</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="text-center">
                        <i class="fas fa-heart fa-2x mb-2 opacity-75"></i>
                        <p class="small mb-0 opacity-75">100% Dedicated Team</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(139, 69, 19, 0.15) !important;
        }
        .category-card:hover .icon-box {
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }
        .impact-hero h1 {
            text-shadow: 2px 4px 20px rgba(0,0,0,0.5);
        }
        .gallery-item {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        .gallery-item:hover .gallery-overlay {
            background: linear-gradient(to top, rgba(139,69,19,0.95) 0%, rgba(0,0,0,0.3) 100%) !important;
        }
        .story-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .story-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        }
        .process-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(139, 69, 19, 0.1) !important;
        }
        .process-card:hover .process-number {
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }
        .partner-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .partner-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(139, 69, 19, 0.1) !important;
        }
        .counter-box {
            transition: transform 0.3s ease;
        }
        .counter-box:hover {
            transform: translateY(-5px);
        }
        .scroll-indicator {
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .impact-hero {
                min-height: 70vh !important;
            }
            .impact-hero h1 {
                font-size: 2rem !important;
            }
            .counter-box h2 {
                font-size: 2rem !important;
            }
        }
        /* Form focus styles */
        .form-control:focus {
            border-color: #8B4513 !important;
            box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.15) !important;
        }
        /* Button hover effects */
        .btn:hover {
            transform: translateY(-2px);
        }
    </style>

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS Animation Library
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Animated Counter Function
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    element.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        }

        // Trigger counters when section is visible
        const observerOptions = {
            threshold: 0.5
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('.counter');
                    counters.forEach(counter => {
                        if (!counter.classList.contains('counted')) {
                            animateCounter(counter);
                            counter.classList.add('counted');
                        }
                    });
                }
            });
        }, observerOptions);

        document.addEventListener('DOMContentLoaded', () => {
            const counterSection = document.querySelector('#impact-numbers');
            if (counterSection) {
                observer.observe(counterSection);
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

    @include('partials.footer')
    @include('partials.ai_chatbot')
    @include('partials.general_inquiry_modal')
</body>
</html>
