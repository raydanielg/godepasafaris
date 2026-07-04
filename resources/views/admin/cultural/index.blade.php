@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #3E2723;">
                <i class="fas fa-people-group me-2" style="color: #8B4513;"></i>Cultural Safari
            </h2>
            <p class="text-muted mb-0">Manage Tanzania's cultural tourism experiences, images and reviews</p>
        </div>
        <a href="{{ route('admin.cultural.create') }}" class="btn rounded-pill px-4 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
            <i class="fas fa-plus me-2"></i>Add Experience
        </a>
    </div>

    @if(session('success'))<div class="alert alert-success rounded-4">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger rounded-4">{{ session('error') }}</div>@endif

    @if($needsSetup ?? false)
    <div class="alert alert-warning rounded-4">
        <h6 class="fw-bold mb-1"><i class="fas fa-database me-2"></i>One-time setup needed</h6>
        <p class="mb-0 small">The Cultural Safari tables haven't been created on this server yet. Run
            <code>php artisan migrate --force</code> then <code>php artisan db:seed --class=CulturalSeeder --force</code>,
            or import <code>database/exports/cultural_update.sql</code> via phpMyAdmin. This page will populate automatically afterwards.</p>
    </div>
    @endif

    <div class="card border-0 rounded-4 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">Experience</th>
                            <th class="py-3">Region</th>
                            <th class="py-3">Reviews</th>
                            <th class="py-3">Featured</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-end px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($experiences as $exp)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    @if($exp->image_url)
                                    <img src="{{ $exp->image_url }}" class="rounded-3" style="width: 60px; height: 60px; object-fit: cover;" alt="">
                                    @else
                                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                        <i class="fas {{ $exp->icon ?: 'fa-people-group' }} text-white fa-lg"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <h6 class="fw-bold mb-1" style="color: #3E2723;">{{ $exp->name }}</h6>
                                        <small class="text-muted">{{ $exp->tribe }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">{{ $exp->region }}</td>
                            <td class="py-3"><span class="badge bg-light text-dark">{{ $exp->reviews_count }} reviews</span></td>
                            <td class="py-3">
                                @if($exp->is_featured)<span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i>Featured</span>@else<span class="text-muted">-</span>@endif
                            </td>
                            <td class="py-3">
                                @if($exp->is_active)<span class="badge bg-success">Active</span>@else<span class="badge bg-secondary">Inactive</span>@endif
                            </td>
                            <td class="py-3 text-end px-4">
                                <a href="{{ route('cultural.show', $exp) }}" target="_blank" class="btn btn-sm btn-outline-dark rounded-pill me-1"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.cultural.edit', $exp) }}" class="btn btn-sm btn-outline-primary rounded-pill me-1"><i class="fas fa-edit me-1"></i>Edit</a>
                                <form action="{{ route('admin.cultural.destroy', $exp) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this experience and its reviews?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-people-group fa-3x mb-3"></i>
                                <p>No cultural experiences yet. <a href="{{ route('admin.cultural.create') }}">Add one</a></p>
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
