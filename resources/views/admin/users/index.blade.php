@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">User Management</h1>
            <p class="text-muted small mb-0">Manage all registered users and their roles</p>
        </div>
        <div class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none" style="color: #8b4513;">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #3E2723;">
            <i class="fas fa-users text-white me-2"></i>
            <h6 class="m-0 font-weight-bold text-white">System Users</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #fdfaf5;">
                        <tr class="text-uppercase small fw-bold text-muted">
                            <th class="ps-4">Name & Email</th>
                            <th>Role</th>
                            <th>Joined</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-3 d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" 
                                         style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(45deg, #8b4513, #deb887);">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark small">{{ $user->name }}</div>
                                        <div class="text-muted smaller">{{ $user->email }}</div>
                                        @if($user->id === auth()->id())
                                            <span class="badge bg-success-soft text-success smaller mt-1" style="background-color: #e8f5e9; color: #2e7d32; font-size: 0.6rem; padding: 1px 6px;">YOU</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @php
                                    $roleColor = match($user->role) {
                                        'admin' => ['bg' => '#ffebee', 'text' => '#c62828', 'label' => 'Admin'],
                                        'sub_admin' => ['bg' => '#e3f2fd', 'text' => '#1565c0', 'label' => 'Sub Admin'],
                                        default => ['bg' => '#f5f5f5', 'text' => '#616161', 'label' => 'User'],
                                    };
                                @endphp
                                <span class="badge rounded-pill px-2 py-1 fw-medium" 
                                      style="background-color: {{ $roleColor['bg'] }}; color: {{ $roleColor['text'] }}; font-size: 0.7rem;">
                                    {{ $roleColor['label'] }}
                                </span>
                            </td>
                            <td>
                                <div class="smaller text-dark" style="font-size: 0.75rem;">{{ $user->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    @if(auth()->user()->isAdmin())
                                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" style="font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#changeRoleModal{{ $user->id }}">
                                            Role
                                        </button>
                                        
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.delete', $user) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" style="font-size: 0.7rem;">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>

                                <!-- Change Role Modal -->
                                <div class="modal fade" id="changeRoleModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <form action="{{ route('admin.users.role', $user) }}" method="POST">
                                            @csrf
                                            <div class="modal-content border-0 shadow-lg rounded-4">
                                                <div class="modal-header border-0 pb-0 pe-4">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center px-4 pt-0">
                                                    <h6 class="fw-bold mb-3">Update Role for {{ $user->name }}</h6>
                                                    
                                                    <div class="text-start">
                                                        <div class="list-group list-group-flush border rounded-3 overflow-hidden">
                                                            <label class="list-group-item list-group-item-action py-2 d-flex align-items-center">
                                                                <input type="radio" name="role" value="user" class="form-check-input me-3" {{ $user->role === 'user' ? 'checked' : '' }}>
                                                                <span class="small">User</span>
                                                            </label>
                                                            <label class="list-group-item list-group-item-action py-2 d-flex align-items-center">
                                                                <input type="radio" name="role" value="sub_admin" class="form-check-input me-3" {{ $user->role === 'sub_admin' ? 'checked' : '' }}>
                                                                <span class="small text-primary">Sub Admin</span>
                                                            </label>
                                                            <label class="list-group-item list-group-item-action py-2 d-flex align-items-center">
                                                                <input type="radio" name="role" value="admin" class="form-check-input me-3" {{ $user->role === 'admin' ? 'checked' : '' }}>
                                                                <span class="small text-danger">Admin</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 px-4 pb-4 justify-content-center">
                                                    <button type="submit" class="btn btn-earth btn-sm px-4 rounded-pill fw-bold text-white shadow-sm" style="background-color: #8b4513;">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $users->links() }}
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
    .table th { letter-spacing: 0.05em; }
    .avatar-circle { font-size: 1.1rem; }
</style>
@endsection
