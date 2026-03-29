@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Settings</h1>
            <p class="text-muted small mb-0">Configure your website and system preferences</p>
        </div>
        <div class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none" style="color: #8b4513;">Dashboard</a></li>
            <li class="breadcrumb-item active">Settings</li>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-7">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #3E2723;">
                    <i class="fas fa-cog text-white me-2"></i>
                    <h6 class="m-0 font-weight-bold text-white">General Configuration</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label small fw-bold text-muted text-uppercase">Site Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-globe text-muted"></i></span>
                                    <input type="text" name="site_name" class="form-control border-start-0 ps-0" value="{{ $settings['site_name'] }}" style="background-color: #fdfaf5;">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted text-uppercase">Contact Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" name="contact_email" class="form-control border-start-0 ps-0" value="{{ $settings['contact_email'] }}" style="background-color: #fdfaf5;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted text-uppercase">Contact Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-phone text-muted"></i></span>
                                    <input type="text" name="contact_phone" class="form-control border-start-0 ps-0" value="{{ $settings['contact_phone'] }}" style="background-color: #fdfaf5;">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-earth px-5 rounded-pill fw-bold text-white shadow-sm" style="background-color: #8b4513;">
                                <i class="fas fa-save me-2"></i>Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-xl-5">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #5d4037;">
                    <i class="fas fa-info-circle text-white me-2"></i>
                    <h6 class="m-0 font-weight-bold text-white">System Information</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-box me-3 rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                    <i class="fab fa-laravel text-danger"></i>
                                </div>
                                <span class="fw-medium text-dark">Laravel Version</span>
                            </div>
                            <span class="badge bg-light text-dark border rounded-pill px-3">{{ app()->version() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-box me-3 rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                    <i class="fab fa-php text-primary"></i>
                                </div>
                                <span class="fw-medium text-dark">PHP Version</span>
                            </div>
                            <span class="badge bg-light text-dark border rounded-pill px-3">{{ PHP_VERSION }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-box me-3 rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                    <i class="fas fa-clock text-warning"></i>
                                </div>
                                <span class="fw-medium text-dark">System Timezone</span>
                            </div>
                            <span class="badge bg-light text-dark border rounded-pill px-3">{{ config('app.timezone') }}</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer bg-light border-0 py-3">
                    <p class="mb-0 smaller text-muted text-center italic">
                        <i class="fas fa-shield-alt me-1"></i> System environment is currently healthy.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-earth:hover {
        background-color: #3E2723 !important;
        opacity: 0.9;
    }
    .smaller { font-size: 0.8rem; }
    .form-control:focus {
        border-color: #deb887;
        box-shadow: 0 0 0 0.2rem rgba(222, 184, 135, 0.25);
    }
</style>
@endsection
