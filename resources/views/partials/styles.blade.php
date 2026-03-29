<section class="safari-styles-section py-5 bg-light animate__animated animate__fadeIn">
    <div class="container text-center">
        <div class="mb-5">
            <h2 class="display-5 fw-bold" style="font-family: 'Playfair Display', serif;">Safari Styles</h2>
            <div class="mx-auto mt-2 mb-3" style="width: 80px; height: 4px; background: #8B4513;"></div>
            <p class="text-muted">Choose the adventure that fits your travel spirit and comfort level.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Lodge Safari -->
            <div class="col-lg-2 col-md-4 col-sm-6 animate__animated animate__fadeInUp">
                <a href="{{ route('styles.lodge') }}" class="style-card-link text-decoration-none">
                    <div class="style-card text-center p-4 h-100">
                        <div class="style-icon-box mb-3 mx-auto">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Lodge Safari</h5>
                    </div>
                </a>
            </div>

            <!-- Camping Safari -->
            <div class="col-lg-2 col-md-4 col-sm-6 animate__animated animate__fadeInUp animate__delay-1s">
                <a href="{{ route('styles.camping') }}" class="style-card-link text-decoration-none">
                    <div class="style-card text-center p-4 h-100">
                        <div class="style-icon-box mb-3 mx-auto">
                            <i class="fas fa-campground"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Camping Safari</h5>
                    </div>
                </a>
            </div>

            <!-- Luxury Safari -->
            <div class="col-lg-2 col-md-4 col-sm-6 animate__animated animate__fadeInUp animate__delay-2s">
                <a href="{{ route('styles.luxury') }}" class="style-card-link text-decoration-none">
                    <div class="style-card text-center p-4 h-100">
                        <div class="style-icon-box mb-3 mx-auto">
                            <i class="fas fa-gem"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Luxury Safari</h5>
                    </div>
                </a>
            </div>

            <!-- Private Safari -->
            <div class="col-lg-2 col-md-4 col-sm-6 animate__animated animate__fadeInUp animate__delay-3s">
                <a href="{{ route('styles.private') }}" class="style-card-link text-decoration-none">
                    <div class="style-card text-center p-4 h-100">
                        <div class="style-icon-box mb-3 mx-auto">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Private Safari</h5>
                    </div>
                </a>
            </div>

            <!-- Budget Safari -->
            <div class="col-lg-2 col-md-4 col-sm-6 animate__animated animate__fadeInUp animate__delay-4s">
                <a href="{{ route('styles.budget') }}" class="style-card-link text-decoration-none">
                    <div class="style-card text-center p-4 h-100">
                        <div class="style-icon-box mb-3 mx-auto">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Budget Safari</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    .style-card {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(139, 69, 19, 0.05);
    }
    .style-card-link:hover .style-card {
        transform: translateY(-15px);
        box-shadow: 0 20px 40px rgba(139, 69, 19, 0.1);
        border-color: #8B4513;
    }
    .style-icon-box {
        width: 70px;
        height: 70px;
        background: #fdf5e6;
        color: #8B4513;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        transition: all 0.4s;
    }
    .style-card-link:hover .style-icon-box {
        background: #8B4513;
        color: white;
        transform: rotateY(360deg);
    }
    .style-card h5 {
        color: #3E2723;
        font-size: 1rem;
        transition: color 0.3s;
    }
    .style-card-link:hover h5 {
        color: #8B4513;
    }
</style>
