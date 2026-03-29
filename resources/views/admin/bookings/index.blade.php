@extends('layouts.admin')

@section('title', 'Manage Bookings')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Customer Inquiries</h1>
            <p class="text-muted small mb-0">Track and respond to tour booking inquiries</p>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #3E2723;">
            <i class="fas fa-calendar-check text-white me-2"></i>
            <h6 class="m-0 font-weight-bold text-white">Latest Booking Requests</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #fdfaf5;">
                        <tr class="text-uppercase small fw-bold text-muted">
                            <th class="ps-4">Customer</th>
                            <th>Contact Info</th>
                            <th>Interested In</th>
                            <th>Travel Details</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle-sm me-3 d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" 
                                         style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(45deg, #3E2723, #5d4037);">
                                        {{ strtoupper(substr($booking->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark small">{{ $booking->name }}</div>
                                        <div class="smaller text-muted" style="font-size: 0.7rem;">{{ $booking->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="smaller text-dark" style="font-size: 0.75rem;">
                                    <div><i class="fas fa-envelope me-1 text-muted"></i>{{ $booking->email }}</div>
                                    <div><i class="fas fa-phone me-1 text-muted"></i>{{ $booking->phone ?? 'N/A' }}</div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border rounded-pill px-3 py-1 smaller fw-medium" style="font-size: 0.7rem;">
                                    {{ $booking->tour_name ?? 'General Inquiry' }}
                                </span>
                            </td>
                            <td>
                                <div class="smaller text-dark" style="font-size: 0.75rem;">
                                    <div><i class="far fa-calendar-alt me-1 text-muted"></i>{{ $booking->travel_date ? $booking->travel_date->format('M d, Y') : 'Date: Not Set' }}</div>
                                    <div><i class="fas fa-users me-1 text-muted"></i>{{ $booking->travelers ?? 'N/A' }} travelers</div>
                                </div>
                            </td>
                            <td>
                                @php
                                    $statusColor = match($booking->status) {
                                        'confirmed' => ['bg' => '#e8f5e9', 'text' => '#2e7d32'],
                                        'cancelled' => ['bg' => '#ffebee', 'text' => '#c62828'],
                                        default => ['bg' => '#fff3e0', 'text' => '#ef6c00'],
                                    };
                                @endphp
                                <span class="badge rounded-pill px-3 py-1 smaller fw-medium text-uppercase" 
                                      style="background-color: {{ $statusColor['bg'] }}; color: {{ $statusColor['text'] }}; font-size: 0.65rem;">
                                    {{ $booking->status ?: 'Pending' }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" style="font-size: 0.7rem;">
                                        View
                                    </a>
                                    <a href="{{ route('admin.bookings.invoice', $booking) }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold" style="font-size: 0.7rem;">
                                        Invoice
                                    </a>
                                    <form action="{{ route('admin.bookings.delete', $booking) }}" method="POST" onsubmit="return confirm('Delete this inquiry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" style="font-size: 0.7rem;">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-calendar-check fa-3x text-light mb-3"></i>
                                <p class="text-muted small">No inquiries found yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($bookings->hasPages())
            <div class="card-footer bg-white border-0 py-3 text-center">
                {{ $bookings->links() }}
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
</style>
@endsection
