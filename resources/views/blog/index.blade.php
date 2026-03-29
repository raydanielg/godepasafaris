<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Blog - Go Deep Africa Safari</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header')

    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/images/3-Days-Serengeti-Balloon-Safaris.webp') }}');">
        <div class="container text-center">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">Our Blog</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Expert Insights & Stories from the Heart of Tanzania</p>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container py-5">
            <!-- Category Filter Bar -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <a href="{{ route('blog') }}" class="btn filter-btn {{ !request('category') ? 'active' : '' }}">All Posts</a>
                        @foreach($categories as $cat)
                            <a href="{{ route('blog', ['category' => $cat->category]) }}" class="btn filter-btn {{ request('category') == $cat->category ? 'active' : '' }}">
                                {{ $cat->category }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @foreach($posts as $post)
                <div class="col-md-4 animate__animated animate__fadeInUp">
                    <div class="blog-card card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        <div class="blog-img-wrapper" style="height: 250px; overflow: hidden; position: relative;">
                            <img src="{{ asset($post->image) }}" class="card-img-top h-100 w-100 object-fit-cover transition-all" alt="{{ $post->title }}">
                            <div class="blog-date-badge">{{ $post->created_at->format('M d, Y') }}</div>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <span class="badge bg-earth-light text-primary text-uppercase mb-2" style="width: fit-content;">{{ $post->category }}</span>
                            <h5 class="card-title fw-bold mb-3" style="font-family: 'Playfair Display', serif;">
                                <a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none hover-primary">{{ $post->title }}</a>
                            </h5>
                            <p class="card-text text-muted small mb-4">{{ Str::limit($post->summary, 120) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-link text-primary p-0 fw-bold text-decoration-none small">
                                    READ MORE <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                                <span class="text-muted small"><i class="far fa-eye me-1"></i> {{ $post->views ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

    <style>
        .filter-btn {
            border: 1px solid #8b4513;
            color: #8b4513;
            border-radius: 50px;
            padding: 8px 25px;
            transition: all 0.3s;
            background: white;
            font-weight: 600;
            text-decoration: none;
        }
        .filter-btn:hover, .filter-btn.active {
            background-color: #8b4513;
            color: white !important;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.2);
        }
        .blog-card {
            transition: transform 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-10px);
        }
        .blog-date-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(139, 69, 19, 0.9);
            color: white;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            z-index: 2;
        }
        .text-primary { color: #8b4513 !important; }
        .bg-earth-light { background-color: rgba(139, 69, 19, 0.1) !important; }
    </style>
    @include('partials.footer')
    @include('partials.ai_chatbot')
</body>
</html>
