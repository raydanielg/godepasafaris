<section class="testimonials-section py-5 animate__animated animate__fadeIn position-relative overflow-hidden">
    <!-- Animated Sand Waves & Particles Background -->
    <div class="vfx-container">
        <div class="sand-waves"></div>
        <div class="sand-particles" id="sandParticles"></div>
    </div>

    <div class="container position-relative" style="z-index: 3;">
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const particleContainer = document.getElementById('sandParticles');
        if (particleContainer) {
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 5 + 's';
                particle.style.opacity = Math.random();
                particleContainer.appendChild(particle);
            }
        }
    });
</script>

<style>
    .vfx-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
        background: #fdfaf5;
    }

    .sand-waves {
        position: absolute;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 50% 50%, transparent 50%, rgba(139, 69, 19, 0.02) 52%, transparent 54%),
            radial-gradient(circle at 0% 100%, transparent 50%, rgba(139, 69, 19, 0.02) 52%, transparent 54%);
        background-size: 100px 100px;
        opacity: 0.5;
        animation: drift 30s linear infinite;
    }

    .sand-particles {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .particle {
        position: absolute;
        width: 3px;
        height: 3px;
        background: #8B4513;
        border-radius: 50%;
        filter: blur(1px);
        animation: float 10s ease-in-out infinite;
    }

    @keyframes drift {
        from { background-position: 0 0; }
        to { background-position: 500px 500px; }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-20px) translateX(10px); }
    }

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
        width: 150px;
        height: 100%;
        z-index: 2;
    }
    .testimonial-marquee-container::before {
        left: 0;
        background: linear-gradient(to right, #fdfaf5, transparent);
    }
    .testimonial-marquee-container::after {
        right: 0;
        background: linear-gradient(to left, #fdfaf5, transparent);
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
        box-shadow: 0 15px 35px rgba(139, 69, 19, 0.08);
        flex-shrink: 0;
        border: 1px solid rgba(139, 69, 19, 0.1);
        transition: all 0.3s ease;
    }
    .testimonial-card-v2:hover {
        transform: scale(1.05);
        border-color: #8B4513;
    }
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
</style>
