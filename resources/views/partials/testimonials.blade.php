<section class="testimonials-section py-5 animate__animated animate__fadeIn">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="d-flex align-items-center gap-3">
                <div class="quote-icon-box">
                    <i class="fas fa-quote-left"></i>
                </div>
                <h2 class="section-title mb-0" style="font-family: 'Playfair Display', serif;">What travellers say</h2>
            </div>
            <div class="testimonial-controls d-flex gap-2">
                <button class="control-btn" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="control-btn" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="row g-4">
                        @for($i = 1; $i <= 3; $i++)
                        <div class="col-md-4">
                            <div class="testimonial-card p-4 animate__animated animate__fadeInUp">
                                <div class="rating mb-3">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                </div>
                                <p class="testimonial-text mb-4">"An absolute life-changing experience! The Serengeti migration was more than I ever imagined. Our guide was incredibly knowledgeable and found all the Big Five in one day!"</p>
                                <div class="reviewer d-flex align-items-center gap-3">
                                    <div class="reviewer-img">
                                        <img src="https://i.pravatar.cc/150?u={{$i}}" alt="Reviewer" class="rounded-circle" width="50">
                                    </div>
                                    <div class="reviewer-info">
                                        <h6 class="fw-bold mb-0">Sarah Johnson</h6>
                                        <small class="text-muted">USA</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="row g-4">
                        @for($i = 4; $i <= 6; $i++)
                        <div class="col-md-4">
                            <div class="testimonial-card p-4 animate__animated animate__fadeInUp">
                                <div class="rating mb-3">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                </div>
                                <p class="testimonial-text mb-4">"Climbing Kilimanjaro with Go Deep Africa was the best decision. Safety was their priority, and the team was supportive through every step to the summit!"</p>
                                <div class="reviewer d-flex align-items-center gap-3">
                                    <div class="reviewer-img">
                                        <img src="https://i.pravatar.cc/150?u={{$i}}" alt="Reviewer" class="rounded-circle" width="50">
                                    </div>
                                    <div class="reviewer-info">
                                        <h6 class="fw-bold mb-0">David Müller</h6>
                                        <small class="text-muted">Germany</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
