<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', [
        'seoTitle' => 'Guest Reviews of Our Tanzania Safaris',
        'seoDescription' => 'Read what travellers say about their Tanzania safaris and Kilimanjaro climbs with Go Deep Africa Safari, a locally owned operator based in Arusha.',
        'seoKeywords' => 'Go Deep Africa Safari reviews, Tanzania safari reviews, Kilimanjaro trek reviews',
    ])
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
            @forelse($testimonials as $t)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 testimonial-card">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        @if($t->image_url)
                            <img src="{{ $t->image_url }}" class="rounded-circle shadow-sm" width="60" height="60" style="object-fit:cover;" alt="{{ $t->name }}" loading="lazy" decoding="async">
                        @else
                            <div class="rounded-circle shadow-sm d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0"
                                 style="width:60px; height:60px; background:#8B4513; font-size:1.25rem;" aria-hidden="true">{{ $t->initial }}</div>
                        @endif
                        <div>
                            <h5 class="fw-bold mb-0">{{ $t->name }}</h5>
                            <small class="text-muted">{{ $t->location }}</small>
                        </div>
                    </div>
                    <div class="text-warning mb-3">
                        @for($i=0; $i<$t->stars; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                    </div>
                    <p class="text-muted italic">"{{ $t->content }}"</p>
                    @if($t->trip)
                    <p class="small text-muted mb-0 mt-2 pt-2 border-top">
                        <i class="fas fa-map-marker-alt me-1" style="color:#8B4513;"></i>{{ $t->trip }}@if($t->travelled_on) &middot; {{ $t->travelled_on->format('F Y') }}@endif
                    </p>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-quote-left fa-3x mb-3 opacity-25" style="color:#8B4513;"></i>
                    <h4 class="fw-bold" style="color:#3E2723;">Our first reviews are on their way</h4>
                    <p class="text-muted mb-0">We only publish feedback from guests who have actually travelled with us,<br class="d-none d-md-inline">
                    and only with their permission. Check back soon.</p>
                </div>
            </div>
            @endforelse
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
