<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', ['title' => 'Camping Safaris - Go Deep Africa Safari'])
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    @include('partials.header')
    
    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?auto=format&fit=crop&w=1920&q=80'); height: 400px; background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; color: white;">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Camping Safaris</h1>
            <p class="lead">Under the African Stars - The Ultimate Adventure.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-4">Embrace the True Spirit of Africa</h2>
                <p>Our Camping Safaris are for those who want to get as close to nature as possible. There is nothing quite like falling asleep to the distant roar of a lion or waking up to the chorus of African birds right outside your tent.</p>
                <img src="https://images.unsplash.com/photo-1537225228614-56cc3556d7ed?auto=format&fit=crop&w=1200&q=80" class="img-fluid rounded-4 mb-4 shadow-sm" alt="Camping Safari">
                <p>We provide all camping equipment, including comfortable tents, sleeping mats, and chairs. Our professional safari chefs travel with you to prepare delicious, fresh meals over the campfire, ensuring you are well-fed after a day of adventure.</p>
            </div>
            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-4 shadow-sm border-top border-4 border-earth">
                    <h5 class="fw-bold mb-3">Camping Safari Highlights</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-2"></i> Close to nature</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-2"></i> Budget-friendly</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-2"></i> Professional safari chef</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-2"></i> Best for adventurers</li>
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
