@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Packing Lists</h1>
            <p class="text-muted small mb-0">Manage packing lists for Kilimanjaro, Safaris, and general travel</p>
        </div>
        <a href="{{ route('admin.packing-lists.create') }}" class="btn btn-earth text-white rounded-pill px-4 shadow-sm" style="background-color: #8b4513;">
            <i class="fas fa-plus me-2"></i>Create New List
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row g-4">
        @forelse($packingLists as $list)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4 pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                <i class="fas {{ $list->icon }} text-white"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color: #3E2723;">{{ $list->title }}</h5>
                                <span class="badge" style="background: {{ $list->category == 'kilimanjaro' ? '#8B4513' : ($list->category == 'safari' ? '#D2691E' : '#6c757d') }};">
                                    {{ ucfirst($list->category) }}
                                </span>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                <li><a class="dropdown-item" href="{{ route('admin.packing-lists.edit', $list) }}"><i class="fas fa-edit me-2 text-primary"></i>Edit</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('admin.packing-lists.destroy', $list) }}" method="POST" onsubmit="return confirm('Delete this packing list?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-trash me-2"></i>Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted small mb-3">{{ Str::limit($list->description, 100) }}</p>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-list text-muted"></i>
                            <span class="fw-bold" style="color: #8B4513;">{{ $list->items_count }}</span>
                            <span class="text-muted small">items</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-star text-warning"></i>
                            <span class="fw-bold" style="color: #8B4513;">{{ $list->items->where('is_essential', true)->count() }}</span>
                            <span class="text-muted small">essential</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 p-4 pt-0">
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.packing-lists.edit', $list) }}" class="btn btn-outline-primary btn-sm rounded-pill flex-grow-1">
                            <i class="fas fa-edit me-1"></i>Edit Items
                        </a>
                        <a href="{{ route('packing-list.show', $list->slug) }}" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-suitcase fa-3x text-light mb-3"></i>
                <h5 class="text-muted">No packing lists yet</h5>
                <p class="text-muted small">Create your first packing list to get started</p>
                <a href="{{ route('admin.packing-lists.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-plus me-2"></i>Create List
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
