@extends('layouts.admin')

@section('title', 'Impact Timeline')

@section('content')
<div class="container-fluid p-0 py-2">
    <div class="d-flex justify-content-between align-items-center mb-4 px-3">
        <div>
            <h2 class="h4 mb-0 text-gray-800 fw-bold">Timeline Events</h2>
            <p class="text-muted small mb-0">Manage impact milestones and history.</p>
        </div>
        <a href="{{ route('admin.impact.timeline.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Event
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mx-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">Year</th>
                            <th class="py-3">Title</th>
                            <th class="py-3">Description</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($timeline as $event)
                        <tr>
                            <td class="px-4 py-3 fw-bold" style="color: #8b4513;">{{ $event->year }}</td>
                            <td class="py-3 fw-medium">{{ $event->title }}</td>
                            <td class="py-3 text-muted">{{ Str::limit($event->description, 60) }}</td>
                            <td class="py-3">
                                <span class="badge {{ $event->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $event->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="py-3 text-end pe-4">
                                <form action="{{ route('admin.impact.timeline.toggle', $event) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-{{ $event->is_active ? 'warning' : 'success' }} me-1">
                                        <i class="fas {{ $event->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>
                                <a href="{{ route('admin.impact.timeline.edit', $event) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.impact.timeline.delete', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                                <p class="mb-0">No timeline events found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="px-3 mt-3">
        {{ $timeline->links() }}
    </div>

    <div class="px-3 mt-3">
        <a href="{{ route('admin.impact.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>
</div>
@endsection
