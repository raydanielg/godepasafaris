@extends('layouts.admin')

@section('title', 'Edit Impact Story')

@section('content')
<div class="container-fluid p-0 py-2">
    <div class="px-3">
        <h2 class="h4 mb-0 text-gray-800 fw-bold">Edit Story</h2>
        <p class="text-muted small mb-4">Update success story.</p>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.impact.stories.update', $story) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Person's Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $story->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" value="{{ $story->location }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Badge/Category Label</label>
                            <input type="text" name="badge" class="form-control" value="{{ $story->badge }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Story Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $story->title }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select" required>
                                <option value="orphan" {{ $story->category == 'orphan' ? 'selected' : '' }}>Orphan & Children</option>
                                <option value="women" {{ $story->category == 'women' ? 'selected' : '' }}>Women Empowerment</option>
                                <option value="rehabilitation" {{ $story->category == 'rehabilitation' ? 'selected' : '' }}>Rehabilitation</option>
                                <option value="general" {{ $story->category == 'general' ? 'selected' : '' }}>General</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="display_order" class="form-control" value="{{ $story->display_order }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Quote / Story</label>
                            <textarea name="quote" class="form-control" rows="4" required>{{ $story->quote }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Current Image</label>
                            <div class="mb-2">
                                <img src="{{ asset($story->image) }}" class="rounded" style="height: 150px; object-fit: cover;" alt="{{ $story->name }}">
                            </div>
                            <label class="form-label">Change Image <small class="text-muted">(leave empty to keep current)</small></label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Story
                        </button>
                        <a href="{{ route('admin.impact.stories') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
