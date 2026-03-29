<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $destination->title }} - Go Deep Africa Safari</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    @include('partials.header')

    <!-- Top Rating Bar -->
    <div class="rating-top-bar py-2 bg-white border-bottom animate__animated animate__fadeInDown">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <div class="stars text-warning small">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <span class="small fw-bold">Rated 5 stars out of 5</span>
            </div>
            <div class="small fw-bold">
                <span class="text-primary">{{ $destination->tripadvisor_reviews }}+</span> Reviews on TripAdvisor
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <section class="page-header-details animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset($destination->image) }}');">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('destinations') }}" class="text-white">Destinations</a></li>
                    <li class="breadcrumb-item active text-white opacity-75" aria-current="page">{{ strtolower($destination->title) }}</li>
                </ol>
            </nav>
            <h1 class="display-3 fw-bold animate__animated animate__fadeInUp">{{ $destination->title }}</h1>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <!-- Left Sidebar: Table of Contents -->
            <div class="col-lg-3 d-none d-lg-block">
                <div class="sticky-top" style="top: 100px;">
                    <div class="toc-card p-4 rounded-4 shadow-sm bg-white animate__animated animate__fadeInLeft">
                        <h5 class="fw-bold mb-4 border-bottom pb-2">Table Of Contents</h5>
                        <ul class="list-unstyled toc-list">
                            <li class="active"><a href="#about" class="active">{{ $destination->title }}</a></li>
                            <li><a href="#weather">Weather & Climate</a></li>
                            <li><a href="#faq">Frequently Asked Questions</a></li>
                            <li><a href="#tours">Suggested Tours</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm animate__animated animate__fadeInUp">
                    <!-- Quick Info -->
                    <div class="row g-4 mb-5 pb-4 border-bottom">
                        <div class="col-md-4 text-center border-end">
                            <div class="text-muted small text-uppercase fw-bold mb-1">Rate</div>
                            <div class="fw-bold text-primary">{{ $destination->rate_range }}</div>
                        </div>
                        <div class="col-md-4 text-center border-end">
                            <div class="text-muted small text-uppercase fw-bold mb-1">Best time</div>
                            <div class="fw-bold text-primary">{{ $destination->best_time }}</div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="text-muted small text-uppercase fw-bold mb-1">High season</div>
                            <div class="fw-bold text-primary">{{ $destination->high_season }}</div>
                        </div>
                    </div>

                    <div id="about" class="rich-content-area mb-5 animate__animated animate__fadeIn">
                        <h2 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">{{ $destination->title }}</h2>
                        {!! $destination->rich_content !!}
                    </div>

                    <div id="weather" class="mb-5 pt-4 border-top">
                        <h3 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;"><i class="fas fa-cloud-sun text-primary me-2"></i> Weather & Climate</h3>
                        <p class="text-muted">{{ $destination->weather_info }}</p>
                    </div>

                    <div id="faq" class="mb-5 pt-4 border-top">
                        <h3 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;"><i class="fas fa-question-circle text-primary me-2"></i> Frequently Asked Questions</h3>
                        <div class="accordion accordion-flush" id="destFaq">
                            @foreach($destination->faqs as $index => $faq)
                            <div class="accordion-item border rounded-3 mb-3 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold {{ $index == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $index }}">
                                        {{ $faq['question'] }}
                                    </button>
                                </h2>
                                <div id="faq{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" data-bs-parent="#destFaq">
                                    <div class="accordion-body">
                                        {{ $faq['answer'] }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="tours" class="pt-4 border-top">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif;">Suggested {{ $destination->title }} Tours</h3>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">View All <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                        <div class="row g-4">
                            @foreach($relatedTours as $tour)
                            <div class="col-md-6">
                                <div class="tour-card-mini rounded-4 shadow-sm overflow-hidden bg-white border h-100">
                                    <img src="{{ asset($tour->image) }}" class="w-100 object-fit-cover" height="180" alt="{{ $tour->title }}">
                                    <div class="p-3">
                                        <div class="stars text-warning small mb-2">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </div>
                                        <h6 class="fw-bold mb-2">{{ $tour->title }}</h6>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div class="text-primary fw-bold">$ 2,370 <small class="text-muted fw-normal">pp</small></div>
                                            <small class="text-muted"><i class="far fa-clock me-1"></i> 9 Days</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-earth:hover { color: #8B4513 !important; }
        .text-earth { color: #8b4513 !important; }
        .bg-earth { background-color: #8b4513 !important; }
        .btn-earth { background-color: #8b4513 !important; border-color: #8b4513 !important; color: white !important; }
        .btn-earth:hover { background-color: #a0522d !important; border-color: #a0522d !important; }
        .rating-top-bar .text-primary { color: #8b4513 !important; }
        .toc-list li.active a, .toc-list li a:hover { color: #8b4513 !important; border-left-color: #8b4513 !important; }
        .rich-content-area h2, .rich-content-area h3 { color: #3E2723; }
        .accordion-button:not(.collapsed) { background-color: #fdfaf5; color: #8b4513; }
        .text-primary { color: #8b4513 !important; }
    </style>
    @include('partials.footer')
    @include('partials.whatsapp')
</body>
</html>
