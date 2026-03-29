<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $package->title }} - Go Deep Africa Safari</title>
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
                <span class="text-primary">TripAdvisor Certified</span> Partner
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <section class="page-header-details animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset($package->image) }}');">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kilimanjaro') }}" class="text-white">Kilimanjaro</a></li>
                    <li class="breadcrumb-item active text-white opacity-75" aria-current="page">{{ strtolower($package->route_name) }}</li>
                </ol>
            </nav>
            <h1 class="display-3 fw-bold animate__animated animate__fadeInUp">{{ $package->title }}</h1>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm animate__animated animate__fadeInUp">
                    <div class="mb-5">
                        <h2 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Expedition Overview</h2>
                        <div class="rich-content-area text-dark">
                            {!! $package->rich_content !!}
                        </div>
                    </div>

                    <div class="itinerary-section mb-5 pt-4 border-top">
                        <h3 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;"><i class="fas fa-mountain text-primary me-2"></i> Climbing Itinerary</h3>
                        <div class="itinerary-steps">
                            @foreach($package->itinerary as $step)
                            <div class="itinerary-item d-flex gap-4 mb-4">
                                <div class="day-circle flex-shrink-0">Day {{ $step['day'] }}</div>
                                <div>
                                    <h5 class="fw-bold mb-2">{{ $step['title'] }}</h5>
                                    <p class="text-muted small mb-0">{{ $step['description'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row g-4 mt-4 pt-4 border-top">
                        <div class="col-md-6">
                            <h4 class="fw-bold mb-3 text-primary"><i class="fas fa-check-circle me-2"></i> Includes</h4>
                            <ul class="list-unstyled custom-list">
                                @foreach($package->inclusions as $inc)
                                <li class="mb-2 small text-muted"><i class="fas fa-check text-success me-2"></i>{{ $inc }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4 class="fw-bold mb-3 text-danger"><i class="fas fa-times-circle me-2"></i> Not Included</h4>
                            <ul class="list-unstyled custom-list">
                                @foreach($package->exclusions as $exc)
                                <li class="mb-2 small text-muted"><i class="fas fa-times text-danger me-2"></i>{{ $exc }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar: Booking Form -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <div class="booking-card p-4 rounded-4 shadow-lg bg-white border-0 animate__animated animate__fadeInRight">
                        <h4 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Enquire This Trek</h4>
                        <form id="trekBookingForm">
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Full Name*</label>
                                <input type="text" class="form-control" placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Email Address*</label>
                                <input type="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Contact Number*</label>
                                <input type="text" class="form-control" placeholder="Enter contact number" required>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label fw-bold small">Adults*</label>
                                    <input type="number" class="form-control" min="1" value="1">
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-bold small">Children</label>
                                    <input type="number" class="form-control" min="0" value="0">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold small">Message*</label>
                                <textarea class="form-control" rows="3" placeholder="Additional requirements..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-earth w-100 py-3 fw-bold">SEND MAIL</button>
                        </form>
                    </div>

                    <div class="mt-4 p-4 rounded-4 bg-earth-dark text-white shadow-sm animate__animated animate__fadeInRight animate__delay-1s">
                        <h5 class="fw-bold mb-3">Why Kilimanjaro with Us?</h5>
                        <ul class="list-unstyled small opacity-75">
                            <li class="mb-2"><i class="fas fa-check-circle me-2 text-primary"></i> 98% Summit Success Rate</li>
                            <li class="mb-2"><i class="fas fa-check-circle me-2 text-primary"></i> Oxygen & Medical Kits Included</li>
                            <li class="mb-2"><i class="fas fa-check-circle me-2 text-primary"></i> Expert Local Guides & Porters</li>
                            <li class="mb-0"><i class="fas fa-check-circle me-2 text-primary"></i> Private Portable Toilets Available</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.whatsapp')
</body>
</html>
