@extends('layouts.admin')

@section('title', 'Edit Timeline Event')

@section('content')
<div class="container-fluid p-0 py-2">
    <div class="px-3">
        <h2 class="h4 mb-0 text-gray-800 fw-bold">Edit Timeline Event</h2>
        <p class="text-muted small mb-4">Update milestone.</p>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.impact.timeline.update', $timeline) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Year</label>
                            <input type="text" name="year" class="form-control" value="{{ $timeline->year }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Icon Class</label>
                            <input type="text" name="icon" class="form-control" value="{{ $timeline->icon }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $timeline->title }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="display_order" class="form-control" value="{{ $timeline->display_order }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4" required>{{ $timeline->description }}</textarea>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Event
                        </button>
                        <a href="{{ route('admin.impact.timeline') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
