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

    <!-- Page Header -->
    <section class="page-header-details animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset($package->image) }}');">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('safari') }}" class="text-white">Safari</a></li>
                    <li class="breadcrumb-item active text-white opacity-75" aria-current="page">{{ Str::limit($package->title, 20) }}</li>
                </ol>
            </nav>
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">{{ $package->title }}</h1>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm animate__animated animate__fadeInUp">
                    <div class="mb-5">
                        <h2 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Overview</h2>
                        <p class="lead text-muted">{{ $package->summary }}</p>
                    </div>

                    <div class="itinerary-section mb-5 pt-4 border-top">
                        <h3 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;"><i class="fas fa-map-marked-alt text-primary me-2"></i> Itinerary</h3>
                        <div class="itinerary-steps">
                            @foreach($package->itinerary as $step)
                            <div class="itinerary-item mb-5">
                                <div class="d-flex gap-4">
                                    <div class="day-circle flex-shrink-0">Day {{ $step['day'] }}</div>
                                    <div class="flex-grow-1">
                                        <h5 class="fw-bold mb-3">{{ $step['title'] }}</h5>
                                        @if(isset($step['image']))
                                        <div class="itinerary-img-wrapper mb-3">
                                            <img src="{{ asset($step['image']) }}" class="img-fluid rounded-4 shadow-sm" alt="{{ $step['title'] }}" style="max-height: 250px; width: 100%; object-fit: cover;">
                                        </div>
                                        @endif
                                        <p class="text-muted small mb-0">{{ $step['description'] }}</p>
                                    </div>
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
                            <h4 class="fw-bold mb-3 text-danger"><i class="fas fa-times-circle me-2"></i> Excludes</h4>
                            <ul class="list-unstyled custom-list">
                                @foreach($package->exclusions as $exc)
                                <li class="mb-2 small text-muted"><i class="fas fa-times text-danger me-2"></i>{{ $exc }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- You might also like section -->
                <div class="mt-5 pt-5 border-top">
                    <h3 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">You might also like...</h3>
                    <div class="row g-4">
                        @foreach($relatedPackages as $rp)
                        <div class="col-md-4">
                            <div class="package-card h-100 rounded-4 overflow-hidden border-0 shadow-sm bg-white">
                                <div class="package-img-wrapper" style="height: 180px; position: relative; overflow: hidden;">
                                    <img src="{{ asset($rp->image) }}" class="w-100 h-100 object-fit-cover transition-all" alt="{{ $rp->title }}">
                                    <button class="wishlist-btn position-absolute top-0 end-0 m-3 border-0 bg-white rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                        <i class="far fa-heart text-dark small"></i>
                                    </button>
                                </div>
                                <div class="p-3">
                                    <h6 class="fw-bold mb-3 text-dark" style="font-size: 0.9rem; min-height: 2.5rem;">{{ $rp->title }}</h6>
                                    <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                                        <div class="price-info">
                                            <small class="text-muted d-block" style="font-size: 0.7rem;">from</small>
                                            <span class="fw-bold text-dark">${{ number_format($rp->price, 0) }}</span>
                                            <small class="text-muted" style="font-size: 0.7rem;">Per Person</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-5">
                        <a href="{{ route('safari') }}" class="btn btn-outline-earth rounded-pill px-4 py-2">View all tours</a>
                    </div>
                </div>
            </div>

            <!-- Sidebar: Booking Form -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <div class="booking-card p-4 rounded-4 shadow-lg bg-white border-0 animate__animated animate__fadeInRight">
                        <h4 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Book This Safari</h4>
                        
                        @if(session('success'))
                            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 small">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form id="safariBookingForm" action="{{ route('safari.enquire', $package->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Full Name*</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Email Address*</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Contact Number*</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter contact number" required>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label fw-bold small">Adults*</label>
                                    <input type="number" name="adults" class="form-control" min="1" value="1">
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-bold small">Children</label>
                                    <input type="number" name="children" class="form-control" min="0" value="0">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold small">Your Message*</label>
                                <textarea name="message" class="form-control" rows="3" placeholder="Enter your message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-earth w-100 py-3 fw-bold">SEND MAIL</button>
                        </form>
                    </div>

                    <div class="mt-4 p-4 rounded-4 bg-earth-dark text-white shadow-sm animate__animated animate__fadeInRight animate__delay-1s">
                        <h5 class="fw-bold mb-3">Why booking with Us?</h5>
                        <ul class="list-unstyled small opacity-75">
                            <li class="mb-2"><i class="fas fa-check-circle me-2 text-primary"></i> Free cancellation up to 24 hours</li>
                            <li class="mb-2"><i class="fas fa-check-circle me-2 text-primary"></i> Trusted by 100K+ travelers</li>
                            <li class="mb-2"><i class="fas fa-check-circle me-2 text-primary"></i> Get the lowest prices</li>
                            <li class="mb-0"><i class="fas fa-check-circle me-2 text-primary"></i> 24-hour support</li>
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
