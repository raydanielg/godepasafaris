@extends('layouts.admin')

@section('title', 'Add Gallery Image')

@section('content')
<div class="container-fluid p-0 py-2">
    <div class="px-3">
        <h2 class="h4 mb-0 text-gray-800 fw-bold">Add Gallery Image</h2>
        <p class="text-muted small mb-4">Upload new gallery image.</p>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.impact.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Subtitle</label>
                            <input type="text" name="subtitle" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" placeholder="e.g., Arusha, Tanzania">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select">
                                <option value="education">Education</option>
                                <option value="orphanage">Orphanage</option>
                                <option value="women">Women</option>
                                <option value="community">Community</option>
                                <option value="general">General</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Column Width</label>
                            <select name="column_width" class="form-select">
                                <option value="4">4 cols (33%)</option>
                                <option value="6">6 cols (50%)</option>
                                <option value="12">12 cols (100%)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="display_order" class="form-control" value="0">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Image
                        </button>
                        <a href="{{ route('admin.impact.gallery') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
