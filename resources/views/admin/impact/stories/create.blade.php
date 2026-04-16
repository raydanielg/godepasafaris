@extends('layouts.admin')

@section('title', 'Add Impact Story')

@section('content')
<div class="container-fluid p-0 py-2">
    <div class="px-3">
        <h2 class="h4 mb-0 text-gray-800 fw-bold">Add New Story</h2>
        <p class="text-muted small mb-4">Create a new success story.</p>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.impact.stories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Person's Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g., Neema" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" placeholder="e.g., Arusha, Tanzania" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Badge/Category Label</label>
                            <input type="text" name="badge" class="form-control" placeholder="e.g., Success Story" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Story Title</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g., Neema's Journey to Education" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select" required>
                                <option value="orphan">Orphan & Children</option>
                                <option value="women">Women Empowerment</option>
                                <option value="rehabilitation">Rehabilitation</option>
                                <option value="general">General</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="display_order" class="form-control" value="0">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Quote / Story</label>
                            <textarea name="quote" class="form-control" rows="4" placeholder="Enter the person's testimonial..." required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                            <small class="text-muted">Recommended size: 800x600px</small>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Story
                        </button>
                        <a href="{{ route('admin.impact.stories') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
