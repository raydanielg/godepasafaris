@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('admin.zanzibar.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>

    <div class="card border-0 rounded-4 shadow-sm">
        <div class="card-header bg-white py-4 border-0">
            <h4 class="fw-bold mb-0" style="color: #3E2723;">
                <i class="fas fa-umbrella-beach me-2" style="color: #8B4513;"></i>Add Zanzibar Item
            </h4>
        </div>
        <div class="card-body p-4">
            @include('admin.zanzibar._form', ['action' => route('admin.zanzibar.store'), 'method' => 'POST'])
        </div>
    </div>
</div>
@endsection
