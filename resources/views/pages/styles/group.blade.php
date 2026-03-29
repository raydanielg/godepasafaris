<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', ['title' => 'Group Joining Safaris - Go Deep Africa Safari'])
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    @include('partials.header')
    
    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1516422213484-21db3332906c?auto=format&fit=crop&w=1920&q=80'); height: 400px; background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; color: white;">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Group Joining Safaris</h1>
            <p class="lead">Shared Adventures, Shared Memories.</p>
        </div>
    </section>

    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="coming-soon-card p-5 bg-white rounded-4 shadow-sm">
                    <i class="fas fa-users-cog fa-4x text-earth mb-4"></i>
                    <h2 class="fw-bold mb-3">Feature Coming Soon</h2>
                    <p class="text-muted lead mb-4">We are currently curating our 2026 group joining schedules. This feature will allow solo travelers and budget-conscious groups to share the cost of a safari vehicle while meeting like-minded adventurers from around the world.</p>
                    
                    <div class="alert bg-earth-light text-earth rounded-4 border-0 mb-4">
                        <i class="fas fa-info-circle me-2"></i> Want to be notified? Send us a quick inquiry!
                    </div>

                    <button class="btn btn-earth rounded-pill px-5 py-3 fw-bold" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">GET NOTIFIED</button>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
    <style>
        .text-earth { color: #8b4513; }
        .bg-earth-light { background-color: rgba(139, 69, 19, 0.1); }
        .btn-earth { background: #8b4513; color: white; border: none; }
        .btn-earth:hover { background: #a0522d; color: white; }
    </style>
</body>
</html>
