@extends('layouts.admin')

@section('title', 'Impact Gallery')

@section('content')
<div class="container-fluid p-0 py-2">
    <div class="d-flex justify-content-between align-items-center mb-4 px-3">
        <div>
            <h2 class="h4 mb-0 text-gray-800 fw-bold">Gallery</h2>
            <p class="text-muted small mb-0">Manage impact page gallery images.</p>
        </div>
        <a href="{{ route('admin.impact.gallery.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Image
        </a>
    </div>

    <div class="row g-4 px-3">
        @forelse($gallery as $item)
        <div class="col-md-4 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="position-relative">
                    <img src="{{ asset($item->image) }}" class="w-100" style="height: 160px; object-fit: cover; border-radius: 12px 12px 0 0;" alt="{{ $item->title }}">
                    <span class="badge position-absolute top-0 end-0 m-2 {{ $item->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $item->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <div class="card-body p-3">
                    <h6 class="fw-bold mb-1">{{ $item->title }}</h6>
                    <p class="text-muted small mb-1">{{ $item->location }}</p>
                    <small class="text-muted">{{ $item->column_width }}/12 width</small>
                    <div class="mt-2 d-flex gap-1">
                        <form action="{{ route('admin.impact.gallery.toggle', $item) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-outline-{{ $item->is_active ? 'warning' : 'success' }}">
                                <i class="fas {{ $item->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                            </button>
                        </form>
                        <a href="{{ route('admin.impact.gallery.edit', $item) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.impact.gallery.delete', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this image?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-images fa-3x text-muted mb-3"></i>
                <p class="text-muted mb-0">No gallery items found.</p>
            </div>
        </div>
        @endforelse
    </div>

    <div class="px-3 mt-4">
        {{ $gallery->links() }}
    </div>

    <div class="px-3 mt-3">
        <a href="{{ route('admin.impact.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>
</div>
@endsection
