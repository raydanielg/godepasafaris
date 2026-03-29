@extends('layouts.admin')

@section('title', 'My Profile')

@section('content')
<div class="container-fluid p-0">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-earth p-4 text-white border-0">
                    <div class="d-flex align-items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=fff&color=8b4513&size=128" class="rounded-circle shadow-sm border border-3 border-white" width="80" height="80">
                        <div>
                            <h3 class="fw-bold mb-1">{{ $user->name }}</h3>
                            <span class="badge bg-white text-earth rounded-pill px-3 py-1 text-uppercase small fw-bold">{{ $user->role }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase fw-bold">Full Name</label>
                            <p class="fs-5 fw-bold text-dark mb-0">{{ $user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase fw-bold">Email Address</label>
                            <p class="fs-5 fw-bold text-dark mb-0">{{ $user->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase fw-bold">Account Role</label>
                            <p class="fs-5 fw-bold text-dark mb-0">{{ ucfirst($user->role) }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase fw-bold">Member Since</label>
                            <p class="fs-5 fw-bold text-dark mb-0">{{ $user->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <hr class="my-5 opacity-10">

                    <div class="danger-zone p-4 rounded-4 bg-danger-subtle border border-danger border-opacity-10">
                        <h5 class="text-danger fw-bold mb-3"><i class="fas fa-exclamation-triangle me-2"></i> Danger Zone</h5>
                        <p class="small text-muted mb-4">Once you delete your account, there is no going back. Please be certain.</p>
                        
                        <button type="button" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            DELETE MY ACCOUNT
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Confirmation Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header border-0 p-4">
                <h5 class="modal-title fw-bold text-danger">Are you absolutely sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <i class="fas fa-user-times fa-4x text-danger mb-4"></i>
                <p class="text-muted">This action will permanently delete your admin account and log you out of the system. This cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">CANCEL</button>
                <form action="{{ route('admin.profile.delete') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">YES, DELETE ACCOUNT</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-earth { background-color: #8b4513 !important; }
    .text-earth { color: #8b4513 !important; }
</style>
@endsection
