@extends('layouts.admin')

@section('title', 'Edit Gallery Image')

@section('content')
<div class="container-fluid p-0 py-2">
    <div class="px-3">
        <h2 class="h4 mb-0 text-gray-800 fw-bold">Edit Gallery Image</h2>
        <p class="text-muted small mb-4">Update gallery item.</p>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.impact.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Subtitle</label>
                            <input type="text" name="subtitle" class="form-control" value="{{ $gallery->subtitle }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" value="{{ $gallery->location }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select">
                                <option value="education" {{ $gallery->category == 'education' ? 'selected' : '' }}>Education</option>
                                <option value="orphanage" {{ $gallery->category == 'orphanage' ? 'selected' : '' }}>Orphanage</option>
                                <option value="women" {{ $gallery->category == 'women' ? 'selected' : '' }}>Women</option>
                                <option value="community" {{ $gallery->category == 'community' ? 'selected' : '' }}>Community</option>
                                <option value="general" {{ $gallery->category == 'general' ? 'selected' : '' }}>General</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Column Width</label>
                            <select name="column_width" class="form-select">
                                <option value="4" {{ $gallery->column_width == 4 ? 'selected' : '' }}>4 cols (33%)</option>
                                <option value="6" {{ $gallery->column_width == 6 ? 'selected' : '' }}>6 cols (50%)</option>
                                <option value="12" {{ $gallery->column_width == 12 ? 'selected' : '' }}>12 cols (100%)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="display_order" class="form-control" value="{{ $gallery->display_order }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Current Image</label>
                            <div class="mb-2">
                                <img src="{{ asset($gallery->image) }}" class="rounded" style="height: 150px; object-fit: cover;" alt="{{ $gallery->title }}">
                            </div>
                            <label class="form-label">Change Image <small class="text-muted">(optional)</small></label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Image
                        </button>
                        <a href="{{ route('admin.impact.gallery') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
