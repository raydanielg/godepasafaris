<section class="blog-section py-5 animate__animated animate__fadeIn">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="section-title mb-0" style="font-family: 'Playfair Display', serif;">Articles by our Safari Specialists</h2>
            <a href="{{ route('blog') }}" class="view-all-link text-decoration-none">View all posts</a>
        </div>

        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-md-4 animate__animated animate__fadeInUp">
                <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
                    <div class="blog-card h-100 rounded-4 overflow-hidden shadow-sm bg-white">
                        <div class="blog-img-wrapper" style="height: 220px; overflow: hidden;">
                            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="w-100 h-100 object-fit-cover transition-all">
                        </div>
                        <div class="blog-content p-4">
                            <span class="blog-category text-earth text-uppercase small fw-bold">{{ $post->category ?? 'Safari' }}</span>
                            <h5 class="blog-title mt-2 text-dark fw-bold" style="font-family: 'Playfair Display', serif;">{{ $post->title }}</h5>
                            <p class="text-muted small mt-2 mb-0">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
