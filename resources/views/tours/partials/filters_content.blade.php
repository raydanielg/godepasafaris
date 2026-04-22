<div class="filter-group mb-4">
    <h6 class="filter-group-title fw-bold mb-3" style="color: #3E2723;">
        <i class="fas fa-dollar-sign me-2" style="color: #8B4513;"></i>Max Price: <span id="priceValue" class="fw-bold">$10,000</span>
    </h6>
    <input type="range" class="form-range custom-range" min="100" max="10000" step="100" value="10000" id="priceRange" style="accent-color: #8B4513;">
    <div class="d-flex justify-content-between small text-muted mt-2">
        <span>$100</span>
        <span>$10,000+</span>
    </div>
</div>

<div class="filter-group mb-4">
    <h6 class="filter-group-title fw-bold mb-3" style="color: #3E2723;">
        <i class="fas fa-clock me-2" style="color: #8B4513;"></i>Tour Length: <span id="lengthValue" class="fw-bold">21 Days</span>
    </h6>
    <input type="range" class="form-range custom-range" min="1" max="21" step="1" value="21" id="lengthRange" style="accent-color: #8B4513;">
    <div class="d-flex justify-content-between small text-muted mt-2">
        <span>1 Day</span>
        <span>21+ Days</span>
    </div>
</div>

<div class="filter-group mb-4">
    <h6 class="filter-group-title fw-bold mb-3" style="color: #3E2723;">
        <i class="fas fa-users me-2" style="color: #8B4513;"></i>Trip Type
    </h6>
    <div class="filter-check-list">
        <div class="form-check d-flex align-items-center gap-2 p-2 rounded-3 hover-bg-light transition-all" style="cursor: pointer;">
            <input class="form-check-input filter-checkbox" type="checkbox" name="private" id="private" style="width: 20px; height: 20px; cursor: pointer;">
            <label class="form-check-label flex-grow-1" for="private" style="cursor: pointer; font-weight: 500;">
                <i class="fas fa-user-shield me-2 text-muted"></i>Private Tour
            </label>
        </div>
        <div class="form-check d-flex align-items-center gap-2 p-2 rounded-3 hover-bg-light transition-all" style="cursor: pointer;">
            <input class="form-check-input filter-checkbox" type="checkbox" name="shared" id="shared" style="width: 20px; height: 20px; cursor: pointer;">
            <label class="form-check-label flex-grow-1" for="shared" style="cursor: pointer; font-weight: 500;">
                <i class="fas fa-users me-2 text-muted"></i>Group/Shared
            </label>
        </div>
    </div>
</div>

<div class="filter-group mb-4">
    <h6 class="filter-group-title fw-bold mb-3" style="color: #3E2723;">
        <i class="fas fa-bed me-2" style="color: #8B4513;"></i>Accommodation
    </h6>
    <div class="filter-check-list">
        <div class="form-check d-flex align-items-center gap-2 p-2 rounded-3 hover-bg-light transition-all" style="cursor: pointer;">
            <input class="form-check-input filter-checkbox" type="checkbox" name="lodge" id="lodge" style="width: 20px; height: 20px; cursor: pointer;">
            <label class="form-check-label flex-grow-1" for="lodge" style="cursor: pointer; font-weight: 500;">
                <i class="fas fa-hotel me-2 text-muted"></i>Lodge Safari
            </label>
        </div>
        <div class="form-check d-flex align-items-center gap-2 p-2 rounded-3 hover-bg-light transition-all" style="cursor: pointer;">
            <input class="form-check-input filter-checkbox" type="checkbox" name="camping" id="camping" style="width: 20px; height: 20px; cursor: pointer;">
            <label class="form-check-label flex-grow-1" for="camping" style="cursor: pointer; font-weight: 500;">
                <i class="fas fa-campground me-2 text-muted"></i>Camping Safari
            </label>
        </div>
    </div>
</div>

<div class="filter-group mb-4">
    <h6 class="filter-group-title">Starting From</h6>
    <div class="filter-check-list">
        @foreach($filters['starting_from'] as $start)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="start{{ $loop->index }}">
            <label class="form-check-label d-flex justify-content-between w-100" for="start{{ $loop->index }}">
                {{ $start }} <span class="text-muted">(0)</span>
            </label>
        </div>
        @endforeach
    </div>
</div>

<div class="filter-group mb-4">
    <h6 class="filter-group-title">Standard Level</h6>
    <div class="filter-check-list">
        @foreach($filters['standard_level'] as $level)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="level{{ $loop->index }}">
            <label class="form-check-label" for="level{{ $loop->index }}">{{ $level }}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="filter-group">
    <h6 class="filter-group-title">Specialized Tours</h6>
    <div class="filter-check-list">
        @foreach($filters['specialized_tours'] as $tour_type)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="specialized{{ $loop->index }}">
            <label class="form-check-label" for="specialized{{ $loop->index }}">{{ $tour_type }}</label>
        </div>
        @endforeach
    </div>
</div>
