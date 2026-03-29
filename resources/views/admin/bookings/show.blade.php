@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Inquiry Details</h1>
            <p class="text-muted small mb-0">Reviewing request from {{ $booking->name }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.bookings.invoice', $booking) }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-file-invoice me-2"></i>Generate Invoice
            </a>
            <a href="{{ route('admin.bookings') }}" class="btn btn-light border px-4 rounded-pill fw-bold shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Customer & Tour Info -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-4" style="color: #3E2723;">Tour Information</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="small text-muted text-uppercase fw-bold">Tour Name</label>
                        <p class="fw-bold text-dark fs-5">{{ $booking->tour_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="small text-muted text-uppercase fw-bold">Package ID</label>
                        <p class="text-dark">#{{ $booking->tour_id }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="small text-muted text-uppercase fw-bold">Travel Date</label>
                        <p class="text-dark">{{ $booking->travel_date ? $booking->travel_date->format('M d, Y') : 'Not specified' }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="small text-muted text-uppercase fw-bold">Travelers</label>
                        <p class="text-dark">{{ $booking->travelers }} Person(s)</p>
                    </div>
                    <div class="col-md-4">
                        <label class="small text-muted text-uppercase fw-bold">Accommodation</label>
                        <p class="text-dark text-capitalize">{{ $booking->accommodation ?? 'Standard' }}</p>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h5 class="fw-bold mb-4" style="color: #3E2723;">Customer Message</h5>
                <div class="p-3 rounded-3 bg-light" style="min-height: 150px;">
                    {!! nl2br(e($booking->message)) !!}
                </div>
            </div>
        </div>

        <!-- Sidebar Info & Actions -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-4" style="color: #3E2723;">Customer Contact</h5>
                <div class="mb-3">
                    <label class="small text-muted text-uppercase fw-bold d-block">Full Name</label>
                    <span class="text-dark fw-bold">{{ $booking->name }}</span>
                </div>
                <div class="mb-3">
                    <label class="small text-muted text-uppercase fw-bold d-block">Email Address</label>
                    <a href="mailto:{{ $booking->email }}" class="text-primary text-decoration-none">{{ $booking->email }}</a>
                </div>
                <div class="mb-3">
                    <label class="small text-muted text-uppercase fw-bold d-block">Phone Number</label>
                    <a href="tel:{{ $booking->phone }}" class="text-dark text-decoration-none">{{ $booking->phone }}</a>
                </div>
                <hr>
                <div class="mb-0">
                    <label class="small text-muted text-uppercase fw-bold d-block mb-2">Inquiry Status</label>
                    <form action="{{ route('admin.bookings.status', $booking) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-select rounded-3 mb-3" onchange="this.form.submit()">
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending Review</option>
                            <option value="contacted" {{ $booking->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                            <option value="quoted" {{ $booking->status == 'quoted' ? 'selected' : '' }}>Invoice Sent</option>
                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4 p-4 bg-light">
                <h5 class="fw-bold mb-3">Quick Actions</h5>
                <div class="d-grid gap-2">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->phone) }}" target="_blank" class="btn btn-success rounded-pill shadow-sm">
                        <i class="fab fa-whatsapp me-2"></i>Chat on WhatsApp
                    </a>
                    <form action="{{ route('admin.bookings.delete', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this inquiry forever?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                            <i class="fas fa-trash-alt me-2"></i>Delete Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
