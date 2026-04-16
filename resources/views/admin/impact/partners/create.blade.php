@extends('layouts.admin')

@section('title', 'Add Partner')

@section('content')
<div class="container-fluid p-0 py-2">
    <div class="px-3">
        <h2 class="h4 mb-0 text-gray-800 fw-bold">Add New Partner</h2>
        <p class="text-muted small mb-4">Create partner organization.</p>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.impact.partners.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Organization Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Icon Class <small class="text-muted">(FontAwesome)</small></label>
                            <input type="text" name="icon" class="form-control" placeholder="fa-hands-helping" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Website URL <small class="text-muted">(optional)</small></label>
                            <input type="url" name="website_url" class="form-control" placeholder="https://example.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="display_order" class="form-control" value="0">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Partner
                        </button>
                        <a href="{{ route('admin.impact.partners') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
