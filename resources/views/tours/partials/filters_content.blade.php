<div class="filter-group mb-4">
    <h6 class="filter-group-title">Where you want to go ?</h6>
    <div class="input-group mb-3">
        <span class="input-group-text border-0"><i class="fas fa-map-marker-alt"></i></span>
        <input type="text" class="form-control border-0 bg-light" placeholder="Where to?">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text border-0"><i class="fas fa-calendar-alt"></i></span>
        <input type="text" class="form-control border-0 bg-light" placeholder="When?">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text border-0"><i class="fas fa-users"></i></span>
        <input type="text" class="form-control border-0 bg-light" placeholder="Travelers">
    </div>
</div>

<div class="filter-group mb-4">
    <h6 class="filter-group-title">Price</h6>
    <input type="range" class="form-range custom-range" min="10" max="10000" id="priceRange">
    <div class="d-flex justify-content-between small text-muted mt-2">
        <span>$10</span>
        <span>$10000+</span>
    </div>
</div>

<div class="filter-group mb-4">
    <h6 class="filter-group-title">Tour Length</h6>
    <input type="range" class="form-range custom-range" min="1" max="21" id="lengthRange">
    <div class="d-flex justify-content-between small text-muted mt-2">
        <span>1-Day</span>
        <span>21+Day</span>
    </div>
</div>

<div class="filter-group mb-4">
    <h6 class="filter-group-title">Trip Type</h6>
    <div class="filter-check-list">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="private">
            <label class="form-check-label" for="private">Private</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="shared">
            <label class="form-check-label" for="shared">Shared</label>
        </div>
    </div>
</div>

<div class="filter-group mb-4">
    <h6 class="filter-group-title">Safari Type</h6>
    <div class="filter-check-list">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="lodge">
            <label class="form-check-label" for="lodge">Lodge</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="camping">
            <label class="form-check-label" for="camping">Camping</label>
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
