@extends('layouts.admin')

@section('title', 'Manage Bookings')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Customer Inquiries</h3>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4">Customer</th>
                        <th class="border-0">Phone</th>
                        <th class="border-0">Tour/Interested In</th>
                        <th class="border-0">Travel Date</th>
                        <th class="border-0">Travelers</th>
                        <th class="border-0">Status</th>
                        <th class="border-0 text-end px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td class="px-4">
                            <p class="fw-bold mb-0 small">{{ $booking->name }}</p>
                            <small class="text-muted">{{ $booking->email }}</small>
                        </td>
                        <td><span class="small">{{ $booking->phone ?? 'N/A' }}</span></td>
                        <td><span class="small">{{ $booking->tour_name ?? 'General Inquiry' }}</span></td>
                        <td><span class="small">{{ $booking->travel_date ? $booking->travel_date->format('M d, Y') : 'Not Set' }}</span></td>
                        <td><span class="small">{{ $booking->travelers ?? 'N/A' }}</span></td>
                        <td><span class="badge bg-success-subtle text-success rounded-pill px-3 text-uppercase" style="font-size: 0.65rem;">{{ $booking->status }}</span></td>
                        <td class="text-end px-4">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                    <li><a class="dropdown-item py-2" href="#"><i class="fas fa-eye me-2"></i> View Details</a></li>
                                    <li><a class="dropdown-item py-2 text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">No inquiries found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($bookings->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $bookings->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
