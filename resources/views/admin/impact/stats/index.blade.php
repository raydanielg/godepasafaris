@extends('layouts.admin')

@section('title', 'Impact Stats')

@section('content')
<div class="container-fluid p-0 py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 px-3">
        <div>
            <h2 class="h4 mb-0 text-gray-800 fw-bold">Impact Statistics</h2>
            <p class="text-muted small mb-0">Manage animated counter statistics.</p>
        </div>
        <a href="{{ route('admin.impact.stats.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Stat
        </a>
    </div>

    <!-- Stats Table -->
    <div class="card border-0 shadow-sm rounded-4 mx-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">Order</th>
                            <th class="py-3">Icon</th>
                            <th class="py-3">Label</th>
                            <th class="py-3">Value</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats as $stat)
                        <tr>
                            <td class="px-4 py-3">{{ $stat->display_order }}</td>
                            <td class="py-3"><i class="fas {{ $stat->icon }}" style="color: #8b4513;"></i></td>
                            <td class="py-3 fw-medium">{{ $stat->label }}</td>
                            <td class="py-3">{{ number_format($stat->value) }}{{ $stat->suffix }}</td>
                            <td class="py-3">
                                <span class="badge {{ $stat->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $stat->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="py-3 text-end pe-4">
                                <form action="{{ route('admin.impact.stats.toggle', $stat) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-{{ $stat->is_active ? 'warning' : 'success' }} me-1">
                                        <i class="fas {{ $stat->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>
                                <a href="{{ route('admin.impact.stats.edit', $stat) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.impact.stats.delete', $stat) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                <p class="mb-0">No stats found. Create your first stat!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="px-3 mt-3">
        {{ $stats->links() }}
    </div>

    <div class="px-3 mt-3">
        <a href="{{ route('admin.impact.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Impact Dashboard
        </a>
    </div>
</div>
@endsection
