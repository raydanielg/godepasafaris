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

    @if(session('success'))
    <div class="alert alert-success border-0 rounded-4 d-flex align-items-center shadow-sm" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
    @endif

    {{-- Search + filter toolbar (client-side, no reload) --}}
    <div class="row g-2 align-items-center mb-3">
        <div class="col-md-6">
            <div class="input-group shadow-sm rounded-pill overflow-hidden">
                <span class="input-group-text bg-white border-0"><i class="fas fa-search text-muted"></i></span>
                <input type="search" id="pkgSearch" class="form-control border-0" placeholder="Search packages by name…" aria-label="Search packages">
            </div>
        </div>
        <div class="col-md-6">
            <div class="btn-group btn-group-sm flex-wrap w-100 w-md-auto" role="group" aria-label="Filter packages by status">
                <input type="radio" class="btn-check" name="pkgFilter" id="fltAll" value="all" checked>
                <label class="btn btn-outline-secondary rounded-start-pill px-3" for="fltAll">All</label>
                <input type="radio" class="btn-check" name="pkgFilter" id="fltActive" value="active">
                <label class="btn btn-outline-success px-3" for="fltActive">Active</label>
                <input type="radio" class="btn-check" name="pkgFilter" id="fltFeatured" value="featured">
                <label class="btn btn-outline-warning px-3" for="fltFeatured">Featured</label>
                <input type="radio" class="btn-check" name="pkgFilter" id="fltDraft" value="draft">
                <label class="btn btn-outline-secondary rounded-end-pill px-3" for="fltDraft">Drafts</label>
            </div>
        </div>
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
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($packages as $package)
                        <tr data-package-id="{{ $package->id }}"
                            data-title="{{ Str::lower($package->title) }}"
                            data-status="{{ $package->is_active ? 'active' : 'draft' }}"
                            data-featured="{{ $package->is_featured ? 'featured' : '' }}">
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($package->image) }}" class="rounded-3 me-3 shadow-sm" style="width: 50px; height: 50px; object-fit: cover;" loading="lazy" onerror="this.src='https://placehold.co/50x50?text=Safari'">
                                    <div>
                                        <div class="fw-bold text-dark small">{{ $package->title }}</div>
                                        <code class="text-muted" style="font-size: 0.7rem;">{{ $package->slug }}</code>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-earth" style="color: #8b4513;">${{ number_format($package->price, 0) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border"><i class="far fa-clock me-1"></i>{{ $package->days ?? '—' }} {{ $package->days ? 'Days' : '' }}</span>
                            </td>
                            <td>
                                @if($package->is_active)
                                    <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle">Active</span>
                                @else
                                    <span class="badge rounded-pill bg-secondary-subtle text-secondary border">Draft</span>
                                @endif
                                @if($package->is_featured)
                                    <span class="badge rounded-pill bg-warning-subtle text-warning border border-warning-subtle"><i class="fas fa-star me-1"></i>Featured</span>
                                @endif
                            </td>
                            <td>
                                <div class="smaller text-dark" style="font-size: 0.75rem;">{{ $package->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.safaris.edit', $package) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold edit-btn" style="font-size: 0.7rem;">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('admin.safaris.duplicate', $package) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold" style="font-size: 0.7rem;" title="Duplicate as draft">
                                            <i class="fas fa-copy me-1"></i>Duplicate
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold delete-btn" data-package-id="{{ $package->id }}" data-package-title="{{ $package->title }}" style="font-size: 0.7rem;">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-paw fa-3x text-light mb-3"></i>
                                <p class="text-muted small">No safari packages found. Create your first package!</p>
                            </td>
                        </tr>
                        @endforelse
                        <tr id="noResultsRow" style="display:none;">
                            <td colspan="6" class="text-center py-4 text-muted small"><i class="fas fa-search me-2"></i>No packages match your search.</td>
                        </tr>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Delete button click handler
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const packageId = this.getAttribute('data-package-id');
                const packageTitle = this.getAttribute('data-package-title');
                const row = this.closest('tr');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete "${packageTitle}". This action cannot be undone!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash me-2"></i>Yes, delete it!',
                    cancelButtonText: '<i class="fas fa-times me-2"></i>Cancel',
                    customClass: {
                        confirmButton: 'rounded-pill px-4',
                        cancelButton: 'rounded-pill px-4'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Deleting...',
                            text: 'Please wait while we delete the package',
                            icon: 'info',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // Send AJAX request
                        fetch(`{{ route('admin.safaris.delete', ':id') }}`.replace(':id', packageId), {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                _method: 'DELETE'
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Safari package has been deleted successfully.',
                                    icon: 'success',
                                    confirmButtonColor: '#8b4513',
                                    confirmButtonText: '<i class="fas fa-check me-2"></i>OK',
                                    customClass: {
                                        confirmButton: 'rounded-pill px-4'
                                    }
                                }).then(() => {
                                    // Remove row with animation
                                    row.style.transition = 'all 0.3s ease';
                                    row.style.opacity = '0';
                                    row.style.transform = 'translateX(100px)';
                                    setTimeout(() => {
                                        row.remove();
                                        // Check if table is empty
                                        if (document.querySelectorAll('tbody tr').length === 0) {
                                            location.reload();
                                        }
                                    }, 300);
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.message || 'Failed to delete package. Please try again.',
                                    icon: 'error',
                                    confirmButtonColor: '#dc3545',
                                    confirmButtonText: '<i class="fas fa-times me-2"></i>OK',
                                    customClass: {
                                        confirmButton: 'rounded-pill px-4'
                                    }
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while deleting the package.',
                                icon: 'error',
                                confirmButtonColor: '#dc3545',
                                confirmButtonText: '<i class="fas fa-times me-2"></i>OK',
                                customClass: {
                                    confirmButton: 'rounded-pill px-4'
                                }
                            });
                        });
                    }
                });
            });
        });
        
        // Edit button click handler
        document.querySelectorAll('.edit-btn').forEach(function(button) {
            button.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                const row = this.closest('tr');
                
                // Show loading state
                Swal.fire({
                    title: 'Loading...',
                    text: 'Please wait while we load the package details',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Navigate to edit page
                window.location.href = href;
            });
        });

        // --- Client-side search + status filter (instant, no reload) ---
        const searchInput = document.getElementById('pkgSearch');
        const filterRadios = document.querySelectorAll('input[name="pkgFilter"]');
        const rows = Array.from(document.querySelectorAll('tbody tr[data-package-id]'));
        const noResults = document.getElementById('noResultsRow');

        function applyPkgFilters() {
            const q = (searchInput ? searchInput.value : '').trim().toLowerCase();
            const checked = document.querySelector('input[name="pkgFilter"]:checked');
            const mode = checked ? checked.value : 'all';
            let visible = 0;

            rows.forEach(function(row) {
                const title = row.getAttribute('data-title') || '';
                const status = row.getAttribute('data-status') || '';
                const featured = row.getAttribute('data-featured') || '';
                const matchesSearch = !q || title.indexOf(q) !== -1;
                let matchesFilter = true;
                if (mode === 'active') matchesFilter = status === 'active';
                else if (mode === 'draft') matchesFilter = status === 'draft';
                else if (mode === 'featured') matchesFilter = featured === 'featured';
                const show = matchesSearch && matchesFilter;
                row.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            if (noResults) noResults.style.display = (rows.length && visible === 0) ? '' : 'none';
        }

        if (searchInput) searchInput.addEventListener('input', applyPkgFilters);
        filterRadios.forEach(function(r) { r.addEventListener('change', applyPkgFilters); });
    });
</script>
@endpush

<style>
    .btn-earth:hover {
        background-color: #3E2723 !important;
        opacity: 0.9;
    }
    .smaller { font-size: 0.8rem; }
    
    /* SweetAlert custom styles */
    .swal2-popup {
        border-radius: 1rem !important;
    }
    .swal2-title {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    }
    .swal2-content {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    }
</style>
@endsection
