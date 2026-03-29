@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Announcements</h1>
            <p class="text-muted small mb-0">Manage top-bar announcements for your website</p>
        </div>
        <button type="button" class="btn btn-earth px-4 rounded-pill fw-bold text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal" style="background-color: #8b4513;">
            <i class="fas fa-plus me-2"></i>Add New
        </button>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #3E2723;">
            <i class="fas fa-bullhorn text-white me-2"></i>
            <h6 class="m-0 font-weight-bold text-white">All Announcements</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #fdfaf5;">
                        <tr class="text-uppercase small fw-bold text-muted">
                            <th class="ps-4">Content</th>
                            <th>Status</th>
                            <th>Target Link</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($announcements as $announcement)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="fw-bold text-dark small">{{ $announcement->content }}</div>
                                <div class="text-muted smaller" style="font-size: 0.7rem;">{{ $announcement->created_at->format('M d, Y') }}</div>
                            </td>
                            <td>
                                <form action="{{ route('admin.announcements.status', $announcement) }}" method="POST" class="d-inline">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="form-select form-select-sm rounded-pill border-0 shadow-sm" 
                                            style="width: 100px; font-size: 0.7rem; background-color: {{ $announcement->status === 'active' ? '#e8f5e9' : '#ffebee' }}; color: {{ $announcement->status === 'active' ? '#2e7d32' : '#c62828' }};">
                                        <option value="active" {{ $announcement->status === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="expired" {{ $announcement->status === 'expired' ? 'selected' : '' }}>Expired</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                @if($announcement->link)
                                    <a href="{{ $announcement->link }}" target="_blank" class="text-decoration-none smaller" style="color: #8b4513;">
                                        {{ $announcement->button_text ?: 'View Link' }} <i class="fas fa-external-link-alt ms-1"></i>
                                    </a>
                                @else
                                    <span class="text-muted smaller italic">None</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <form action="{{ route('admin.announcements.delete', $announcement) }}" method="POST" onsubmit="return confirm('Delete this announcement?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" style="font-size: 0.7rem;">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($announcements->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $announcements->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add Announcement Modal -->
<div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.announcements.store') }}" method="POST">
            @csrf
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0 pe-4">
                    <h5 class="fw-bold m-0 pt-3 ps-3">New Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Announcement Text</label>
                        <textarea name="content" class="form-control" rows="3" required placeholder="e.g. Special offer! 20% off on Safari packages..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Link (Optional)</label>
                        <input type="url" name="link" class="form-control" placeholder="https://...">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Button Text</label>
                            <input type="text" name="button_text" class="form-control" placeholder="e.g. Book Now">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Initial Status</label>
                            <select name="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="expired">Expired</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light px-4 rounded-pill fw-bold border" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-earth px-4 rounded-pill fw-bold text-white shadow-sm" style="background-color: #8b4513;">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
