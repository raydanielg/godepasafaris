<div class="modal fade" id="generalInquiryModal" tabindex="-1" aria-labelledby="generalInquiryModalLabel" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-0 p-4 rounded-top-4 d-flex justify-content-between align-items-center" style="background-color: #8b4513 !important; color: #ffffff !important;">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; flex-shrink: 0;">
                        <i class="fas fa-paper-plane" style="color: #8b4513 !important;"></i>
                    </div>
                    <div style="color: #ffffff !important;">
                        <h5 class="modal-title fw-bold mb-0" id="generalInquiryModalLabel" style="color: #ffffff !important; font-family: 'Playfair Display', serif;">{{ __('messages.inquiry.plan_title') }}</h5>
                        <p class="small mb-0" style="color: rgba(255,255,255,0.8) !important;">{{ __('messages.inquiry.plan_subtitle') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1); opacity: 0.8;"></button>
            </div>
            <div class="modal-body p-4 p-md-5">
                <form id="generalInquiryForm" action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <!-- Personal Info -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">{{ __('messages.booking.full_name') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-user text-earth"></i></span>
                                <input type="text" name="name" class="form-control bg-light border-0" placeholder="John Doe" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">{{ __('messages.booking.email') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-envelope text-earth"></i></span>
                                <input type="email" name="email" class="form-control bg-light border-0" placeholder="john@example.com" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">{{ __('messages.booking.phone') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-phone text-earth"></i></span>
                                <input type="tel" name="phone" class="form-control bg-light border-0" placeholder="+255..." required>
                            </div>
                        </div>
                        
                        <!-- Trip Details -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">{{ __('messages.inquiry.interested_in') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-map-marked-alt text-earth"></i></span>
                                <select name="tour_name" class="form-select bg-light border-0" id="inquiry_tour_select">
                                    <option value="General Inquiry" selected>{{ __('messages.inquiry.general') }}</option>
                                    @if(isset($allTourOptions))
                                        @foreach($allTourOptions as $option)
                                            <option value="{{ $option->title }}">{{ $option->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">{{ __('messages.inquiry.approx_date') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0" onclick="this.nextElementSibling.showPicker()" style="cursor: pointer;"><i class="fas fa-calendar-alt text-earth"></i></span>
                                <input type="date" name="travel_date" class="form-control bg-light border-0" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">{{ __('messages.booking.travelers') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-users text-earth"></i></span>
                                <select name="travelers" class="form-select bg-light border-0" required>
                                    @for($i=1; $i<=10; $i++)
                                        <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? __('messages.inquiry.person') : __('messages.inquiry.people') }}</option>
                                    @endfor
                                    <option value="11+">{{ __('messages.inquiry.plus_people') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase">{{ __('messages.inquiry.requirements') }}</label>
                            <textarea name="message" class="form-control bg-light border-0" rows="4" placeholder="{{ __('messages.inquiry.requirements_placeholder') }}"></textarea>
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <button type="submit" class="btn btn-earth px-5 py-3 rounded-pill fw-bold text-white shadow-sm w-100">
                            {{ __('messages.inquiry.send_now') }} <i class="fas fa-chevron-right ms-2"></i>
                        </button>
                        <p class="text-muted small mt-3 mb-0">
                            <i class="fas fa-lock me-1"></i> {{ __('messages.inquiry.privacy_note') }}
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
    #generalInquiryModal .form-control,
    #generalInquiryModal .form-select,
    #generalInquiryModal textarea {
        font-size: 16px !important;
        padding: 12px 16px !important;
    }
    #generalInquiryModal .form-label {
        font-size: 14px !important;
        font-weight: 600 !important;
    }
    #generalInquiryModal .modal-title {
        font-size: 22px !important;
    }
    #generalInquiryModal .modal-body p {
        font-size: 14px !important;
    }
    #generalInquiryModal button[type="submit"] {
        font-size: 16px !important;
        padding: 14px 24px !important;
    }
    .modal-backdrop,
    .modal-backdrop.show {
        background-color: transparent !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }
    #generalInquiryModal {
        z-index: 1055 !important;
        pointer-events: auto !important;
    }
    #generalInquiryModal .modal-dialog,
    #generalInquiryModal .modal-content {
        pointer-events: auto !important;
    }
</style>
