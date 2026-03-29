@extends('layouts.admin')

@section('title', 'Kilimanjaro Packages')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Kilimanjaro Packages</h1>
            <p class="text-muted small mb-0">Manage your mountain trekking packages</p>
        </div>
        <a href="#" class="btn btn-earth px-4 rounded-pill fw-bold text-white shadow-sm" style="background-color: #8b4513;">
            <i class="fas fa-plus me-2"></i>Add New Package
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #3E2723;">
            <i class="fas fa-mountain text-white me-2"></i>
            <h6 class="m-0 font-weight-bold text-white">Mountain Trek Inventory</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #fdfaf5;">
                        <tr class="text-uppercase small fw-bold text-muted">
                            <th class="ps-4">Package Details</th>
                            <th>Price</th>
                            <th>Route</th>
                            <th>Duration</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($packages as $package)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($package->image) }}" class="rounded-3 me-3 shadow-sm" style="width: 50px; height: 50px; object-fit: cover;" onerror="this.src='https://placehold.co/50x50?text=Kili'">
                                    <div>
                                        <div class="fw-bold text-dark small">{{ $package->title }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-earth" style="color: #8b4513;">${{ number_format($package->price, 0) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border rounded-pill px-3 py-1 smaller fw-medium" style="font-size: 0.7rem;">
                                    {{ $package->route_name ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <div class="smaller text-dark fw-medium" style="font-size: 0.75rem;">
                                    <i class="far fa-clock me-1 text-muted"></i>{{ $package->days ?? '7' }} Days
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" style="font-size: 0.7rem;">
                                        Edit
                                    </a>
                                    <form action="#" method="POST" onsubmit="return confirm('Delete this package?')">
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
                                <i class="fas fa-mountain fa-3x text-light mb-3"></i>
                                <p class="text-muted small">No Kilimanjaro packages found. Create your first package!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($packages->hasPages())
            <div class="card-footer bg-white border-0 py-3 text-center">
                {{ $packages->links() }}
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
