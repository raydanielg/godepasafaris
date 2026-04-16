@extends('layouts.admin')

@section('title', 'Impact Partners')

@section('content')
<div class="container-fluid p-0 py-2">
    <div class="d-flex justify-content-between align-items-center mb-4 px-3">
        <div>
            <h2 class="h4 mb-0 text-gray-800 fw-bold">Partners</h2>
            <p class="text-muted small mb-0">Manage collaborating organizations.</p>
        </div>
        <a href="{{ route('admin.impact.partners.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Partner
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mx-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">Icon</th>
                            <th class="py-3">Name</th>
                            <th class="py-3">Description</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partners as $partner)
                        <tr>
                            <td class="px-4 py-3"><i class="fas {{ $partner->icon }}" style="color: #8b4513;"></i></td>
                            <td class="py-3 fw-medium">{{ $partner->name }}</td>
                            <td class="py-3 text-muted">{{ Str::limit($partner->description, 50) }}</td>
                            <td class="py-3">
                                <span class="badge {{ $partner->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $partner->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="py-3 text-end pe-4">
                                <form action="{{ route('admin.impact.partners.toggle', $partner) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-{{ $partner->is_active ? 'warning' : 'success' }} me-1">
                                        <i class="fas {{ $partner->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>
                                <a href="{{ route('admin.impact.partners.edit', $partner) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.impact.partners.delete', $partner) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                <p class="mb-0">No partners found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="px-3 mt-3">
        {{ $partners->links() }}
    </div>

    <div class="px-3 mt-3">
        <a href="{{ route('admin.impact.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>
</div>
@endsection
