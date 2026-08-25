<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', [
        'seoTitle' => 'LGBTQ+ Safaris in Tanzania | Private, Welcoming Trips for Gay & Lesbian Travellers | Go Deep Africa',
        'seoDescription' => 'Discreet, welcoming Tanzania safaris designed for LGBTQ+ travellers. Private tours, hand-picked accommodations and trusted local guides for a safe, judgment-free adventure with Go Deep Africa Safari.',
    ])
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

    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1920&q=80'); height: 450px; background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; color: white;">
        <div class="container text-center">
            <h1 class="display-3 fw-bold animate__animated animate__fadeInUp">LGBTQ+ Safaris in Tanzania</h1>
            <p class="lead fs-4 animate__animated animate__fadeInUp animate__delay-1s">Private, Welcoming Adventures for Every Traveller</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4" style="font-family: 'Nunito', sans-serif;">Everyone Deserves the Trip of a Lifetime</h2>
                <p class="lead text-muted">Go Deep Africa Safari warmly welcomes LGBTQ+ travellers — gay, lesbian, bisexual, trans and the whole community. Whether you're planning a honeymoon in the Serengeti, an anniversary trip to Ngorongoro, or an adventure with friends, we design private, tailor-made safaris built entirely around you.</p>
                <p>Tanzania is a conservative destination, so we plan every detail with care and discretion. You travel in your own private vehicle with an experienced local guide, stay at welcoming lodges and camps we know and trust, and are looked after by a team that treats every guest with respect and zero judgment. Our focus is simple: your comfort, your privacy and your safety, so you can relax and enjoy the wild.</p>
                <div class="d-flex gap-3 mt-4">
                    <button class="btn btn-earth rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">PLAN YOUR PRIVATE SAFARI</button>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=1200&q=80" class="img-fluid rounded-4 shadow-lg" alt="Private LGBTQ-friendly Tanzania safari with a welcoming local guide">
            </div>
        </div>

        <div class="row g-4 mt-5 text-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <i class="fas fa-heart fa-3x text-earth mb-3"></i>
                    <h4 class="fw-bold">Private &amp; Tailor-Made</h4>
                    <p class="text-muted small">Your own vehicle, guide and itinerary — a safari planned around you and the people you love, at your own pace.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <i class="fas fa-bed fa-3x text-earth mb-3"></i>
                    <h4 class="fw-bold">Hand-Picked, Welcoming Stays</h4>
                    <p class="text-muted small">We book camps and lodges we know to be friendly and professional, so you feel at ease from arrival to departure.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <i class="fas fa-shield-heart fa-3x text-earth mb-3"></i>
                    <h4 class="fw-bold">Discreet &amp; Safe</h4>
                    <p class="text-muted small">Experienced local guides who prioritise your privacy, comfort and safety at every step of the journey.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5 pt-4">
            <h3 class="fw-bold mb-3" style="font-family: 'Nunito', sans-serif;">Ready to Plan Your Safari?</h3>
            <p class="text-muted mb-4 mx-auto" style="max-width: 640px;">Tell us your dates, who's travelling and what you'd love to see. We'll craft a private LGBTQ+ friendly Tanzania safari — from the Serengeti and Ngorongoro Crater to the beaches of Zanzibar — and answer any questions about travelling comfortably and safely.</p>
            <button class="btn btn-earth rounded-pill px-5 py-3 fw-bold" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">GET A FREE CUSTOM QUOTE</button>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
</body>
</html>
