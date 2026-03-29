<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', ['title' => 'Luxury Safaris - Go Deep Africa Safari'])
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    @include('partials.header')
    
    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1516422213484-21db3332906c?auto=format&fit=crop&w=1920&q=80'); height: 400px; background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; color: white;">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Luxury Safaris</h1>
            <p class="lead">Unparalleled Elegance in the Heart of Africa.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-4">The Pinnacle of African Hospitality</h2>
                <p>Our Luxury Safaris are curated for the discerning traveler who seeks the very best. Stay in world-class tented camps and lodges that redefine luxury, offering private plunge pools, personal butlers, and breathtaking views of the Savannah.</p>
                <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=1200&q=80" class="img-fluid rounded-4 mb-4 shadow-sm" alt="Luxury Safari">
                <p>Experience private game drives in specially equipped vehicles, fly-in safaris to remote corners of the Serengeti, and sundowners in the middle of the wilderness. Every detail is meticulously planned to provide a seamless and unforgettable journey.</p>
            </div>
            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-4 shadow-sm border-top border-4 border-earth">
                    <h5 class="fw-bold mb-3">Luxury Safari Highlights</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3"><i class="fas fa-gem text-earth me-2"></i> Ultra-premium accommodation</li>
                        <li class="mb-3"><i class="fas fa-user-tie text-earth me-2"></i> Private butler & chef</li>
                        <li class="mb-3"><i class="fas fa-plane-departure text-earth me-2"></i> Fly-in options</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-2"></i> Meticulous personalization</li>
                    </ul>
                    <button class="btn btn-earth w-100 rounded-pill mt-3" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">Request Luxury Quote</button>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
    <style>.text-earth { color: #8b4513; } .btn-earth { background: #8b4513; color: white; border: none; }</style>
</body>
</html>
