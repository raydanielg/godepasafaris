<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guest Testimonials - Go Deep Africa Safari</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .testimonial-card { transition: all 0.3s ease; }
        .testimonial-card:hover { transform: translateY(-5px); }
        .text-earth { color: #8b4513; }
        .bg-earth { background-color: #8b4513 !important; }
    </style>
</head>
<body class="bg-light">
    @include('partials.header')
    <div class="container py-5 mt-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">Guest Testimonials</h1>
            <p class="text-muted">What our climbers and safari guests say about their experiences.</p>
        </div>
        
        <div class="row g-4">
            @foreach($testimonials as $t)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 testimonial-card">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ $t['image'] }}" class="rounded-circle shadow-sm" width="60" height="60" alt="{{ $t['name'] }}">
                        <div>
                            <h5 class="fw-bold mb-0">{{ $t['name'] }}</h5>
                            <small class="text-muted">{{ $t['location'] }}</small>
                        </div>
                    </div>
                    <div class="text-warning mb-3">
                        @for($i=0; $i<$t['rating']; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                    </div>
                    <p class="text-muted italic">"{{ $t['content'] }}"</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <h3 class="fw-bold mb-4">Ready to Write Your Own Story?</h3>
            <button class="btn btn-earth rounded-pill px-5 py-3 fw-bold text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                PLAN YOUR ADVENTURE NOW
            </button>
        </div>
    </div>
    @include('partials.footer')
    @include('partials.general_inquiry_modal')
</body>
</html>
