<section class="packages-section py-5 animate__animated animate__fadeIn" style="background-color: #fdfaf5;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold" style="font-family: 'Playfair Display', serif; color: #3E2723;">Popular Tanzania Safaris</h2>
            <div class="mx-auto mt-2 mb-3" style="width: 80px; height: 4px; background: #8B4513;"></div>
            <p class="text-muted">Handpicked top-rated adventures for an unforgettable experience.</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            @foreach($packages as $package)
            <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp">
                <div class="package-card h-100 rounded-4 overflow-hidden border-0 shadow-lg bg-white position-relative">
                    <div class="package-img-wrapper" style="height: 280px; position: relative; overflow: hidden;">
                        <img src="{{ asset($package->image) }}" class="w-100 h-100 object-fit-cover transition-all" alt="{{ $package->title }}">
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge bg-earth rounded-pill px-3 py-2 shadow-sm">Tanzania</span>
                        </div>
                        <div class="price-tag-overlay position-absolute bottom-0 end-0 m-3 bg-white px-3 py-2 rounded-3 shadow-sm">
                            <span class="text-muted small">from</span>
                            <span class="fw-bold text-earth fs-5">${{ number_format($package->price, 0) }}</span>
                        </div>
                    </div>
                    <div class="package-content p-4 text-start d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif; color: #3E2723;">
                                <a href="{{ route('safari.show', $package->slug) }}" class="text-dark text-decoration-none hover-earth">{{ $package->title }}</a>
                            </h5>
                        </div>
                        
                        <div class="tour-meta mb-4 mt-2 d-flex gap-3 text-muted small">
                            <span><i class="far fa-clock text-earth me-1"></i> 7 Days</span>
                            <span><i class="fas fa-users text-earth me-1"></i> Private</span>
                        </div>

                        <div class="d-flex flex-column flex-sm-row gap-2 mt-auto">
                            <a href="{{ route('safari.show', $package->slug) }}" class="btn btn-outline-earth flex-grow-1 py-2 rounded-pill fw-bold text-nowrap">View Trip</a>
                            <button type="button" class="btn btn-earth flex-grow-1 py-2 rounded-pill text-white fw-bold shadow-sm text-nowrap" data-bs-toggle="modal" data-bs-target="#bookingModal" data-tour-title="{{ $package->title }}" data-tour-id="{{ $package->id }}">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('tours.all') }}" class="btn btn-earth rounded-pill px-5 py-3 fw-bold shadow-sm d-inline-block w-auto" style="min-width: 280px;">VIEW ALL SAFARI PACKAGES</a>
        </div>
    </div>
</section>

<style>
    .hover-earth:hover { color: #8B4513 !important; }
    .package-card {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }
    .package-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(139, 69, 19, 0.15) !important;
    }
    .package-img-wrapper img {
        transition: transform 0.6s ease;
    }
    .package-card:hover .package-img-wrapper img {
        transform: scale(1.1);
    }
</style>
