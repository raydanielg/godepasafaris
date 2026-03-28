<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }} - Go Deep Africa Safari</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header')

    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset($post->image) }}');">
        <div class="container text-center">
            <span class="badge bg-primary text-uppercase mb-3 animate__animated animate__fadeInDown">{{ $post->category }}</span>
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">{{ $post->title }}</h1>
            <div class="d-flex justify-content-center gap-4 mt-3 text-white opacity-75 animate__animated animate__fadeInUp animate__delay-1s">
                <span><i class="far fa-calendar-alt me-2"></i>{{ $post->created_at->format('M d, Y') }}</span>
                <span><i class="far fa-eye me-2"></i>{{ $post->views }} Views</span>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="blog-details-content animate__animated animate__fadeIn">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    <!-- Comment Section -->
                    <div class="comment-section mt-5 pt-5 border-top">
                        <h3 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Comments ({{ $post->comments->count() }})</h3>
                        
                        @if(session('success'))
                            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="comments-list mb-5">
                            @foreach($post->comments as $comment)
                            <div class="comment-item d-flex gap-3 mb-4 p-4 rounded-4 shadow-sm bg-white animate__animated animate__fadeInUp">
                                <div class="commenter-avatar">
                                    <div class="avatar-circle">{{ substr($comment->name, 0, 1) }}</div>
                                </div>
                                <div class="comment-body flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="fw-bold mb-0">{{ $comment->name }}</h6>
                                        <div class="rating-stars small">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $comment->rating ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <small class="text-muted d-block mb-2">{{ $comment->created_at->diffForHumans() }}</small>
                                    <p class="mb-0 text-muted">{{ $comment->comment }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Add Comment Form -->
                        <div class="add-comment-card p-4 p-md-5 rounded-4 shadow-lg border-0">
                            <h4 class="fw-bold mb-4">Leave a Review</h4>
                            <form action="{{ route('blog.comment', $post->id) }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Your Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Email Address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold small d-block">Rating</label>
                                        <div class="rating-input d-flex gap-2">
                                            @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" {{ $i == 5 ? 'checked' : '' }}>
                                            <label for="star{{ $i }}"><i class="fas fa-star"></i></label>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold small">Your Comment</label>
                                        <textarea name="comment" class="form-control" rows="4" placeholder="Share your experience..." required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-earth w-100 py-3 mt-2">POST COMMENT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="blog-sidebar sticky-top" style="top: 100px;">
                        <div class="sidebar-card p-4 rounded-4 shadow-sm bg-white mb-4">
                            <h5 class="fw-bold mb-3 border-bottom pb-2">Related Articles</h5>
                            @foreach($relatedPosts as $rp)
                            <div class="d-flex gap-3 mb-3">
                                <img src="{{ asset($rp->image) }}" class="rounded-3 object-fit-cover" width="80" height="60" alt="{{ $rp->title }}">
                                <div>
                                    <h6 class="small fw-bold mb-1"><a href="{{ route('blog.show', $rp->slug) }}" class="text-dark text-decoration-none hover-primary">{{ Str::limit($rp->title, 40) }}</a></h6>
                                    <small class="text-muted">{{ $rp->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="sidebar-card p-4 rounded-4 shadow-sm bg-earth-dark text-white text-center border-0">
                            <div class="card-icon-header mb-3">
                                <i class="fas fa-compass fa-3x text-earth-light"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Plan Your Safari</h5>
                            <p class="small opacity-75 mb-4">Let our experts help you create the perfect Tanzanian adventure tailored to your style.</p>
                            <a href="{{ route('contact') }}" class="btn btn-earth w-100 rounded-pill py-2">GET A QUOTE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
    @include('partials.whatsapp')
</body>
</html>
