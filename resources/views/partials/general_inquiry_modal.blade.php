<div class="modal fade" id="generalInquiryModal" tabindex="-1" aria-labelledby="generalInquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-0 bg-earth p-4 rounded-top-4 d-flex justify-content-between align-items-center" style="background-color: #8b4513 !important;">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; flex-shrink: 0;">
                        <i class="fas fa-paper-plane text-earth" style="color: #8b4513 !important;"></i>
                    </div>
                    <div class="text-white">
                        <h5 class="modal-title fw-bold mb-0 text-white" id="generalInquiryModalLabel" style="color: #ffffff !important;">Plan Your Dream Adventure</h5>
                        <p class="text-white small mb-0 opacity-75" style="color: rgba(255,255,255,0.75) !important;">Tell us what you're looking for, and we'll craft it for you.</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
            </div>
            <div class="modal-body p-4 p-md-5">
                <form id="generalInquiryForm" action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <!-- Personal Info -->
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
                        
                        <!-- Trip Details -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Interested In</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-map-marked-alt text-earth"></i></span>
                                <select name="tour_name" class="form-select bg-light border-0" id="inquiry_tour_select">
                                    <option value="General Inquiry" selected>General Inquiry / Not Sure Yet</option>
                                    @if(isset($allTourOptions))
                                        @foreach($allTourOptions as $option)
                                            <option value="{{ $option->title }}">{{ $option->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Approximate Travel Date</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-calendar-alt text-earth"></i></span>
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

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase">Tell us about your requirements</label>
                            <textarea name="message" class="form-control bg-light border-0" rows="4" placeholder="Mention preferred activities, budget, accommodation style, or any special needs..."></textarea>
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <button type="submit" class="btn btn-earth px-5 py-3 rounded-pill fw-bold text-white shadow-sm w-100">
                            SEND INQUIRY NOW <i class="fas fa-chevron-right ms-2"></i>
                        </button>
                        <p class="text-muted small mt-3 mb-0">
                            <i class="fas fa-lock me-1"></i> Your details are safe with us. We usually respond within 2-4 hours.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    #generalInquiryModal .form-control:focus, #generalInquiryModal .form-select:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.1);
        border: 1px solid #8b4513 !important;
    }
    #generalInquiryModal .input-group-text {
        color: #666;
    }
</style>
