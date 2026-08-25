<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', [
        'seoTitle' => 'Tanzania Safari & Kilimanjaro Blog: Guides, Tips & Stories | Go Deep Africa',
        'seoDescription' => 'Expert guides on Tanzania safaris, the Great Migration, Kilimanjaro routes and Zanzibar. Practical tips and inspiration from the Go Deep Africa Safari local team.',
    ])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .blog-hero {
            min-height: 60vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 100%),
                        url('https://images.unsplash.com/photo-1489392211049-fc10c97e64b6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .blog-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            overflow: hidden;
        }
        .blog-card:hover {
            transform: translateY(-15px) scale(1.02);
            border-color: #8B4513;
            box-shadow: 0 25px 50px rgba(139, 69, 19, 0.25);
        }
        .blog-card .blog-img-wrapper {
            overflow: hidden;
        }
        .blog-card .blog-img-wrapper img {
            transition: transform 0.6s ease;
        }
        .blog-card:hover .blog-img-wrapper img {
            transform: scale(1.1);
        }
        .blog-date-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            color: white;
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            z-index: 2;
            text-align: center;
            min-width: 60px;
        }
        .blog-date-badge .day {
            display: block;
            font-size: 1.5rem;
            line-height: 1;
        }
        .blog-date-badge .month {
            display: block;
            font-size: 0.7rem;
            text-transform: uppercase;
        }
        .filter-btn {
            border: 2px solid #8B4513;
            color: #8B4513;
            border-radius: 50px;
            padding: 10px 30px;
            transition: all 0.3s ease;
            background: white;
            font-weight: 600;
            text-decoration: none;
        }
        .filter-btn:hover, .filter-btn.active {
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            color: white !important;
            border-color: transparent;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
            transform: translateY(-2px);
        }
        .author-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 15px;
            background: rgba(139, 69, 19, 0.1);
            border-radius: 20px;
            font-size: 0.85rem;
            color: #3E2723;
        }
        .category-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.95);
            color: #8B4513;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            z-index: 2;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    @include('partials.header')

    <!-- Hero Section -->
    <section class="blog-hero text-white d-flex align-items-center">
        <div class="container text-center" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-4 py-2 mb-3">
                <i class="fas fa-pen-fancy me-2"></i>Stories & Insights
            </span>
            <h1 class="display-3 fw-bold mb-4" style="font-family: 'Nunito', sans-serif;">
                Our Blog
            </h1>
            <p class="lead mx-auto mb-4" style="max-width: 700px;">
                Expert insights, travel stories, and insider tips from the heart of Tanzania
            </p>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-4">
            <!-- Category Filter Bar -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="d-flex flex-wrap justify-content-center gap-2" data-aos="fade-up">
                        <a href="{{ route('blog') }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">
                            <i class="fas fa-th-large me-2"></i>All Posts
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('blog', ['category' => $cat->category]) }}" class="filter-btn {{ request('category') == $cat->category ? 'active' : '' }}">
                                {{ $cat->category }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @foreach($posts as $post)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="blog-card card h-100 border-0 shadow-sm rounded-4">
                        <div class="blog-img-wrapper position-relative" style="height: 280px;">
                            <img src="{{ asset($post->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $post->title }}">
                            <div class="blog-date-badge">
                                <span class="day">{{ $post->created_at->format('d') }}</span>
                                <span class="month">{{ $post->created_at->format('M') }}</span>
                            </div>
                            <div class="category-badge">
                                {{ $post->category }}
                            </div>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="author-badge">
                                    <i class="fas fa-user-circle"></i>
                                    <span>{{ $post->author ?? 'Go Deep Africa' }}</span>
                                </div>
                                <span class="text-muted small">
                                    <i class="far fa-clock me-1"></i>{{ $post->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <h5 class="fw-bold mb-3" style="color: #3E2723; font-family: 'Nunito', sans-serif; min-height: 3rem;">
                                <a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none">
                                    {{ $post->title }}
                                </a>
                            </h5>
                            <p class="text-muted small mb-4" style="line-height: 1.6;">{{ Str::limit($post->summary, 140) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                <div class="d-flex gap-3">
                                    <span class="text-muted small">
                                        <i class="far fa-eye me-1"></i>{{ $post->views ?? 0 }}
                                    </span>
                                    <span class="text-muted small">
                                        <i class="far fa-comment me-1"></i>{{ $post->comments_count ?? 0 }}
                                    </span>
                                </div>
                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-sm rounded-pill px-4" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                    Read More <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center" data-aos="fade-up">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
        <div class="container py-4 text-center text-white">
            <h2 class="fw-bold mb-3" style="font-family: 'Nunito', sans-serif;">Stay Updated</h2>
            <p class="lead mb-4 opacity-75">Subscribe to our newsletter for travel tips and exclusive offers</p>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="email" class="form-control rounded-pill" placeholder="Enter your email">
                        <button class="btn rounded-pill px-4" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>
</html>
