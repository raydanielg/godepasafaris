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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, .flatpickr-day.selected.prevMonthDay, .flatpickr-day.startRange.prevMonthDay, .flatpickr-day.endRange.prevMonthDay, .flatpickr-day.selected.nextMonthDay, .flatpickr-day.startRange.nextMonthDay, .flatpickr-day.endRange.nextMonthDay {
            background: #8b4513 !important;
            border-color: #8b4513 !important;
        }
        .flatpickr-months .flatpickr-month, .flatpickr-current-month .flatpickr-monthDropdown-months, .flatpickr-current-month input.cur-year {
            color: #3E2723 !important;
            fill: #3E2723 !important;
        }
        .flatpickr-calendar {
            border-radius: 15px !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
            border: none !important;
        }
    </style>
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
                        <style>
                            .blog-details-content {
                                font-size: 1.15rem;
                                line-height: 1.8;
                                color: #333;
                            }
                            .blog-details-content h2, .blog-details-content h3, .blog-details-content h4 {
                                font-family: 'Playfair Display', serif;
                                color: #3E2723;
                                margin-top: 2.5rem;
                                margin-bottom: 1.25rem;
                                font-weight: 700;
                            }
                            .blog-details-content p {
                                margin-bottom: 1.5rem;
                            }
                            .blog-details-content img {
                                max-width: 100%;
                                height: auto;
                                border-radius: 15px;
                                margin: 2.5rem 0;
                                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                            }
                            .blog-details-content ul, .blog-details-content ol {
                                margin-bottom: 1.5rem;
                                padding-left: 1.5rem;
                            }
                            .blog-details-content li {
                                margin-bottom: 0.75rem;
                            }
                            .blog-details-content blockquote {
                                border-left: 5px solid #8b4513;
                                padding: 2rem;
                                background: #fdfaf5;
                                font-style: italic;
                                margin: 2.5rem 0;
                                border-radius: 0 15px 15px 0;
                                font-size: 1.2rem;
                                color: #5d4037;
                            }
                            .blog-details-content strong {
                                color: #3E2723;
                            }
                            /* Support for common blog structures */
                            .content-body h3 {
                                font-size: 1.75rem;
                                border-bottom: 2px solid #fdfaf5;
                                padding-bottom: 10px;
                            }
                            .content-body ul {
                                list-style-type: disc;
                            }
                            .content-body ol {
                                list-style-type: decimal;
                            }
                        </style>
                        <div class="content-body">
                            @php
                                $markdown = $post->content;
                                // Angalia kama ni HTML au Markdown. Kama haina tag za HTML, tibu kama Markdown.
                                if (strip_tags($markdown) === $markdown) {
                                    echo \Michelf\Markdown::defaultTransform($markdown);
                                } else {
                                    echo $markdown;
                                }
                            @endphp
                        </div>
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
                        <!-- Related Articles Card -->
                        <div class="sidebar-card p-4 rounded-4 shadow-sm bg-white mb-4 border-0">
                            <h5 class="fw-bold mb-4 position-relative pb-2" style="color: #3E2723; font-family: 'Playfair Display', serif;">
                                Related Articles
                                <div class="position-absolute bottom-0 start-0" style="width: 40px; height: 3px; background: #8b4513;"></div>
                            </h5>
                            <div class="related-posts-list">
                                @foreach($relatedPosts as $rp)
                                <div class="d-flex gap-3 mb-4 align-items-center group">
                                    <div class="flex-shrink-0 overflow-hidden rounded-3" style="width: 85px; height: 65px;">
                                        <img src="{{ asset($rp->image) }}" class="w-100 h-100 object-fit-cover transition-all" alt="{{ $rp->title }}" style="transition: transform 0.3s ease;">
                                    </div>
                                    <div>
                                        <h6 class="small fw-bold mb-1 line-clamp-2">
                                            <a href="{{ route('blog.show', $rp->slug) }}" class="text-dark text-decoration-none hover-primary" style="font-size: 0.9rem; line-height: 1.4;">
                                                {{ $rp->title }}
                                            </a>
                                        </h6>
                                        <div class="text-muted smaller d-flex align-items-center" style="font-size: 0.75rem;">
                                            <i class="far fa-calendar-alt me-1"></i> {{ $rp->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Plan Your Safari CTA Card -->
                        <div class="sidebar-card p-4 rounded-4 shadow-lg text-center border-0 position-relative overflow-hidden" style="background: linear-gradient(135deg, #3E2723 0%, #5d4037 100%);">
                            <!-- Decorative Circle background -->
                            <div class="position-absolute top-0 end-0 opacity-10" style="width: 150px; height: 150px; background: #deb887; border-radius: 50%; margin-top: -75px; margin-right: -75px;"></div>
                            
                            <div class="card-icon-header mb-3 position-relative">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 70px; height: 70px; background: rgba(222, 184, 135, 0.15);">
                                    <i class="fas fa-compass fa-2x" style="color: #DEB887;"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold mb-3 text-white" style="font-family: 'Playfair Display', serif;">Plan Your Safari</h4>
                            <p class="small mb-4 px-2" style="color: #e0e0e0; line-height: 1.6;">Let our experts help you create the perfect Tanzanian adventure tailored to your style.</p>
                            <a href="{{ route('contact') }}" class="btn btn-earth w-100 rounded-pill py-3 fw-bold text-white shadow-sm transition-all" style="background-color: #8b4513; border: none; letter-spacing: 1px;">
                                GET A FREE QUOTE <i class="fas fa-arrow-right ms-2 small"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
    @include('partials.ai_chatbot')
    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("input[type=date]", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                minDate: "today",
                animate: true
            });
        });
    </script>
</body>
</html>
