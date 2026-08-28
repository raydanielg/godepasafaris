@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #3E2723;">
                <i class="fas fa-quote-left me-2" style="color: #8B4513;"></i>Customer Testimonials
            </h2>
            <p class="text-muted mb-0">Real reviews from real customers. These appear on the homepage and the Testimonials page.</p>
        </div>
        <span class="badge rounded-pill px-3 py-2" style="background:#8B4513;">{{ $testimonials->count() }} total</span>
    </div>

    @if(session('success'))<div class="alert alert-success rounded-4">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger rounded-4">{{ session('error') }}</div>@endif
    @if($errors->any())
    <div class="alert alert-danger rounded-4">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <div class="alert alert-warning rounded-4 small">
        <i class="fas fa-triangle-exclamation me-1"></i>
        <strong>Only add reviews a real customer actually gave you</strong>, and only with their permission to publish.
        Inventing reviews &mdash; or publishing them without consent &mdash; breaks Google's review policy and consumer-protection
        law in the UK and USA, which are our two biggest markets. If we have no reviews yet, the website simply shows
        none, and that is fine.
    </div>

    <div class="row g-4">
        {{-- ---------------------------------------------------------- --}}
        {{-- Add a testimonial                                          --}}
        {{-- ---------------------------------------------------------- --}}
        <div class="col-xl-5">
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #2e7d32;">
                    <i class="fas fa-plus text-white me-2"></i>
                    <h6 class="m-0 fw-bold text-white">Add a Testimonial</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Customer Name</label>
                            <input type="text" name="name" class="form-control rounded-3" required maxlength="120"
                                   value="{{ old('name') }}" placeholder="e.g. Sarah Mitchell" style="background-color:#fdfaf5;">
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-7">
                                <label class="form-label small fw-bold text-muted text-uppercase">Country / City</label>
                                <input type="text" name="location" class="form-control rounded-3" maxlength="120"
                                       value="{{ old('location') }}" placeholder="United Kingdom" style="background-color:#fdfaf5;">
                            </div>
                            <div class="col-5">
                                <label class="form-label small fw-bold text-muted text-uppercase">Rating</label>
                                <select name="rating" class="form-select rounded-3" required style="background-color:#fdfaf5;">
                                    @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" @selected(old('rating', 5) == $i)>{{ $i }} star{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">What They Said</label>
                            <textarea name="content" rows="4" class="form-control rounded-3" required
                                      maxlength="1500" placeholder="Paste their words exactly as they wrote them."
                                      style="background-color:#fdfaf5;">{{ old('content') }}</textarea>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-7">
                                <label class="form-label small fw-bold text-muted text-uppercase">Trip Taken</label>
                                <input type="text" name="trip" class="form-control rounded-3" maxlength="160"
                                       value="{{ old('trip') }}" placeholder="7-Day Machame Route" style="background-color:#fdfaf5;">
                            </div>
                            <div class="col-5">
                                <label class="form-label small fw-bold text-muted text-uppercase">Travelled</label>
                                <input type="date" name="travelled_on" class="form-control rounded-3"
                                       value="{{ old('travelled_on') }}" max="{{ now()->toDateString() }}" style="background-color:#fdfaf5;">
                            </div>
                        </div>

                        <label class="form-label small fw-bold text-muted text-uppercase">Their Photo</label>
                        <input type="file" name="photo" class="form-control rounded-3 mb-2" accept="image/jpeg,image/png,image/webp">
                        <div class="form-text mb-2">
                            Optional. A square photo works best. JPG, PNG or WebP up to 4&nbsp;MB.
                            <strong>Use the customer's own photo</strong> &mdash; never a stock or generated face.
                            With no photo we show their initial instead.
                        </div>
                        <input type="url" name="image_url" class="form-control rounded-3 mb-3" placeholder="…or paste a photo link (https://…)">

                        <div class="d-flex gap-3 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="newActive" checked>
                                <label class="form-check-label small fw-bold" for="newActive">Show on website</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="newFeatured">
                                <label class="form-check-label small fw-bold" for="newFeatured">Feature first</label>
                            </div>
                        </div>

                        <button type="submit" class="btn w-100 py-2 rounded-pill fw-bold text-white" style="background:#2e7d32;">
                            <i class="fas fa-plus me-2"></i>Add Testimonial
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ---------------------------------------------------------- --}}
        {{-- Existing testimonials                                      --}}
        {{-- ---------------------------------------------------------- --}}
        <div class="col-xl-7">
            @forelse($testimonials as $t)
            <div class="card border-0 rounded-4 shadow-sm mb-3 {{ $t->is_active ? '' : 'opacity-75' }}">
                <div class="card-body p-4">
                    <form action="{{ route('admin.testimonials.update', $t) }}" method="POST" enctype="multipart/form-data" id="tst{{ $t->id }}">
                        @csrf
                        @method('PUT')

                        <div class="d-flex align-items-center gap-3 mb-3">
                            @if($t->image_url)
                                <img src="{{ $t->image_url }}" alt="{{ $t->name }}" class="rounded-circle" width="48" height="48" style="object-fit:cover;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0"
                                     style="width:48px; height:48px; background:#8B4513;">{{ $t->initial }}</div>
                            @endif
                            <div class="flex-grow-1">
                                <strong style="color:#3E2723;">{{ $t->name }}</strong>
                                <div class="small text-muted">
                                    @for($i = 0; $i < $t->stars; $i++)<i class="fas fa-star text-warning"></i>@endfor
                                    @if($t->location) &nbsp;{{ $t->location }} @endif
                                </div>
                            </div>
                            @if($t->is_featured)<span class="badge rounded-pill" style="background:#8B4513;">Featured</span>@endif
                            @unless($t->is_active)<span class="badge bg-secondary rounded-pill">Hidden</span>@endunless
                        </div>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label small text-muted mb-1">Name</label>
                                <input type="text" name="name" class="form-control form-control-sm rounded-3" required maxlength="120" value="{{ $t->name }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted mb-1">Country / City</label>
                                <input type="text" name="location" class="form-control form-control-sm rounded-3" maxlength="120" value="{{ $t->location }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small text-muted mb-1">Rating</label>
                                <select name="rating" class="form-select form-select-sm rounded-3" required>
                                    @for($i = 5; $i >= 1; $i--)<option value="{{ $i }}" @selected($t->rating == $i)>{{ $i }}</option>@endfor
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-muted mb-1">What they said</label>
                                <textarea name="content" rows="3" class="form-control form-control-sm rounded-3" required maxlength="1500">{{ $t->content }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted mb-1">Trip taken</label>
                                <input type="text" name="trip" class="form-control form-control-sm rounded-3" maxlength="160" value="{{ $t->trip }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted mb-1">Travelled on</label>
                                <input type="date" name="travelled_on" class="form-control form-control-sm rounded-3" max="{{ now()->toDateString() }}"
                                       value="{{ optional($t->travelled_on)->format('Y-m-d') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-muted mb-1">Replace photo</label>
                                <input type="file" name="photo" class="form-control form-control-sm rounded-3" accept="image/jpeg,image/png,image/webp">
                            </div>
                            @if($t->image)
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remove_photo" value="1" id="rm{{ $t->id }}">
                                    <label class="form-check-label small" for="rm{{ $t->id }}">Remove the current photo</label>
                                </div>
                            </div>
                            @endif
                            <div class="col-12 d-flex gap-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="act{{ $t->id }}" @checked($t->is_active)>
                                    <label class="form-check-label small" for="act{{ $t->id }}">Show on website</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="feat{{ $t->id }}" @checked($t->is_featured)>
                                    <label class="form-check-label small" for="feat{{ $t->id }}">Feature first</label>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" form="tst{{ $t->id }}" class="btn btn-sm rounded-pill px-3 text-white" style="background:#8B4513;">
                            <i class="fas fa-save me-1"></i>Save
                        </button>
                        <form action="{{ route('admin.testimonials.toggle', $t) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                <i class="fas {{ $t->is_active ? 'fa-eye-slash' : 'fa-eye' }} me-1"></i>{{ $t->is_active ? 'Hide' : 'Show' }}
                            </button>
                        </form>
                        <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="ms-auto"
                              onsubmit="return confirm('Delete this testimonial permanently?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                <i class="fas fa-trash-alt me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-quote-left fa-3x text-muted mb-3 opacity-25"></i>
                    <h5 class="fw-bold" style="color:#3E2723;">No testimonials yet</h5>
                    <p class="text-muted mb-0">
                        The invented reviews that used to sit here have been removed.<br>
                        The website shows no testimonial section until you add a real one.
                    </p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
