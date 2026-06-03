<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kilimanjaro Articles - Go Deep Africa Safari</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header')

    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/images/4-Kilimanjaro-Jane-at-summit-SC_JW.jpg') }}');">
        <div class="container text-center text-white">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">Helpful Articles</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Tips & insights for your Kilimanjaro adventure</p>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #8B4513;">How to Prepare for Kilimanjaro</h5>
                            <p class="text-muted mb-3">Essential training tips and preparation guide</p>
                            <a href="#" class="btn btn-sm btn-outline-earth rounded-pill">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #8B4513;">Altitude Sickness Prevention</h5>
                            <p class="text-muted mb-3">How to avoid and manage altitude sickness</p>
                            <a href="#" class="btn btn-sm btn-outline-earth rounded-pill">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #8B4513;">Best Time to Climb Kilimanjaro</h5>
                            <p class="text-muted mb-3">Seasonal guide for optimal climbing conditions</p>
                            <a href="#" class="btn btn-sm btn-outline-earth rounded-pill">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #8B4513;">What to Expect on Summit Day</h5>
                            <p class="text-muted mb-3">A detailed guide to the final ascent</p>
                            <a href="#" class="btn btn-sm btn-outline-earth rounded-pill">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #8B4513;">Packing Tips for Kilimanjaro</h5>
                            <p class="text-muted mb-3">How to pack efficiently for your climb</p>
                            <a href="#" class="btn btn-sm btn-outline-earth rounded-pill">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #8B4513;">Kilimanjaro Photography Guide</h5>
                            <p class="text-muted mb-3">Capture your adventure with stunning photos</p>
                            <a href="#" class="btn btn-sm btn-outline-earth rounded-pill">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
    @include('partials.ai_chatbot')
</body>
</html>
