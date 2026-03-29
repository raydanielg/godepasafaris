<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog - Go Deep Africa Safari</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header')

    <!-- Page Header -->
    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/images/3-Days-Serengeti-Balloon-Safaris.webp') }}');">
        <div class="container">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">Our Blog</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                    <li class="breadcrumb-item active text-white opacity-75" aria-current="page">Blog</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Blog List -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row g-4">
                @php
                    $blogs = [
                        [
                            'title' => 'Nairobi Safari Day Trips: The Best Wildlife Experiences Near Kenya\'s Capital',
                            'category' => 'Guide',
                            'image' => 'images/images/4GyurGeCrKkxo9FvCd8bnc-1000-80.jpg',
                            'delay' => '0s'
                        ],
                        [
                            'title' => '10 Essential Tips for Your First Serengeti Safari Expedition',
                            'category' => 'Tips',
                            'image' => 'images/images/3-Days-Serengeti-Balloon-Safaris.webp',
                            'delay' => '0.2s'
                        ],
                        [
                            'title' => 'What to Pack for Kilimanjaro: A Comprehensive Gear Guide',
                            'category' => 'Trekking',
                            'image' => 'images/images/4-Kilimanjaro-Jane-at-summit-SC_JW.jpg',
                            'delay' => '0.4s'
                        ],
                        [
                            'title' => 'Discovering the Hidden Gems of Ngorongoro Crater',
                            'category' => 'Safari',
                            'image' => 'images/images/4GyurGeCrKkxo9FvCd8bnc-1000-80.jpg',
                            'delay' => '0.6s'
                        ],
                        [
                            'title' => 'The Ultimate Guide to Zanzibar Beach Holidays',
                            'category' => 'Beach',
                            'image' => 'images/images/3-Days-Serengeti-Balloon-Safaris.webp',
                            'delay' => '0.8s'
                        ],
                        [
                            'title' => 'Tarangire National Park: The Land of Giants',
                            'category' => 'Safari',
                            'image' => 'images/images/4GyurGeCrKkxo9FvCd8bnc-1000-80.jpg',
                            'delay' => '1s'
                        ]
                    ];
                @endphp

                @foreach($blogs as $blog)
                <div class="col-md-4 col-sm-6 animate__animated animate__fadeInUp" style="animation-delay: {{ $blog['delay'] }};">
                    <div class="blog-card card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        <div class="blog-img-wrapper" style="height: 220px; overflow: hidden;">
                            <img src="{{ asset($blog['image']) }}" class="card-img-top h-100 w-100 object-fit-cover" alt="{{ $blog['title'] }}">
                        </div>
                        <div class="card-body p-4">
                            <span class="badge bg-earth-light text-primary text-uppercase mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">{{ $blog['category'] }}</span>
                            <h5 class="card-title fw-bold" style="font-family: 'Playfair Display', serif;">{{ $blog['title'] }}</h5>
                            <p class="card-text text-muted small">Explore the breathtaking beauty of Tanzania's wildlife and landscapes with our expert guides...</p>
                            <a href="#" class="btn btn-link text-primary p-0 fw-bold text-decoration-none small">READ MORE <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination Placeholder -->
            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><span class="page-link rounded-circle mx-1 border-0 shadow-sm">Prev</span></li>
                    <li class="page-item active"><a class="page-link rounded-circle mx-1 border-0 shadow-sm" href="#">1</a></li>
                    <li class="page-item"><a class="page-link rounded-circle mx-1 border-0 shadow-sm" href="#">2</a></li>
                    <li class="page-item"><a class="page-link rounded-circle mx-1 border-0 shadow-sm" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </section>

    @include('partials.footer')
    @include('partials.ai_chatbot')
</body>
</html>
