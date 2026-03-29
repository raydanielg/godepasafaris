<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How It Works - Go Deep Africa Safari</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .step-number { width: 50px; height: 50px; background: #8b4513; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.5rem; margin-bottom: 1.5rem; }
        .text-earth { color: #8b4513; }
    </style>
</head>
<body class="bg-light">
    @include('partials.header')
    <div class="container py-5 mt-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">How It Works</h1>
            <p class="text-muted">Your journey from dream to destination in 4 simple steps.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">
                    <div class="step-number mx-auto">1</div>
                    <h4 class="fw-bold">Explore & Choose</h4>
                    <p class="text-muted small">Browse our curated safari and trekking packages to find your perfect adventure.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">
                    <div class="step-number mx-auto">2</div>
                    <h4 class="fw-bold">Send Inquiry</h4>
                    <p class="text-muted small">Fill out our quick inquiry form or chat with us on WhatsApp to discuss your details.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">
                    <div class="step-number mx-auto">3</div>
                    <h4 class="fw-bold">Customize & Confirm</h4>
                    <p class="text-muted small">Our experts will tailor the itinerary to your needs. Once happy, confirm with a deposit.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">
                    <div class="step-number mx-auto">4</div>
                    <h4 class="fw-bold">Start Adventure</h4>
                    <p class="text-muted small">Pack your bags! We'll meet you at the airport and start your once-in-a-lifetime experience.</p>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
</body>
</html>
