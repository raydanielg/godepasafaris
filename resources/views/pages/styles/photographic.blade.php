<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', ['title' => 'Photographic Safaris - Go Deep Africa Safari'])
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .bg-earth { background-color: #8b4513 !important; }
        .text-earth { color: #8b4513 !important; }
        .btn-earth { background-color: #8b4513 !important; border-color: #8b4513 !important; color: white !important; }
        .btn-earth:hover { background-color: #a0522d !important; border-color: #a0522d !important; }
    </style>
</head>
<body class="bg-light">
    @include('partials.header')
    
    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=1920&q=80'); height: 450px; background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; color: white;">
        <div class="container text-center">
            <h1 class="display-3 fw-bold animate__animated animate__fadeInUp">Photographic Safaris</h1>
            <p class="lead fs-4 animate__animated animate__fadeInUp animate__delay-1s">Capture the Untamed Beauty of Africa</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Focus on the Perfect Shot</h2>
                <p class="lead text-muted">Our Photographic Safaris are specialized journeys designed for both amateur and professional photographers. We provide the patience, expertise, and equipment necessary to capture Africa's wildlife in its most stunning moments.</p>
                <p>We use specially modified 4x4 vehicles with 360-degree views and lower mounts for the perfect angle. Our guides are trained to position the vehicle according to the light and animal behavior, ensuring you never miss a beat.</p>
                <div class="d-flex gap-3 mt-4">
                    <button class="btn btn-earth rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">PLAN YOUR SHOOT</button>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1516422213484-21db3332906c?auto=format&fit=crop&w=1200&q=80" class="img-fluid rounded-4 shadow-lg" alt="Photography Safari">
            </div>
        </div>

        <div class="row g-4 mt-5 text-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <i class="fas fa-camera-retro fa-3x text-earth mb-3"></i>
                    <h4 class="fw-bold">Modified Vehicles</h4>
                    <p class="text-muted small">Equipped with beanbags, charging points, and unobstructed views for heavy lenses.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <i class="fas fa-sun fa-3x text-earth mb-3"></i>
                    <h4 class="fw-bold">Golden Hour Focus</h4>
                    <p class="text-muted small">Extended time in the field during the best light conditions at sunrise and sunset.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <i class="fas fa-user-edit fa-3x text-earth mb-3"></i>
                    <h4 class="fw-bold">Expert Positioning</h4>
                    <p class="text-muted small">Guides who understand light, composition, and animal anticipation.</p>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
</body>
</html>
