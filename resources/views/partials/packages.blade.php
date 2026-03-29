<section class="packages-section py-5 animate__animated animate__fadeIn">
    <div class="container text-center">
        <h2 class="section-title mb-2 animate__animated animate__fadeInDown">Explore Our Tanzania Popular Tours</h2>
        <p class="section-subtitle mb-5 animate__animated animate__fadeIn animate__delay-1s">Get started with handpicked top rated trips.</p>
        
        <div class="row g-4">
            @foreach($packages as $package)
            <div class="col-md-4 animate__animated animate__fadeInUp">
                <div class="package-card h-100 rounded-4 overflow-hidden border-0 shadow-sm bg-white">
                    <div class="package-img-wrapper" style="height: 250px; position: relative; overflow: hidden;">
                        <img src="{{ asset($package->image) }}" class="w-100 h-100 object-fit-cover transition-all" alt="{{ $package->title }}">
                        <button class="wishlist-btn position-absolute top-0 end-0 m-3 border-0 bg-white rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                            <i class="far fa-heart text-dark"></i>
                        </button>
                    </div>
                    <div class="package-content p-4 text-start d-flex flex-column">
                        <h5 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; min-height: 3.5rem;">
                            <a href="{{ route('safari.show', $package->slug) }}" class="text-dark text-decoration-none hover-primary">{{ $package->title }}</a>
                        </h5>
                        
                        <div class="price-section mb-4 mt-auto">
                            <span class="text-muted small">from</span>
                            <span class="fw-bold fs-4 text-earth">${{ number_format($package->price, 0) }}</span>
                            <small class="text-muted">pp</small>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('safari.show', $package->slug) }}" class="btn btn-outline-earth flex-grow-1 py-2 rounded-pill">View Trip</a>
                            <button type="button" class="btn btn-earth flex-grow-1 py-2 rounded-pill text-white" data-bs-toggle="modal" data-bs-target="#bookingModal" data-tour-title="{{ $package->title }}" data-tour-id="{{ $package->id }}">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('tours.all') }}" class="btn btn-earth rounded-pill px-5 py-3 fw-bold">VIEW ALL TOURS</a>
        </div>
    </div>
</section>
