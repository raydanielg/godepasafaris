<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terms of Service - Go Deep Africa Safari</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    @include('partials.header')
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <h1 class="fw-bold mb-4">Terms of Service</h1>
                    <p class="text-muted">Last updated: March 2026</p>
                    <hr class="my-4 opacity-10">
                    
                    <h4 class="fw-bold text-earth">1. Booking and Payments</h4>
                    <p class="text-muted">A deposit is required to confirm your booking. The remaining balance is typically due 30-60 days before the start of your safari or trek.</p>

                    <h4 class="fw-bold text-earth mt-4">2. Cancellation Policy</h4>
                    <p class="text-muted">Cancellations made more than 60 days before departure may be eligible for a partial refund. Within 30 days, payments are generally non-refundable.</p>

                    <h4 class="fw-bold text-earth mt-4">3. Liability</h4>
                    <p class="text-muted">Go Deep Africa Safari is not liable for personal injury, property damage, or loss of life during expeditions. Travel insurance is mandatory.</p>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
    <style>.text-earth { color: #8b4513; }</style>
</body>
</html>
