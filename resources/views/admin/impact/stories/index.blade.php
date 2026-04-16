@extends('layouts.admin')

@section('title', 'Impact Stories')

@section('content')
<div class="container-fluid p-0 py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 px-3">
        <div>
            <h2 class="h4 mb-0 text-gray-800 fw-bold">Success Stories</h2>
            <p class="text-muted small mb-0">Manage impact stories and testimonials.</p>
        </div>
        <a href="{{ route('admin.impact.stories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Story
        </a>
    </div>

    <!-- Stories Grid -->
    <div class="row g-4 px-3">
        @forelse($stories as $story)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="position-relative">
                    <img src="{{ asset($story->image) }}" class="w-100" style="height: 180px; object-fit: cover; border-radius: 12px 12px 0 0;" alt="{{ $story->name }}">
                    <div class="position-absolute top-0 start-0 m-2">
                        <span class="badge" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">{{ $story->badge }}</span>
                    </div>
                    @if($story->is_featured)
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i>Featured</span>
                    </div>
                    @endif
                </div>
                <div class="card-body p-3">
                    <h5 class="fw-bold mb-1">{{ $story->title }}</h5>
                    <p class="text-muted small mb-2"><i class="fas fa-map-marker-alt me-1" style="color: #8b4513;"></i>{{ $story->location }}</p>
                    <p class="text-muted small mb-3" style="line-height: 1.5;">{{ Str::limit($story->quote, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge {{ $story->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $story->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <div class="btn-group">
                            <form action="{{ route('admin.impact.stories.toggle', $story) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-{{ $story->is_active ? 'warning' : 'success' }}">
                                    <i class="fas {{ $story->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.impact.stories.featured', $story) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-warning {{ $story->is_featured ? 'active' : '' }}">
                                    <i class="fas fa-star"></i>
                                </button>
                            </form>
                            <a href="{{ route('admin.impact.stories.edit', $story) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.impact.stories.delete', $story) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                <p class="text-muted mb-0">No stories found. Create your first story!</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="px-3 mt-4">
        {{ $stories->links() }}
    </div>

    <div class="px-3 mt-3">
        <a href="{{ route('admin.impact.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Impact Dashboard
        </a>
    </div>
</div>
@endsection
