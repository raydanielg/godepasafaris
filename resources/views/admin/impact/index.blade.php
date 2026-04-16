@extends('layouts.admin')

@section('title', 'Impact / Giving Back')

@section('content')
<div class="container-fluid p-0 py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 px-3">
        <div>
            <h2 class="h4 mb-0 text-gray-800 fw-bold">Giving Back / Impact Management</h2>
            <p class="text-muted small mb-0">Manage impact page content, stories, gallery, and partners.</p>
        </div>
        <a href="{{ url('/impact') }}" target="_blank" class="btn btn-outline-primary">
            <i class="fas fa-eye me-2"></i>View Impact Page
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4 px-3">
        <div class="col-md-4 col-lg-2">
            <div class="stat-card h-100">
                <div class="stat-icon bg-earth-light"><i class="fas fa-chart-line"></i></div>
                <h4 class="fw-bold mb-1">{{ $stats['total_stats'] }}</h4>
                <p class="text-muted mb-0 small">Impact Stats</p>
                <small class="text-success">{{ $stats['active_stats'] }} Active</small>
            </div>
        </div>
        <div class="col-md-4 col-lg-2">
            <div class="stat-card h-100">
                <div class="stat-icon bg-earth-light"><i class="fas fa-book-open"></i></div>
                <h4 class="fw-bold mb-1">{{ $stats['total_stories'] }}</h4>
                <p class="text-muted mb-0 small">Success Stories</p>
                <small class="text-success">{{ $stats['active_stories'] }} Active</small>
            </div>
        </div>
        <div class="col-md-4 col-lg-2">
            <div class="stat-card h-100">
                <div class="stat-icon bg-earth-light"><i class="fas fa-images"></i></div>
                <h4 class="fw-bold mb-1">{{ $stats['total_gallery'] }}</h4>
                <p class="text-muted mb-0 small">Gallery Items</p>
                <small class="text-success">{{ $stats['active_gallery'] }} Active</small>
            </div>
        </div>
        <div class="col-md-4 col-lg-2">
            <div class="stat-card h-100">
                <div class="stat-icon bg-earth-light"><i class="fas fa-history"></i></div>
                <h4 class="fw-bold mb-1">{{ $stats['total_timeline'] }}</h4>
                <p class="text-muted mb-0 small">Timeline Events</p>
            </div>
        </div>
        <div class="col-md-4 col-lg-2">
            <div class="stat-card h-100">
                <div class="stat-icon bg-earth-light"><i class="fas fa-handshake"></i></div>
                <h4 class="fw-bold mb-1">{{ $stats['total_partners'] }}</h4>
                <p class="text-muted mb-0 small">Partners</p>
            </div>
        </div>
    </div>

    <!-- Management Sections -->
    <div class="row g-4 px-3">
        <!-- Stats Management -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: rgba(139,69,19,0.1);">
                            <i class="fas fa-chart-line" style="color: #8b4513; font-size: 1.3rem;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Impact Stats</h5>
                            <small class="text-muted">Animated counters</small>
                        </div>
                    </div>
                    <p class="text-muted mb-3">Manage the statistics displayed on the impact page counters section.</p>
                    <a href="{{ route('admin.impact.stats') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-cog me-2"></i>Manage Stats
                    </a>
                </div>
            </div>
        </div>

        <!-- Stories Management -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: rgba(139,69,19,0.1);">
                            <i class="fas fa-book-open" style="color: #8b4513; font-size: 1.3rem;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Success Stories</h5>
                            <small class="text-muted">Real life testimonials</small>
                        </div>
                    </div>
                    <p class="text-muted mb-3">Add, edit, or remove success stories from people whose lives have been transformed.</p>
                    <a href="{{ route('admin.impact.stories') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-cog me-2"></i>Manage Stories
                    </a>
                </div>
            </div>
        </div>

        <!-- Gallery Management -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: rgba(139,69,19,0.1);">
                            <i class="fas fa-images" style="color: #8b4513; font-size: 1.3rem;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Gallery</h5>
                            <small class="text-muted">Impact moments</small>
                        </div>
                    </div>
                    <p class="text-muted mb-3">Upload and manage images showcasing your impact work and community engagement.</p>
                    <a href="{{ route('admin.impact.gallery') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-cog me-2"></i>Manage Gallery
                    </a>
                </div>
            </div>
        </div>

        <!-- Timeline Management -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: rgba(139,69,19,0.1);">
                            <i class="fas fa-history" style="color: #8b4513; font-size: 1.3rem;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Timeline</h5>
                            <small class="text-muted">Milestones & history</small>
                        </div>
                    </div>
                    <p class="text-muted mb-3">Manage the timeline showing your organization's journey and key milestones.</p>
                    <a href="{{ route('admin.impact.timeline') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-cog me-2"></i>Manage Timeline
                    </a>
                </div>
            </div>
        </div>

        <!-- Partners Management -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: rgba(139,69,19,0.1);">
                            <i class="fas fa-handshake" style="color: #8b4513; font-size: 1.3rem;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Partners</h5>
                            <small class="text-muted">Collaborating organizations</small>
                        </div>
                    </div>
                    <p class="text-muted mb-3">Manage partner organizations and NGOs you collaborate with for community impact.</p>
                    <a href="{{ route('admin.impact.partners') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-cog me-2"></i>Manage Partners
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
