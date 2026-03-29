<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Privacy Policy - Go Deep Africa Safari</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    @include('partials.header')
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <h1 class="fw-bold mb-4">Privacy Policy</h1>
                    <p class="text-muted">Last updated: March 2026</p>
                    <hr class="my-4 opacity-10">
                    
                    <h4 class="fw-bold text-earth">1. Information We Collect</h4>
                    <p class="text-muted">We collect information you provide directly to us when booking a safari, including your name, email address, phone number, and travel preferences.</p>

                    <h4 class="fw-bold text-earth mt-4">2. How We Use Your Information</h4>
                    <p class="text-muted">We use your information to process your bookings, communicate with you about your trip, and improve our services.</p>

                    <h4 class="fw-bold text-earth mt-4">3. Data Security</h4>
                    <p class="text-muted">We implement appropriate technical and organizational measures to protect the security of your personal information.</p>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
    <style>.text-earth { color: #8b4513; }</style>
</body>
</html>
