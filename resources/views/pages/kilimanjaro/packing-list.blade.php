<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Packing List - Go Deep Africa Safari</title>
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
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">Packing List</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Essential gear guide for your Kilimanjaro climb</p>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-6 animate__animated animate__fadeInUp">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #8B4513;"><i class="fas fa-tshirt me-2"></i>Clothing</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Waterproof jacket</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Thermal layers</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Hiking pants</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Warm gloves</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i> Warm hat</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #8B4513;"><i class="fas fa-hiking me-2"></i>Equipment</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Hiking boots</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Sleeping bag (-20°C)</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Trekking poles</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Headlamp</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i> Daypack</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #8B4513;"><i class="fas fa-tint me-2"></i>Hydration & Nutrition</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Water bottles (2L)</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Water purification tablets</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Energy snacks</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i> Electrolyte supplements</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #8B4513;"><i class="fas fa-first-aid me-2"></i>Health & Safety</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> First aid kit</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Sunscreen (SPF 50+)</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Sunglasses</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i> Altitude medication</li>
                            </ul>
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
