@extends('layouts.admin')

@section('title', 'Add Impact Stat')

@section('content')
<div class="container-fluid p-0 py-2">
    <div class="px-3">
        <h2 class="h4 mb-0 text-gray-800 fw-bold">Add New Stat</h2>
        <p class="text-muted small mb-4">Create a new impact counter statistic.</p>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.impact.stats.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Icon Class <small class="text-muted">(FontAwesome, e.g., fa-heart)</small></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-icons"></i></span>
                                <input type="text" name="icon" class="form-control" placeholder="fa-heart" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Label</label>
                            <input type="text" name="label" class="form-control" placeholder="People Helped" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Value</label>
                            <input type="number" name="value" class="form-control" placeholder="12500" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Suffix <small class="text-muted">(+, %, etc)</small></label>
                            <input type="text" name="suffix" class="form-control" placeholder="+">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="display_order" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Stat
                        </button>
                        <a href="{{ route('admin.impact.stats') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
