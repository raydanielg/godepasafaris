<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-0 bg-earth text-white p-4 rounded-top-4">
                <h5 class="modal-title fw-bold" id="bookingModalLabel">Book Your Safari</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="bookingForm" action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tour_id" id="modal_tour_id">
                    <input type="hidden" name="tour_name" id="modal_tour_name">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-user text-earth"></i></span>
                                <input type="text" name="name" class="form-control bg-light border-0" placeholder="John Doe" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-envelope text-earth"></i></span>
                                <input type="email" name="email" class="form-control bg-light border-0" placeholder="john@example.com" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-phone text-earth"></i></span>
                                <input type="tel" name="phone" class="form-control bg-light border-0" placeholder="+255..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Travel Date</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0" onclick="this.nextElementSibling.showPicker()" style="cursor: pointer;"><i class="fas fa-calendar-alt text-earth"></i></span>
                                <input type="date" name="travel_date" class="form-control bg-light border-0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Number of Travelers</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-users text-earth"></i></span>
                                <select name="travelers" class="form-select bg-light border-0" required>
                                    @for($i=1; $i<=10; $i++)
                                        <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'Person' : 'People' }}</option>
                                    @endfor
                                    <option value="11+">11+ People</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Accommodation Preference</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-hotel text-earth"></i></span>
                                <select name="accommodation" class="form-select bg-light border-0">
                                    <option value="luxury">Luxury Lodge</option>
                                    <option value="mid_range" selected>Mid-Range Lodge</option>
                                    <option value="budget">Budget Camping</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase">Special Requests / Message</label>
                            <textarea name="message" class="form-control bg-light border-0" rows="3" placeholder="Tell us more about your dream safari..."></textarea>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-earth w-100 py-3 rounded-pill fw-bold text-white">Confirm Booking Inquiry</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    #bookingModal .form-control:focus, #bookingModal .form-select:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.1);
        border: 1px solid #8b4513 !important;
    }
    #bookingModal .input-group-text {
        color: #666;
    }
    .bg-earth {
        background-color: #8b4513 !important;
    }
    .text-earth {
        color: #8b4513 !important;
    }
    .btn-earth {
        background-color: #8b4513 !important;
        border-color: #8b4513 !important;
    }
    .btn-earth:hover {
        background-color: #a0522d !important;
        border-color: #a0522d !important;
    }
</style>
