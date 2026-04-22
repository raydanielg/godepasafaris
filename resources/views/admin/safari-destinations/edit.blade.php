@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('admin.safari-destinations.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-header bg-white py-4 border-0">
                    <h4 class="fw-bold mb-0" style="color: #3E2723;">
                        <i class="fas fa-edit me-2" style="color: #8B4513;"></i>Edit {{ $safariDestination->name }}
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.safari-destinations.update', $safariDestination) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Destination Name</label>
                                <input type="text" name="name" class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror" value="{{ old('name', $safariDestination->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tagline</label>
                                <input type="text" name="tagline" class="form-control form-control-lg rounded-3" value="{{ old('tagline', $safariDestination->tagline) }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control rounded-3 @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $safariDestination->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Short Description</label>
                                <input type="text" name="short_description" class="form-control rounded-3" value="{{ old('short_description', $safariDestination->short_description) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Location</label>
                                <input type="text" name="location" class="form-control rounded-3" value="{{ old('location', $safariDestination->location) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Best Time to Visit</label>
                                <input type="text" name="best_time" class="form-control rounded-3" value="{{ old('best_time', $safariDestination->best_time) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Icon Class</label>
                                <input type="text" name="icon" class="form-control rounded-3" value="{{ old('icon', $safariDestination->icon) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Area</label>
                                <input type="text" name="area" class="form-control rounded-3" value="{{ old('area', $safariDestination->area) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Established Year</label>
                                <input type="text" name="established" class="form-control rounded-3" value="{{ old('established', $safariDestination->established) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Wildlife Count</label>
                                <input type="text" name="wildlife_count" class="form-control rounded-3" value="{{ old('wildlife_count', $safariDestination->wildlife_count) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Badge</label>
                                <input type="text" name="badge" class="form-control rounded-3" value="{{ old('badge', $safariDestination->badge) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Badge Color</label>
                                <select name="badge_color" class="form-select rounded-3">
                                    <option value="secondary" {{ $safariDestination->badge_color == 'secondary' ? 'selected' : '' }}>Gray</option>
                                    <option value="success" {{ $safariDestination->badge_color == 'success' ? 'selected' : '' }}>Green</option>
                                    <option value="danger" {{ $safariDestination->badge_color == 'danger' ? 'selected' : '' }}>Red</option>
                                    <option value="warning" {{ $safariDestination->badge_color == 'warning' ? 'selected' : '' }}>Yellow</option>
                                    <option value="info" {{ $safariDestination->badge_color == 'info' ? 'selected' : '' }}>Blue</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Highlight 1</label>
                                <input type="text" name="highlight_1" class="form-control rounded-3" value="{{ old('highlight_1', $safariDestination->highlight_1) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Highlight 2</label>
                                <input type="text" name="highlight_2" class="form-control rounded-3" value="{{ old('highlight_2', $safariDestination->highlight_2) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Highlight 3</label>
                                <input type="text" name="highlight_3" class="form-control rounded-3" value="{{ old('highlight_3', $safariDestination->highlight_3) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Featured Image</label>
                                @if($safariDestination->featured_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $safariDestination->featured_image) }}" class="rounded-3" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                                </div>
                                @endif
                                <input type="file" name="featured_image" class="form-control rounded-3 @error('featured_image') is-invalid @enderror" accept="image/*">
                                @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Display Order</label>
                                <input type="number" name="display_order" class="form-control rounded-3" value="{{ old('display_order', $safariDestination->display_order) }}" min="0">
                            </div>

                            <div class="col-12">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="featured" {{ $safariDestination->is_featured ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="featured">Featured Destination</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="active" {{ $safariDestination->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="active">Active</label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                <i class="fas fa-save me-2"></i>Update Destination
                            </button>
                            <a href="{{ route('destinations.show', $safariDestination->slug) }}" target="_blank" class="btn btn-lg btn-outline-dark rounded-pill px-4 ms-2">
                                <i class="fas fa-eye me-2"></i>Preview
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Activities Section -->
        <div class="col-lg-4">
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-header bg-white py-4 border-0">
                    <h5 class="fw-bold mb-0" style="color: #3E2723;">
                        <i class="fas fa-tasks me-2" style="color: #8B4513;"></i>Activities
                    </h5>
                </div>
                <div class="card-body p-4">
                    <!-- Add Activity Form -->
                    <form action="{{ route('admin.safari-destinations.activities.store', $safariDestination) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Activity Name</label>
                            <input type="text" name="name" class="form-control rounded-3" placeholder="e.g., Game Drives" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon Class</label>
                            <input type="text" name="icon" class="form-control rounded-3" placeholder="fa-car">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description (Optional)</label>
                            <input type="text" name="description" class="form-control rounded-3" placeholder="Brief description">
                        </div>
                        <button type="submit" class="btn btn-sm rounded-pill" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                            <i class="fas fa-plus me-1"></i>Add Activity
                        </button>
                    </form>

                    <hr>

                    <!-- Existing Activities -->
                    @if($safariDestination->activities->count() > 0)
                    <h6 class="fw-bold mb-3">Current Activities</h6>
                    @foreach($safariDestination->activities as $activity)
                    <div class="d-flex align-items-center justify-content-between p-3 rounded-3 mb-2" style="background: #f8f9fa;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                <i class="fas {{ $activity->icon }} text-white"></i>
                            </div>
                            <div>
                                <span class="fw-bold d-block" style="color: #3E2723;">{{ $activity->name }}</span>
                                @if($activity->description)
                                <small class="text-muted">{{ $activity->description }}</small>
                                @endif
                            </div>
                        </div>
                        <form action="{{ route('admin.safari-activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Delete this activity?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                    @endforeach
                    @else
                    <p class="text-muted text-center py-3">No activities added yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
