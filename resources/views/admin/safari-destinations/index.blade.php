@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #3E2723;">
                <i class="fas fa-map-marked-alt me-2" style="color: #8B4513;"></i>Safari Destinations
            </h2>
            <p class="text-muted mb-0">Manage Tanzania's national parks and game reserves</p>
        </div>
        <a href="{{ route('admin.safari-destinations.create') }}" class="btn rounded-pill px-4 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
            <i class="fas fa-plus me-2"></i>Add Destination
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success rounded-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger rounded-4">{{ session('error') }}</div>
    @endif

    <div class="card border-0 rounded-4 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">Destination</th>
                            <th class="py-3">Location</th>
                            <th class="py-3">Activities</th>
                            <th class="py-3">Featured</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-end px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($destinations as $dest)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    @if($dest->featured_image)
                                    <img src="{{ asset('storage/' . $dest->featured_image) }}" class="rounded-3" style="width: 60px; height: 60px; object-fit: cover;" alt="">
                                    @else
                                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                        <i class="fas {{ $dest->icon }} text-white fa-lg"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <h6 class="fw-bold mb-1" style="color: #3E2723;">{{ $dest->name }}</h6>
                                        @if($dest->badge)
                                        <span class="badge" style="background: {{ $dest->badge_color == 'danger' ? '#dc3545' : ($dest->badge_color == 'warning' ? '#ffc107' : '#6c757d') }}; color: {{ $dest->badge_color == 'warning' ? '#000' : '#fff' }};">
                                            {{ $dest->badge }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">{{ $dest->location }}</td>
                            <td class="py-3">
                                <span class="badge bg-light text-dark">
                                    {{ $dest->activities_count }} activities
                                </span>
                            </td>
                            <td class="py-3">
                                @if($dest->is_featured)
                                <span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i>Featured</span>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="py-3">
                                @if($dest->is_active)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="py-3 text-end px-4">
                                <a href="{{ route('admin.safari-destinations.edit', $dest) }}" class="btn btn-sm btn-outline-primary rounded-pill me-2">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.safari-destinations.destroy', $dest) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this destination?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                                <p>No destinations found. <a href="{{ route('admin.safari-destinations.create') }}">Create one</a></p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
