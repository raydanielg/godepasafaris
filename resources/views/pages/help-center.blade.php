<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Help Center - Go Deep Africa Safari</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    @include('partials.header')
    <div class="container py-5 mt-5">
        <h1 class="display-4 fw-bold text-center mb-5">Help Center</h1>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100">
                    <i class="fas fa-book-open fa-3x text-earth mb-3"></i>
                    <h4>Booking Guide</h4>
                    <p class="text-muted">Learn how to book your dream safari step by step.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100">
                    <i class="fas fa-shield-alt fa-3x text-earth mb-3"></i>
                    <h4>Safety & Insurance</h4>
                    <p class="text-muted">Information about travel insurance and safety protocols.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100">
                    <i class="fas fa-headset fa-3x text-earth mb-3"></i>
                    <h4>Support</h4>
                    <p class="text-muted">Contact our 24/7 support team for immediate assistance.</p>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
    <style>.text-earth { color: #8b4513; }</style>
</body>
</html>
