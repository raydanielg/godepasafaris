<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', ['title' => 'Walking Safaris - Go Deep Africa Safari'])
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
            <h1 class="display-3 fw-bold animate__animated animate__fadeInUp">Walking Safaris</h1>
            <p class="lead fs-4 animate__animated animate__fadeInUp animate__delay-1s">A Footprint in the Wild - Experience Africa Up Close</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">The Most Intimate Way to Explore</h2>
                <p class="lead text-muted">A Walking Safari is the ultimate way to connect with the African bush. Away from the hum of the engine, your senses sharpen. You smell the wild jasmine, hear the crunch of dry grass underfoot, and notice the intricate details usually missed from a vehicle.</p>
                <p>Guided by an armed ranger and an expert tracker, you'll learn to read tracks, identify bird calls, and understand the medicinal uses of local plants. It's not about the distance covered, but the depth of the connection you form with the ecosystem.</p>
                <div class="d-flex gap-3 mt-4">
                    <button class="btn btn-earth rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">BOOK A WALKING TOUR</button>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1516422213484-21db3332906c?auto=format&fit=crop&w=1200&q=80" class="img-fluid rounded-4 shadow-lg" alt="Walking Safari">
            </div>
        </div>

        <div class="row g-4 mt-5 text-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <i class="fas fa-shoe-prints fa-3x text-earth mb-3"></i>
                    <h4 class="fw-bold">Expert Trackers</h4>
                    <p class="text-muted small">Learn the ancient art of tracking animals through their prints and signs.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <i class="fas fa-shield-alt fa-3x text-earth mb-3"></i>
                    <h4 class="fw-bold">Safety First</h4>
                    <p class="text-muted small">All walks are accompanied by experienced armed rangers for your total security.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <i class="fas fa-feather-alt fa-3x text-earth mb-3"></i>
                    <h4 class="fw-bold">Intimate Discovery</h4>
                    <p class="text-muted small">Focus on the "small five", birds, and the fascinating world of African insects.</p>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
</body>
</html>
