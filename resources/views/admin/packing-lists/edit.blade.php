@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Edit: {{ $packingList->title }}</h1>
            <p class="text-muted small mb-0">Manage packing list and its items</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('packing-list.show', $packingList->slug) }}" target="_blank" class="btn btn-outline-primary rounded-pill px-4">
                <i class="fas fa-eye me-2"></i>Preview
            </a>
            <a href="{{ route('admin.packing-lists.index') }}" class="btn btn-light border px-4 rounded-pill fw-bold shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row g-4">
        <!-- Left: Edit Form -->
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-4" style="color: #3E2723;"><i class="fas fa-edit me-2"></i>List Details</h5>
                
                <form action="{{ route('admin.packing-lists.update', $packingList) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Title</label>
                        <input type="text" name="title" class="form-control rounded-3" value="{{ old('title', $packingList->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="3">{{ old('description', $packingList->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold small">Category</label>
                            <select name="category" class="form-select rounded-3">
                                <option value="kilimanjaro" {{ $packingList->category == 'kilimanjaro' ? 'selected' : '' }}>Kilimanjaro</option>
                                <option value="safari" {{ $packingList->category == 'safari' ? 'selected' : '' }}>Safari</option>
                                <option value="general" {{ $packingList->category == 'general' ? 'selected' : '' }}>General</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold small">Order</label>
                            <input type="number" name="display_order" class="form-control rounded-3" value="{{ $packingList->display_order }}" min="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Icon</label>
                        <input type="text" name="icon" class="form-control rounded-3" value="{{ $packingList->icon }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Image</label>
                        @if($packingList->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $packingList->image) }}" alt="" class="rounded-3" style="width: 100px; height: 70px; object-fit: cover;">
                        </div>
                        @endif
                        <input type="file" name="image" class="form-control rounded-3" accept="image/*">
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ $packingList->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); border: none;">
                        <i class="fas fa-save me-2"></i>Update List
                    </button>
                </form>
            </div>

            <!-- Add New Item -->
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h5 class="fw-bold mb-4" style="color: #3E2723;"><i class="fas fa-plus-circle me-2"></i>Add Item</h5>
                
                <form action="{{ route('admin.packing-lists.items.store', $packingList) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Item Name <span class="text-danger">*</span></label>
                        <input type="text" name="item_name" class="form-control rounded-3" placeholder="e.g. Hiking Boots" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="2" placeholder="Optional details..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold small">Icon</label>
                            <input type="text" name="icon" class="form-control rounded-3" placeholder="fa-shoe-prints">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold small">Order</label>
                            <input type="number" name="display_order" class="form-control rounded-3" value="{{ $packingList->items->count() }}" min="0">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-check">
                                <input type="checkbox" name="is_essential" class="form-check-input" id="is_essential" value="1">
                                <label class="form-check-label small" for="is_essential">
                                    <i class="fas fa-star text-warning me-1"></i>Essential
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input type="checkbox" name="is_recommended" class="form-check-input" id="is_recommended" value="1" checked>
                                <label class="form-check-label small" for="is_recommended">Recommended</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 rounded-pill">
                        <i class="fas fa-plus me-2"></i>Add Item
                    </button>
                </form>
            </div>
        </div>

        <!-- Right: Items List -->
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0" style="color: #3E2723;">
                            <i class="fas fa-list me-2"></i>Items ({{ $packingList->items->count() }})
                        </h5>
                        <div class="d-flex gap-2">
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star me-1"></i>{{ $packingList->items->where('is_essential', true)->count() }} Essential
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if($packingList->items->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0">Item</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packingList->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle bg-light" style="width: 40px; height: 40px;">
                                                <i class="fas {{ $item->icon ?? 'fa-check' }} text-muted"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1 {{ $item->is_essential ? 'text-warning' : '' }}">
                                                    {{ $item->item_name }}
                                                    @if($item->is_essential)
                                                    <i class="fas fa-star text-warning ms-1 small"></i>
                                                    @endif
                                                </h6>
                                                @if($item->description)
                                                <small class="text-muted">{{ Str::limit($item->description, 50) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->is_recommended)
                                        <span class="badge bg-success">Recommended</span>
                                        @else
                                        <span class="badge bg-secondary">Optional</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex gap-1 justify-content-end">
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editItemModal{{ $item->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.packing-lists.items.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this item?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Item Modal -->
                                <div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 rounded-4">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title fw-bold">Edit Item</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('admin.packing-lists.items.update', $item) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold small">Item Name</label>
                                                        <input type="text" name="item_name" class="form-control rounded-3" value="{{ $item->item_name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold small">Description</label>
                                                        <textarea name="description" class="form-control rounded-3" rows="2">{{ $item->description }}</textarea>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-6">
                                                            <label class="form-label fw-bold small">Icon</label>
                                                            <input type="text" name="icon" class="form-control rounded-3" value="{{ $item->icon }}">
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label fw-bold small">Order</label>
                                                            <input type="number" name="display_order" class="form-control rounded-3" value="{{ $item->display_order }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="checkbox" name="is_essential" class="form-check-input" id="edit_essential_{{ $item->id }}" value="1" {{ $item->is_essential ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="edit_essential_{{ $item->id }}">
                                                                    <i class="fas fa-star text-warning me-1"></i>Essential
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="checkbox" name="is_recommended" class="form-check-input" id="edit_recommended_{{ $item->id }}" value="1" {{ $item->is_recommended ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="edit_recommended_{{ $item->id }}">Recommended</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary rounded-pill" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); border: none;">Update Item</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-clipboard-list fa-3x text-light mb-3"></i>
                        <p class="text-muted">No items yet. Add your first item!</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
