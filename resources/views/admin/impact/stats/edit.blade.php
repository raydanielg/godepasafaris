@extends('layouts.admin')

@section('title', 'Edit Impact Stat')

@section('content')
<div class="container-fluid p-0 py-2">
    <div class="px-3">
        <h2 class="h4 mb-0 text-gray-800 fw-bold">Edit Stat</h2>
        <p class="text-muted small mb-4">Update impact counter statistic.</p>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.impact.stats.update', $stat) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Icon Class <small class="text-muted">(FontAwesome)</small></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas {{ $stat->icon }}"></i></span>
                                <input type="text" name="icon" class="form-control" value="{{ $stat->icon }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Label</label>
                            <input type="text" name="label" class="form-control" value="{{ $stat->label }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Value</label>
                            <input type="number" name="value" class="form-control" value="{{ $stat->value }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Suffix <small class="text-muted">(+, %, etc)</small></label>
                            <input type="text" name="suffix" class="form-control" value="{{ $stat->suffix }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="display_order" class="form-control" value="{{ $stat->display_order }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="is_active" class="form-select">
                                <option value="1" {{ $stat->is_active ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$stat->is_active ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Stat
                        </button>
                        <a href="{{ route('admin.impact.stats') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
