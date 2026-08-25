@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Site Settings</h1>
            <p class="text-muted small mb-0">Manage your website configuration and AI integrations</p>
        </div>
        <div class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none" style="color: #8b4513;">Dashboard</a></li>
            <li class="breadcrumb-item active">Settings</li>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 animate__animated animate__fadeIn">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 animate__animated animate__fadeIn">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-xl-8">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <!-- General Settings -->
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                    <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #3E2723;">
                        <i class="fas fa-cog text-white me-2"></i>
                        <h6 class="m-0 font-weight-bold text-white">General Configuration</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label small fw-bold text-muted text-uppercase">Site Name</label>
                                <input type="text" name="site_name" class="form-control rounded-3" value="{{ $settings['site_name'] ?? '' }}" style="background-color: #fdfaf5;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted text-uppercase">Contact Email</label>
                                <input type="email" name="contact_email" class="form-control rounded-3" value="{{ $settings['contact_email'] ?? '' }}" style="background-color: #fdfaf5;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted text-uppercase">Contact Phone</label>
                                <input type="text" name="contact_phone" class="form-control rounded-3" value="{{ $settings['contact_phone'] ?? '' }}" style="background-color: #fdfaf5;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AI API Configuration -->
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                    <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #556B2F;">
                        <i class="fas fa-robot text-white me-2"></i>
                        <h6 class="m-0 font-weight-bold text-white">AI Expedition Bot Configuration</h6>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted small mb-4">Set up your AI API keys to power the Expedition Bot on your frontend.</p>
                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label small fw-bold text-muted text-uppercase">OpenAI API Key</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-key text-muted"></i></span>
                                    <input type="password" name="openai_api_key" class="form-control border-start-0" value="{{ $settings['openai_api_key'] ?? '' }}" placeholder="sk-..." style="background-color: #fdfaf5;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted text-uppercase">Anthropic API Key</label>
                                <input type="password" name="anthropic_api_key" class="form-control" value="{{ $settings['anthropic_api_key'] ?? '' }}" placeholder="ant-..." style="background-color: #fdfaf5;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted text-uppercase">Google Gemini Key</label>
                                <input type="password" name="gemini_api_key" class="form-control" value="{{ $settings['gemini_api_key'] ?? '' }}" placeholder="AIza..." style="background-color: #fdfaf5;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mb-5">
                    <button type="submit" class="btn btn-earth px-5 py-3 rounded-pill fw-bold text-white shadow-lg" style="background-color: #8b4513;">
                        <i class="fas fa-save me-2"></i>Apply Changes & Save
                    </button>
                </div>
            </form>
        </div>
        
        <div class="col-xl-4">
            <!-- System Controls -->
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #d32f2f;">
                    <i class="fas fa-tools text-white me-2"></i>
                    <h6 class="m-0 font-weight-bold text-white">Advanced System Tools</h6>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="mb-4">
                        <i class="fas fa-broom fa-3x text-muted mb-3"></i>
                        <h5 class="fw-bold">Website Cache</h5>
                        <p class="text-muted small">If you made changes and they don't appear, use this to clear all cache for all users immediately.</p>
                    </div>
                    <form action="{{ route('admin.settings.clear-cache') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100 py-3 rounded-pill fw-bold shadow-sm" onclick="return confirm('This will clear all system cache. Proceed?')">
                            <i class="fas fa-trash-alt me-2"></i>CLEAR WEBSITE CACHE
                        </button>
                    </form>
                </div>
            </div>

            <!-- Email Delivery -->
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #2e7d32;">
                    <i class="fas fa-paper-plane text-white me-2"></i>
                    <h6 class="m-0 font-weight-bold text-white">Email Delivery</h6>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted small mb-3">
                        Sends a sample booking notification to every inbox below. Use this to confirm
                        booking emails really arrive &mdash; if it fails, the exact mail-server error is shown.
                    </p>

                    <ul class="list-group list-group-flush small mb-3">
                        @foreach (config('mail.booking_recipients') as $recipient)
                            <li class="list-group-item d-flex align-items-center px-0 py-2 border-0">
                                <i class="fas fa-inbox text-muted me-2"></i>
                                <span class="text-truncate">{{ $recipient }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="bg-light rounded-3 p-2 mb-3 small text-muted">
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">SMTP HOST</span>
                            <span class="text-truncate ms-2">{{ config('mail.mailers.smtp.host') }}:{{ config('mail.mailers.smtp.port') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">MAILER</span>
                            <span>{{ config('mail.default') }}</span>
                        </div>
                    </div>

                    <form action="{{ route('admin.bookings.test-email') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-success w-100 py-3 rounded-pill fw-bold shadow-sm">
                            <i class="fas fa-paper-plane me-2"></i>SEND TEST EMAIL
                        </button>
                    </form>
                </div>
            </div>

            <!-- Environment Info -->
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #5d4037;">
                    <i class="fas fa-info-circle text-white me-2"></i>
                    <h6 class="m-0 font-weight-bold text-white">Environment Info</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small fw-bold">LARAVEL</span>
                            <span class="badge bg-light text-dark border rounded-pill">{{ app()->version() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small fw-bold">PHP VERSION</span>
                            <span class="badge bg-light text-dark border rounded-pill">{{ PHP_VERSION }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-earth:hover {
        background-color: #3E2723 !important;
        transform: translateY(-2px);
    }
    .form-control:focus {
        border-color: #deb887;
        box-shadow: 0 0 0 0.2rem rgba(222, 184, 135, 0.25);
    }
</style>
@endsection
