<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Safari Packages - Go Deep Africa Safari</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header')

    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/images/3-Days-Serengeti-Balloon-Safaris.webp') }}');">
        <div class="container text-center text-white">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">Safari Packages</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Experience the wild heart of Tanzania</p>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row g-4">
                @foreach($packages as $pkg)
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp">
                    <div class="package-card h-100 rounded-4 overflow-hidden border-0 shadow-sm bg-white">
                        <a href="{{ route('safari.show', $pkg->slug) }}" class="text-decoration-none">
                            <div class="package-img-wrapper" style="height: 250px; position: relative; overflow: hidden;">
                                <img src="{{ asset($pkg->image) }}" class="w-100 h-100 object-fit-cover transition-all" alt="{{ $pkg->title }}">
                                <button class="wishlist-btn position-absolute top-0 end-0 m-3 border-0 bg-white rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                    <i class="far fa-heart text-dark"></i>
                                </button>
                            </div>
                        </a>
                        <div class="card-body p-4 d-flex flex-column">
                            <a href="{{ route('safari.show', $pkg->slug) }}" class="text-decoration-none">
                                <h5 class="fw-bold mb-3 text-dark hover-primary" style="font-family: 'Playfair Display', serif; min-height: 3rem;">{{ $pkg->title }}</h5>
                            </a>
                            <p class="card-text text-muted small mb-4">{{ Str::limit($pkg->summary, 120) }}</p>
                            
                            <hr class="mt-auto mb-3 opacity-10">
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="price-info">
                                    <small class="text-muted d-block">from</small>
                                    <span class="fw-bold fs-4 text-dark">${{ number_format($pkg->price, 0) }}</span>
                                    <small class="text-muted">Per Person</small>
                                </div>
                                <div class="days-badge badge bg-earth-light text-primary px-3 py-2 rounded-pill">
                                    {{ $pkg->days }} Days
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.footer')
    @include('partials.ai_chatbot')
</body>
</html>
