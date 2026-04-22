@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('admin.safari-destinations.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>

    <div class="card border-0 rounded-4 shadow-sm">
        <div class="card-header bg-white py-4 border-0">
            <h4 class="fw-bold mb-0" style="color: #3E2723;">
                <i class="fas fa-plus me-2" style="color: #8B4513;"></i>Create New Destination
            </h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.safari-destinations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Destination Name</label>
                        <input type="text" name="name" class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tagline</label>
                        <input type="text" name="tagline" class="form-control form-control-lg rounded-3" placeholder="e.g., Witness the Great Migration">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control rounded-3 @error('description') is-invalid @enderror" rows="4" required></textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Short Description</label>
                        <input type="text" name="short_description" class="form-control rounded-3" maxlength="500">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Location</label>
                        <input type="text" name="location" class="form-control rounded-3" placeholder="e.g., Northern Tanzania">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Best Time to Visit</label>
                        <input type="text" name="best_time" class="form-control rounded-3" placeholder="e.g., June - October">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Icon Class</label>
                        <input type="text" name="icon" class="form-control rounded-3" value="fa-paw" placeholder="FontAwesome icon class">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Area</label>
                        <input type="text" name="area" class="form-control rounded-3" placeholder="e.g., 14,763 km²">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Established Year</label>
                        <input type="text" name="established" class="form-control rounded-3" placeholder="e.g., 1951">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Wildlife Count</label>
                        <input type="text" name="wildlife_count" class="form-control rounded-3" placeholder="e.g., 4,000+ lions">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Badge (Optional)</label>
                        <input type="text" name="badge" class="form-control rounded-3" placeholder="e.g., Popular, New">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Badge Color</label>
                        <select name="badge_color" class="form-select rounded-3">
                            <option value="secondary">Gray</option>
                            <option value="success">Green</option>
                            <option value="danger">Red (Popular)</option>
                            <option value="warning">Yellow (Wild)</option>
                            <option value="info">Blue</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Highlight 1</label>
                        <input type="text" name="highlight_1" class="form-control rounded-3">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Highlight 2</label>
                        <input type="text" name="highlight_2" class="form-control rounded-3">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Highlight 3</label>
                        <input type="text" name="highlight_3" class="form-control rounded-3">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Featured Image</label>
                        <input type="file" name="featured_image" class="form-control rounded-3 @error('featured_image') is-invalid @enderror" accept="image/*">
                        @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Display Order</label>
                        <input type="number" name="display_order" class="form-control rounded-3" value="0" min="0">
                    </div>

                    <div class="col-12">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="featured">
                            <label class="form-check-label fw-bold" for="featured">Featured Destination</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="active" checked>
                            <label class="form-check-label fw-bold" for="active">Active</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                        <i class="fas fa-save me-2"></i>Create Destination
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
