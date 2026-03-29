<section class="testimonials-section py-5 animate__animated animate__fadeIn">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold" style="font-family: 'Playfair Display', serif;">What Our Guests Say</h2>
            <div class="mx-auto mt-2" style="width: 80px; height: 4px; background: #8B4513;"></div>
        </div>

        <div class="testimonial-marquee-container">
            <div class="testimonial-marquee">
                <div class="testimonial-track">
                    @foreach(array_merge($testimonials, $testimonials) as $t)
                    <div class="testimonial-card-v2 p-4 mx-3">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="{{ $t['image'] }}" class="rounded-circle shadow-sm" width="50" height="50" alt="{{ $t['name'] }}">
                            <div>
                                <h6 class="fw-bold mb-0" style="font-size: 0.9rem;">{{ $t['name'] }}</h6>
                                <small class="text-muted" style="font-size: 0.75rem;">{{ $t['location'] }}</small>
                            </div>
                        </div>
                        <div class="rating mb-2 text-warning small">
                            @for($i=0; $i<$t['rating']; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <p class="testimonial-text mb-0 small text-muted">"{{ Str::limit($t['content'], 120) }}"</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .testimonial-marquee-container {
        overflow: hidden;
        position: relative;
        padding: 40px 0;
    }
    .testimonial-marquee-container::before,
    .testimonial-marquee-container::after {
        content: '';
        position: absolute;
        top: 0;
        width: 100px;
        height: 100%;
        z-index: 2;
    }
    .testimonial-marquee-container::before {
        left: 0;
        background: linear-gradient(to right, #F5F5DC, transparent);
    }
    .testimonial-marquee-container::after {
        right: 0;
        background: linear-gradient(to left, #F5F5DC, transparent);
    }
    .testimonial-marquee {
        width: 100%;
    }
    .testimonial-track {
        display: flex;
        width: fit-content;
        animation: marquee 60s linear infinite;
    }
    .testimonial-track:hover {
        animation-play-state: paused;
    }
    .testimonial-card-v2 {
        width: 320px;
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        flex-shrink: 0;
        border: 1px solid rgba(139, 69, 19, 0.05);
    }
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
</style>
