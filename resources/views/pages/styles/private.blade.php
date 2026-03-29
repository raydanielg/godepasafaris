<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', ['title' => 'Private Safaris - Go Deep Africa Safari'])
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    @include('partials.header')
    
    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1516422213484-21db3332906c?auto=format&fit=crop&w=1920&q=80'); height: 400px; background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; color: white;">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Private Safaris</h1>
            <p class="lead">Your Own Exclusive African Journey.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-4">Tailored Exclusively for You</h2>
                <p>A Private Safari with Go Deep Africa means complete flexibility and personalized attention. You will have your own expert guide and a private 4x4 safari vehicle, allowing you to set your own pace and focus on the wildlife and landscapes that interest you most.</p>
                <img src="https://images.unsplash.com/photo-1534469612762-db2e19e138c7?auto=format&fit=crop&w=1200&q=80" class="img-fluid rounded-4 mb-4 shadow-sm" alt="Private Safari Vehicle">
                <p>Whether you want to spend hours photographing a single lion pride or move quickly to find the next migration crossing, the choice is yours. Perfect for families, honeymooners, or small groups of friends seeking an intimate experience.</p>
            </div>
            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-4 shadow-sm border-top border-4 border-earth">
                    <h5 class="fw-bold mb-3">Private Safari Highlights</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3"><i class="fas fa-car text-earth me-2"></i> Private 4x4 vehicle</li>
                        <li class="mb-3"><i class="fas fa-user-friends text-earth me-2"></i> Dedicated expert guide</li>
                        <li class="mb-3"><i class="fas fa-clock text-earth me-2"></i> Flexible daily schedule</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-2"></i> 100% custom itinerary</li>
                    </ul>
                    <button class="btn btn-earth w-100 rounded-pill mt-3" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">Design Your Trip</button>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
    <style>.text-earth { color: #8b4513; } .btn-earth { background: #8b4513; color: white; border: none; }</style>
</body>
</html>
