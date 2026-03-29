<div class="row g-4">
    @foreach($tours as $tour)
    <div class="col-md-6 animate__animated animate__fadeInUp">
        <div class="package-card h-100 rounded-4 overflow-hidden border-0 shadow-sm bg-white">
            <div class="package-img-wrapper" style="height: 250px; position: relative; overflow: hidden;">
                <img src="{{ asset($tour->image) }}" class="w-100 h-100 object-fit-cover transition-all" alt="{{ $tour->title }}">
                <button class="wishlist-btn position-absolute top-0 end-0 m-3 border-0 bg-white rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                    <i class="far fa-heart text-dark"></i>
                </button>
            </div>
            <div class="card-body p-4 d-flex flex-column">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge-tour">Tanzania</span>
                    <span class="badge-tour">Private</span>
                    <span class="badge-tour">{{ $tour->type == 'Kilimanjaro' ? 'Trekking' : 'Mid Range' }}</span>
                    <span class="badge-tour">Lodge</span>
                </div>
                <h5 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; min-height: 3.5rem;">
                    <a href="{{ $tour->type == 'Kilimanjaro' ? route('kilimanjaro.show', $tour->slug) : route('safari.show', $tour->slug) }}" class="text-dark text-decoration-none hover-primary">{{ $tour->title }}</a>
                </h5>
                
                <div class="tour-rating mb-3">
                    <div class="stars d-inline-block">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <span class="fw-bold ms-2 small">5/5 <span class="text-muted fw-normal">(5 Reviews)</span></span>
                </div>

                <div class="price-section mb-3">
                    <span class="fw-bold fs-4 text-primary">${{ number_format($tour->price, 0) }}</span>
                    <small class="text-muted">pp</small>
                </div>

                <div class="tour-visit-info mb-4">
                    <div class="fw-bold mb-1"><i class="far fa-clock me-2"></i> {{ $tour->days }} Days - {{ $tour->days - 1 }} Nights</div>
                    <div class="small">You Visit : {{ $tour->type == 'Kilimanjaro' ? 'Kilimanjaro NP' : 'Serengeti, Ngorongoro' }}</div>
                </div>

                <div class="mt-auto">
                    <a href="{{ $tour->type == 'Kilimanjaro' ? route('kilimanjaro.show', $tour->slug) : route('safari.show', $tour->slug) }}" class="btn btn-earth w-100 py-2 rounded-pill text-white">View Details</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
