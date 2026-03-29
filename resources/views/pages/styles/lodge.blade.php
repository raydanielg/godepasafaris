<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', ['title' => 'Lodge Safaris - Go Deep Africa Safari'])
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    @include('partials.header')
    
    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=1920&q=80'); height: 400px; background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; color: white;">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Lodge Safaris</h1>
            <p class="lead">Comfort and wildlife in perfect harmony.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-4">Authentic Comfort in the Wild</h2>
                <p>Our Lodge Safaris are designed for those who want to experience the thrill of the African bush without sacrificing the comforts of home. We carefully select lodges that offer exceptional service, stunning views, and a deep connection to their surroundings.</p>
                <img src="https://images.unsplash.com/photo-1493246507139-91e8fad9978e?auto=format&fit=crop&w=1200&q=80" class="img-fluid rounded-4 mb-4 shadow-sm" alt="Safari Lodge">
                <p>From the rim of the Ngorongoro Crater to the heart of the Serengeti, our lodge partners provide private ensuite bathrooms, gourmet dining, and often, refreshing swimming pools to enjoy after a day of game drives.</p>
            </div>
            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-4 shadow-sm border-top border-4 border-earth">
                    <h5 class="fw-bold mb-3">Lodge Safari Highlights</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-2"></i> Permanent structures</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-2"></i> Ensuite facilities</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-2"></i> Fine dining experiences</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-2"></i> Best for families & couples</li>
                    </ul>
                    <button class="btn btn-earth w-100 rounded-pill mt-3" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">Enquire Now</button>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
    <style>.text-earth { color: #8b4513; } .btn-earth { background: #8b4513; color: white; border: none; }</style>
</body>
</html>
