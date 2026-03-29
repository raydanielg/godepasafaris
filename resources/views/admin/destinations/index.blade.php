@extends('layouts.admin')

@section('title', 'Manage Destinations')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Destinations</h1>
            <p class="text-muted small mb-0">Manage geographical locations for your tours</p>
        </div>
        <a href="#" class="btn btn-earth px-4 rounded-pill fw-bold text-white shadow-sm" style="background-color: #8b4513;">
            <i class="fas fa-plus me-2"></i>Add New Destination
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #3E2723;">
            <i class="fas fa-map-marker-alt text-white me-2"></i>
            <h6 class="m-0 font-weight-bold text-white">Destination Catalog</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #fdfaf5;">
                        <tr class="text-uppercase small fw-bold text-muted">
                            <th class="ps-4">Destination Info</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($destinations as $dest)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($dest->image) }}" class="rounded-3 me-3 shadow-sm" style="width: 50px; height: 50px; object-fit: cover;" onerror="this.src='https://placehold.co/50x50?text=Dest'">
                                    <div>
                                        <div class="fw-bold text-dark small">{{ $dest->name }}</div>
                                        <code class="text-muted smaller" style="font-size: 0.7rem;">{{ $dest->slug }}</code>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="smaller text-dark" style="font-size: 0.75rem;">
                                    <i class="fas fa-globe-africa me-1 text-muted"></i>{{ $dest->location ?? 'Tanzania' }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border rounded-pill px-3 py-1 smaller fw-medium" style="font-size: 0.7rem;">
                                    {{ $dest->type ?? 'National Park' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success-soft text-success rounded-pill px-3 py-1 smaller fw-medium text-uppercase" style="background-color: #e8f5e9; color: #2e7d32; font-size: 0.65rem;">
                                    Active
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" style="font-size: 0.7rem;">
                                        Edit
                                    </a>
                                    <form action="#" method="POST" onsubmit="return confirm('Delete this destination?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" style="font-size: 0.7rem;">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-map-marker-alt fa-3x text-light mb-3"></i>
                                <p class="text-muted small">No destinations found. Create your first destination!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($destinations->hasPages())
            <div class="card-footer bg-white border-0 py-3 text-center">
                {{ $destinations->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .btn-earth:hover {
        background-color: #3E2723 !important;
        opacity: 0.9;
    }
    .smaller { font-size: 0.8rem; }
</style>
@endsection
