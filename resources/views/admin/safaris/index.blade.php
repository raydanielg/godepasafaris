@extends('layouts.admin')

@section('title', 'Safari Packages')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Safari Packages</h1>
            <p class="text-muted small mb-0">Manage your wildlife safari tour packages</p>
        </div>
        <a href="{{ route('admin.safaris.create') }}" class="btn btn-earth text-white rounded-pill px-4 shadow-sm" style="background-color: #8b4513;">
            <i class="fas fa-plus me-2"></i>Add New Package
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #3E2723;">
            <i class="fas fa-paw text-white me-2"></i>
            <h6 class="m-0 font-weight-bold text-white">Safari Tour Inventory</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #fdfaf5;">
                        <tr class="text-uppercase small fw-bold text-muted">
                            <th class="ps-4">Package Details</th>
                            <th>Price</th>
                            <th>Slug</th>
                            <th>Date Created</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($packages as $package)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($package->image) }}" class="rounded-3 me-3 shadow-sm" style="width: 50px; height: 50px; object-fit: cover;" onerror="this.src='https://placehold.co/50x50?text=Safari'">
                                    <div>
                                        <div class="fw-bold text-dark small">{{ $package->title }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-earth" style="color: #8b4513;">${{ number_format($package->price, 0) }}</span>
                            </td>
                            <td>
                                <code class="smaller text-muted" style="font-size: 0.75rem;">{{ $package->slug }}</code>
                            </td>
                            <td>
                                <div class="smaller text-dark" style="font-size: 0.75rem;">{{ $package->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.safaris.edit', $package) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" style="font-size: 0.7rem;">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.safaris.delete', $package) }}" method="POST" onsubmit="return confirm('Delete this package?')">
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
                                <i class="fas fa-paw fa-3x text-light mb-3"></i>
                                <p class="text-muted small">No safari packages found. Create your first package!</p>
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
