<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kilimanjaro Routes - Go Deep Africa Safari</title>
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
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">Kilimanjaro Routes</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Compare all routes to find your perfect climb</p>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #8B4513;">Machame Route</h5>
                            <p class="text-muted mb-3">The Whiskey Route - 6-7 days, scenic and popular</p>
                            <ul class="list-unstyled small">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 93% success rate</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Scenic views</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i> Good acclimatization</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #8B4513;">Marangu Route</h5>
                            <p class="text-muted mb-3">The Coca-Cola Route - 5-6 days, easiest path</p>
                            <ul class="list-unstyled small">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Hut accommodation</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Easiest climb</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i> Most popular</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #8B4513;">Lemosho Route</h5>
                            <p class="text-muted mb-3">The most scenic route - 7-8 days, remote</p>
                            <ul class="list-unstyled small">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Best scenery</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Low traffic</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i> Excellent acclimatization</li>
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
