@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Create Packing List</h1>
            <p class="text-muted small mb-0">Add a new packing list for travelers</p>
        </div>
        <a href="{{ route('admin.packing-lists.index') }}" class="btn btn-light border px-4 rounded-pill fw-bold shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Back to Lists
        </a>
    </div>

    <form action="{{ route('admin.packing-lists.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-4" style="color: #3E2723;">Basic Information</h5>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">List Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror" placeholder="e.g. Kilimanjaro Climbing Essentials" value="{{ old('title') }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control rounded-3 @error('description') is-invalid @enderror" rows="4" placeholder="Brief description of what this packing list covers...">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-select rounded-3 @error('category') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                <option value="kilimanjaro" {{ old('category') == 'kilimanjaro' ? 'selected' : '' }}>Kilimanjaro Climbing</option>
                                <option value="safari" {{ old('category') == 'safari' ? 'selected' : '' }}>Safari Tours</option>
                                <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>General Travel</option>
                            </select>
                            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Icon Class</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3"><i class="fas fa-suitcase"></i></span>
                                <input type="text" name="icon" class="form-control rounded-end-3 @error('icon') is-invalid @enderror" placeholder="fa-suitcase" value="{{ old('icon', 'fa-suitcase') }}">
                            </div>
                            <small class="text-muted">Font Awesome icon class (e.g., fa-suitcase, fa-hiking)</small>
                            @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Display Order</label>
                            <input type="number" name="display_order" class="form-control rounded-3" value="{{ old('display_order', 0) }}" min="0">
                            <small class="text-muted">Lower numbers appear first</small>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold d-block">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-4" style="color: #3E2723;">List Image</h5>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Featured Image</label>
                        <input type="file" name="image" class="form-control rounded-3 @error('image') is-invalid @enderror" accept="image/*">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">Recommended: 800x600px, max 2MB</small>
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h5 class="fw-bold mb-3" style="color: #3E2723;">Quick Tips</h5>
                    <ul class="list-unstyled small text-muted mb-0">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Create separate lists for different trip types</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Mark essential items clearly</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Use descriptive item names</li>
                        <li><i class="fas fa-check text-success me-2"></i>Add helpful descriptions for complex items</li>
                    </ul>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary rounded-pill py-3 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); border: none;">
                        <i class="fas fa-save me-2"></i>Create List
                    </button>
                    <a href="{{ route('admin.packing-lists.index') }}" class="btn btn-light rounded-pill py-3 fw-bold border">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
