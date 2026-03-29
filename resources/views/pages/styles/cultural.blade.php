<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', ['title' => 'Cultural Safaris - Go Deep Africa Safari'])
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
    
    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1489392191049-fc10c97e64b6?auto=format&fit=crop&w=1920&q=80'); height: 450px; background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; color: white;">
        <div class="container text-center">
            <h1 class="display-3 fw-bold animate__animated animate__fadeInUp">Cultural Safaris</h1>
            <p class="lead fs-4 animate__animated animate__fadeInUp animate__delay-1s">Connect with the Heartbeat of Tanzania</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Beyond the Wildlife</h2>
                <p class="lead text-muted">Our Cultural Safaris offer a profound opportunity to engage with the diverse people who make Tanzania so special. From the iconic Maasai warriors to the ancient Hadzabe hunter-gatherers, we facilitate respectful and authentic encounters.</p>
                <p>Learn about traditional customs, ancient wisdom, and modern-day life in the villages. Whether it's participating in a traditional dance, learning how to make beadwork, or visiting a local school, these moments provide a deeper understanding of the human spirit in Africa.</p>
                <div class="d-flex gap-3 mt-4">
                    <button class="btn btn-earth rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">PLAN YOUR CULTURAL JOURNEY</button>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1523805081446-ed9a7c8d1fa0?auto=format&fit=crop&w=1200&q=80" class="img-fluid rounded-4 shadow-lg" alt="Cultural Safari">
            </div>
        </div>

        <div class="row g-4 mt-5 text-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <i class="fas fa-users fa-3x text-earth mb-3"></i>
                    <h4 class="fw-bold">Authentic Interactions</h4>
                    <p class="text-muted small">Meaningful visits to local communities that avoid the commercialized "tourist traps".</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <i class="fas fa-home fa-3x text-earth mb-3"></i>
                    <h4 class="fw-bold">Village Life</h4>
                    <p class="text-muted small">Experience the rhythms of daily life, from cooking traditional meals to farming techniques.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <i class="fas fa-hands-helping fa-3x text-earth mb-3"></i>
                    <h4 class="fw-bold">Support Local</h4>
                    <p class="text-muted small">A portion of your tour directly benefits the community projects and schools we visit.</p>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
</body>
</html>
