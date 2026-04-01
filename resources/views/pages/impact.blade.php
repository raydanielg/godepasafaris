@extends('layouts.app')

@section('content')
<div class="impact-page overflow-hidden">
    <!-- Hero Section -->
    <section class="impact-hero d-flex align-items-center justify-content-center text-center text-white position-relative" style="height: 60vh; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center;">
        <div class="container animate__animated animate__fadeIn">
            <h1 class="display-3 fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Giving Back to Tanzania</h1>
            <p class="lead mx-auto" style="max-width: 800px; font-size: 1.25rem;">Your journey with us directly supports local communities, orphans, and women in need. Every safari makes a difference.</p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-4" style="color: #3E2723; font-family: 'Playfair Display', serif;">Why We Give Back</h2>
                    <p class="text-muted fs-5 mb-4">At Go Deep Africa Safari, we believe that tourism should be a force for good. A portion of every booking goes directly to supporting vulnerable groups in Tanzania.</p>
                    <div class="impact-stats d-flex gap-4">
                        <div class="stat-item">
                            <h3 class="fw-bold" style="color: #8B4513;">10%</h3>
                            <p class="small text-muted text-uppercase fw-bold">Profits Donated</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="fw-bold" style="color: #8B4513;">500+</h3>
                            <p class="small text-muted text-uppercase fw-bold">Lives Impacted</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="fw-bold" style="color: #8B4513;">100%</h3>
                            <p class="small text-muted text-uppercase fw-bold">Local Support</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="rounded-4 overflow-hidden shadow-lg animate__animated animate__zoomIn">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" alt="African Children">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Support Categories -->
    <section class="categories-section py-5" style="background-color: #fdfaf5;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #3E2723; font-family: 'Playfair Display', serif;">Who We Support</h2>
                <div class="mx-auto mt-2 mb-4" style="width: 80px; height: 4px; background: #8B4513;"></div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="category-card p-5 text-center bg-white rounded-4 shadow-sm h-100 transition-all">
                        <div class="icon-box mb-4 mx-auto" style="width: 80px; height: 80px; background: #fdf5e6; color: #8B4513; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                            <i class="fas fa-child"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Orphans & Vulnerable Children</h4>
                        <p class="text-muted">We provide educational materials, food, and healthcare support to local orphanages in Arusha and surrounding areas.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card p-5 text-center bg-white rounded-4 shadow-sm h-100 transition-all">
                        <div class="icon-box mb-4 mx-auto" style="width: 80px; height: 80px; background: #fdf5e6; color: #8B4513; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                            <i class="fas fa-female"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Empowering Women</h4>
                        <p class="text-muted">Supporting local women's groups through micro-finance and skill-building projects to help them achieve financial independence.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card p-5 text-center bg-white rounded-4 shadow-sm h-100 transition-all">
                        <div class="icon-box mb-4 mx-auto" style="width: 80px; height: 80px; background: #fdf5e6; color: #8B4513; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Street Children</h4>
                        <p class="text-muted">Collaborating with local initiatives to provide shelter, rehabilitation, and a future for children living on the streets.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="impact-cta py-5 text-white" style="background: #3E2723;">
        <div class="container py-5 text-center">
            <h2 class="display-5 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Join Our Cause</h2>
            <p class="lead mb-5 opacity-75 mx-auto" style="max-width: 700px;">When you book your safari with us, you are not just a traveler; you are a partner in bringing hope and change to Tanzania.</p>
            <div class="d-flex flex-wrap justify-content-center gap-4">
                <a href="{{ route('tours.all') }}" class="btn btn-lg btn-light rounded-pill px-5 py-3 fw-bold" style="color: #3E2723;">BOOK A SAFARI</a>
                <a href="{{ route('contact') }}" class="btn btn-lg btn-outline-light rounded-pill px-5 py-3 fw-bold">LEARN MORE</a>
            </div>
        </div>
    </section>
</div>

<style>
    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(139, 69, 19, 0.1) !important;
        border: 1px solid #8B4513;
    }
    .impact-hero h1 {
        text-shadow: 2px 4px 10px rgba(0,0,0,0.5);
    }
</style>
@endsection
