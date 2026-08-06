@extends('layouts.admin')

@section('title', 'Manage Bookings')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Customer Inquiries</h1>
            <p class="text-muted small mb-0">Track and respond to tour booking inquiries</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <button type="button" id="testEmailBtn" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold">
                <i class="fas fa-paper-plane me-1"></i>Send Test Notification
            </button>
            <button type="button" id="deleteAllBtn" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" {{ $bookings->total() ? '' : 'disabled' }}>
                <i class="fas fa-trash-alt me-1"></i>Delete All Bookings
            </button>
            <button type="button" id="restartBtn" class="btn btn-sm rounded-pill px-3 fw-bold text-white" style="background-color: #8b4513;">
                <i class="fas fa-power-off me-1"></i>Restart Booking System
            </button>
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
                        <tr data-booking-id="{{ $booking->id }}">
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
                                        'confirmed'  => ['bg' => '#e8f5e9', 'text' => '#2e7d32'],
                                        'cancelled'  => ['bg' => '#ffebee', 'text' => '#c62828'],
                                        'spam'       => ['bg' => '#424242', 'text' => '#ffffff'],
                                        'contacted'  => ['bg' => '#e3f2fd', 'text' => '#1565c0'],
                                        'quoted'     => ['bg' => '#ede7f6', 'text' => '#4527a0'],
                                        'new'        => ['bg' => '#e1f5fe', 'text' => '#0277bd'],
                                        default      => ['bg' => '#fff3e0', 'text' => '#ef6c00'],
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
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                    <a href="{{ route('admin.bookings.invoice', $booking) }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold" style="font-size: 0.7rem;">
                                        <i class="fas fa-file-invoice me-1"></i>Invoice
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 fw-bold" 
                                            onclick="openEmailModal({{ $booking->id }}, '{{ $booking->name }}', '{{ $booking->email }}', '{{ $booking->tour_name }}')"
                                            style="font-size: 0.7rem;">
                                        <i class="fas fa-envelope me-1"></i>Email
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold delete-btn" 
                                            data-booking-id="{{ $booking->id }}" 
                                            data-customer-name="{{ $booking->name }}"
                                            style="font-size: 0.7rem;">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
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

<!-- Email Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
                <h5 class="modal-title text-white fw-bold">
                    <i class="fas fa-envelope me-2"></i>Send Email to Customer
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="emailForm">
                    @csrf
                    <input type="hidden" id="bookingId" name="booking_id">
                    <div class="mb-3">
                        <label class="form-label fw-bold">To:</label>
                        <input type="email" class="form-control" id="customerEmail" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Subject:</label>
                        <input type="text" class="form-control" id="emailSubject" value="Regarding Your Safari Booking Inquiry">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Message:</label>
                        <textarea class="form-control" id="emailMessage" rows="8" placeholder="Type your message here..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-earth text-white rounded-pill px-4" id="sendEmailBtn" style="background-color: #8b4513;">
                    <i class="fas fa-paper-plane me-2"></i>Send Email
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Global function to open email modal - defined immediately
    window.openEmailModal = function(bookingId, customerName, customerEmail, tourName) {
        try {
            document.getElementById('bookingId').value = bookingId;
            document.getElementById('customerEmail').value = customerEmail;
            document.getElementById('emailSubject').value = `Regarding Your Safari Booking Inquiry - ${tourName}`;
            document.getElementById('emailMessage').value = `Dear ${customerName},\n\nThank you for your interest in ${tourName}. We have received your inquiry and will get back to you shortly.\n\nBest regards,\nGo Deep Africa Safari Team`;
            
            // Show modal using Bootstrap
            const modal = new bootstrap.Modal(document.getElementById('emailModal'));
            modal.show();
        } catch (error) {
            console.error('Error opening email modal:', error);
            alert('Error: ' + error.message);
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        // Read the CSRF token defensively. If the layout's <meta name="csrf-token">
        // is missing (e.g. a stale cached admin view on the server), fall back to
        // an empty string instead of throwing — a throw here would leave the
        // "Deleting..." spinner open forever, which looked like a broken button.
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';
        if (!csrfToken) {
            console.error('CSRF token meta tag is missing — booking actions may fail. Clear the server view cache.');
        }

        // Delete button click handler
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const bookingId = this.getAttribute('data-booking-id');
                const customerName = this.getAttribute('data-customer-name');
                const row = this.closest('tr');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete the inquiry from "${customerName}". This action cannot be undone!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash me-2"></i>Yes, delete it!',
                    cancelButtonText: '<i class="fas fa-times me-2"></i>Cancel',
                    customClass: {
                        confirmButton: 'rounded-pill px-4',
                        cancelButton: 'rounded-pill px-4'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Deleting...',
                            text: 'Please wait while we delete the inquiry',
                            icon: 'info',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // Send AJAX request. Use a real method override header so
                        // Laravel routes it to the DELETE route reliably, and Accept:
                        // application/json so errors come back as JSON we can read.
                        fetch(`{{ route('admin.bookings.delete', ':id') }}`.replace(':id', bookingId), {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'X-HTTP-METHOD-OVERRIDE': 'DELETE'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Inquiry has been deleted successfully.',
                                    icon: 'success',
                                    confirmButtonColor: '#8b4513',
                                    confirmButtonText: '<i class="fas fa-check me-2"></i>OK',
                                    customClass: {
                                        confirmButton: 'rounded-pill px-4'
                                    }
                                }).then(() => {
                                    // Remove row with animation
                                    row.style.transition = 'all 0.3s ease';
                                    row.style.opacity = '0';
                                    row.style.transform = 'translateX(100px)';
                                    setTimeout(() => {
                                        row.remove();
                                        // Check if table is empty
                                        if (document.querySelectorAll('tbody tr').length === 0) {
                                            location.reload();
                                        }
                                    }, 300);
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.message || 'Failed to delete inquiry. Please try again.',
                                    icon: 'error',
                                    confirmButtonColor: '#dc3545',
                                    confirmButtonText: '<i class="fas fa-times me-2"></i>OK',
                                    customClass: {
                                        confirmButton: 'rounded-pill px-4'
                                    }
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while deleting the inquiry.',
                                icon: 'error',
                                confirmButtonColor: '#dc3545',
                                confirmButtonText: '<i class="fas fa-times me-2"></i>OK',
                                customClass: {
                                    confirmButton: 'rounded-pill px-4'
                                }
                            });
                        });
                    }
                });
            });
        });
        
        // ---- Bulk booking tools (Delete All / Restart / Test notification) ----
        // Reuses the safe `csrfToken` defined at the top of this handler.
        function postAction(url, { method = 'POST', override = null, loadingText = 'Working...' } = {}) {
            Swal.fire({
                title: loadingText,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => Swal.showLoading()
            });

            const headers = { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' };
            if (override) headers['X-HTTP-METHOD-OVERRIDE'] = override;

            return fetch(url, { method, headers })
                .then(r => r.json())
                .then(data => {
                    Swal.fire({
                        title: data.success ? 'Done!' : 'Error!',
                        text: data.message || (data.success ? 'Completed.' : 'Something went wrong.'),
                        icon: data.success ? 'success' : 'error',
                        confirmButtonColor: data.success ? '#8b4513' : '#dc3545',
                        customClass: { confirmButton: 'rounded-pill px-4' }
                    }).then(() => { if (data.success) location.reload(); });
                })
                .catch(() => {
                    Swal.fire({ title: 'Error!', text: 'A network error occurred. Please try again.', icon: 'error',
                        confirmButtonColor: '#dc3545', customClass: { confirmButton: 'rounded-pill px-4' } });
                });
        }

        // Delete All Bookings (type-to-confirm)
        const deleteAllBtn = document.getElementById('deleteAllBtn');
        if (deleteAllBtn) {
            deleteAllBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Delete ALL bookings?',
                    html: 'This permanently removes <b>every</b> inquiry in the list. This cannot be undone.<br><br>Type <b>DELETE</b> to confirm:',
                    icon: 'warning',
                    input: 'text',
                    inputPlaceholder: 'DELETE',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash-alt me-2"></i>Delete all',
                    customClass: { confirmButton: 'rounded-pill px-4', cancelButton: 'rounded-pill px-4' },
                    preConfirm: (value) => {
                        if ((value || '').trim().toUpperCase() !== 'DELETE') {
                            Swal.showValidationMessage('Please type DELETE to confirm.');
                            return false;
                        }
                        return true;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        postAction(`{{ route('admin.bookings.delete-all') }}`, { override: 'DELETE', loadingText: 'Deleting all bookings...' });
                    }
                });
            });
        }

        // Restart Booking System (full reset to #1, type-to-confirm)
        const restartBtn = document.getElementById('restartBtn');
        if (restartBtn) {
            restartBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Restart the booking system?',
                    html: 'This wipes <b>all</b> bookings, resets the ID counter so the next booking is <b>#1</b>, and clears the booking log.<br><br>Type <b>RESTART</b> to confirm:',
                    icon: 'warning',
                    input: 'text',
                    inputPlaceholder: 'RESTART',
                    showCancelButton: true,
                    confirmButtonColor: '#8b4513',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-power-off me-2"></i>Restart system',
                    customClass: { confirmButton: 'rounded-pill px-4', cancelButton: 'rounded-pill px-4' },
                    preConfirm: (value) => {
                        if ((value || '').trim().toUpperCase() !== 'RESTART') {
                            Swal.showValidationMessage('Please type RESTART to confirm.');
                            return false;
                        }
                        return true;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        postAction(`{{ route('admin.bookings.restart') }}`, { loadingText: 'Restarting booking system...' });
                    }
                });
            });
        }

        // Send Test Notification (no confirmation needed — harmless)
        const testEmailBtn = document.getElementById('testEmailBtn');
        if (testEmailBtn) {
            testEmailBtn.addEventListener('click', function() {
                postAction(`{{ route('admin.bookings.test-email') }}`, { loadingText: 'Sending test notification...' });
            });
        }

        // Send email button click handler
        document.getElementById('sendEmailBtn').addEventListener('click', function() {
            const bookingId = document.getElementById('bookingId').value;
            const customerEmail = document.getElementById('customerEmail').value;
            const subject = document.getElementById('emailSubject').value;
            const message = document.getElementById('emailMessage').value;
            
            if (!message.trim()) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Please enter a message.',
                    icon: 'error',
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: '<i class="fas fa-times me-2"></i>OK',
                    customClass: {
                        confirmButton: 'rounded-pill px-4'
                    }
                });
                return;
            }
            
            // Show loading
            Swal.fire({
                title: 'Sending...',
                text: 'Please wait while we send the email',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Send AJAX request to send email
            fetch(`{{ route('admin.bookings.send-email', ':id') }}`.replace(':id', bookingId), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    subject: subject,
                    message: message
                })
            })
            .then(response => response.json())
            .then(data => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('emailModal'));
                modal.hide();
                
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonColor: '#8b4513',
                        confirmButtonText: '<i class="fas fa-check me-2"></i>OK',
                        customClass: {
                            confirmButton: 'rounded-pill px-4'
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Failed to send email. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: '<i class="fas fa-times me-2"></i>OK',
                        customClass: {
                            confirmButton: 'rounded-pill px-4'
                        }
                    });
                }
            })
            .catch(error => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('emailModal'));
                modal.hide();
                
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while sending the email.',
                    icon: 'error',
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: '<i class="fas fa-times me-2"></i>OK',
                    customClass: {
                        confirmButton: 'rounded-pill px-4'
                    }
                });
            });
        });
    });
</script>
<style>
    .btn-earth:hover {
        background-color: #3E2723 !important;
        opacity: 0.9;
    }
    .smaller { font-size: 0.8rem; }
    
    /* SweetAlert custom styles */
    .swal2-popup {
        border-radius: 1rem !important;
    }
    .swal2-title {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    }
    .swal2-content {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    }
</style>
@endpush
@endsection
