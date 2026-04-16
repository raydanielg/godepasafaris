@extends('layouts.admin')

@section('title', 'Edit Partner')

@section('content')
<div class="container-fluid p-0 py-2">
    <div class="px-3">
        <h2 class="h4 mb-0 text-gray-800 fw-bold">Edit Partner</h2>
        <p class="text-muted small mb-4">Update partner organization.</p>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.impact.partners.update', $partner) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Organization Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $partner->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Icon Class</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas {{ $partner->icon }}"></i></span>
                                <input type="text" name="icon" class="form-control" value="{{ $partner->icon }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Website URL</label>
                            <input type="url" name="website_url" class="form-control" value="{{ $partner->website_url }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="display_order" class="form-control" value="{{ $partner->display_order }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $partner->description }}</textarea>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Partner
                        </button>
                        <a href="{{ route('admin.impact.partners') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
