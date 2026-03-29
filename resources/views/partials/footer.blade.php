<footer class="main-footer pt-5 pb-3">
    <div class="container">
        <div class="row g-4">
            <!-- Brand Info -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-brand mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="trusted-badge small px-2 py-1">TRUSTED SAFARI PARTNER</div>
                    </div>
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Go Deep Africa Safari" class="footer-logo mb-3" style="max-height: 80px;">
                    <p class="small text-start mt-3">
                        Go Deep Africa Safari helps you explore the hidden gems of Tanzania with expert guides and authentic experiences. Built for adventure.
                    </p>
                    <div class="footer-socials-new d-flex gap-2 mt-4">
                        <a href="#" class="social-circle"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-circle"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-circle"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-circle"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading mb-4">Quick Links</h5>
                <ul class="list-unstyled footer-links-new">
                    <li><a href="{{ url('/') }}"><i class="fas fa-chevron-right me-2"></i>Home</a></li>
                    <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right me-2"></i>About Us</a></li>
                    <li><a href="{{ route('tours.all') }}"><i class="fas fa-chevron-right me-2"></i>Safari Packages</a></li>
                    <li><a href="{{ route('how.works') }}"><i class="fas fa-chevron-right me-2"></i>How It Works</a></li>
                    <li><a href="{{ route('testimonials') }}"><i class="fas fa-chevron-right me-2"></i>Testimonials</a></li>
                </ul>
            </div>

            <!-- Safari and Tours -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading mb-4">Destinations</h5>
                <ul class="list-unstyled footer-links-new">
                    <li><a href="{{ route('destinations') }}"><i class="fas fa-chevron-right me-2"></i>Serengeti</a></li>
                    <li><a href="{{ route('destinations') }}"><i class="fas fa-chevron-right me-2"></i>Ngorongoro</a></li>
                    <li><a href="{{ route('kilimanjaro') }}"><i class="fas fa-chevron-right me-2"></i>Kilimanjaro</a></li>
                    <li><a href="{{ route('destinations') }}"><i class="fas fa-chevron-right me-2"></i>Tarangire</a></li>
                    <li><a href="{{ route('destinations') }}"><i class="fas fa-chevron-right me-2"></i>Zanzibar</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading mb-4">Support</h5>
                <ul class="list-unstyled footer-links-new">
                    <li><a href="{{ route('help.center') }}"><i class="fas fa-chevron-right me-2"></i>Help Center</a></li>
                    <li><a href="{{ route('faq') }}"><i class="fas fa-chevron-right me-2"></i>FAQs</a></li>
                    <li><a href="{{ route('privacy') }}"><i class="fas fa-chevron-right me-2"></i>Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}"><i class="fas fa-chevron-right me-2"></i>Terms of Service</a></li>
                </ul>
            </div>

            <!-- Contact & Newsletter -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading mb-4">Contact</h5>
                <div class="footer-contact-info mb-4">
                    <p class="small mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> Arusha, Tanzania</p>
                    <p class="small mb-2"><i class="fas fa-envelope text-primary me-2"></i> info@godeepafricasafari.com</p>
                    <p class="small mb-0"><i class="fas fa-phone-alt text-primary me-2"></i> +255 794 636 471</p>
                </div>

                <div class="stay-updated mt-4">
                    <h5 class="footer-heading mb-3">Newsletter</h5>
                    <p class="small text-muted mb-3">Subscribe for expert travel tips and exclusive safari offers.</p>
                    <form id="newsletterForm" class="newsletter-form-v2">
                        @csrf
                        <div class="subscription-wrapper position-relative">
                            <input type="email" name="email" class="form-control rounded-pill ps-4 pe-5 py-3 border-0 shadow-sm" placeholder="Enter your email" required style="background: rgba(255,255,255,0.05); color: white;">
                            <button class="btn btn-earth rounded-circle position-absolute end-0 top-50 translate-middle-y me-1 d-flex align-items-center justify-content-center" type="submit" id="btnSubscribe" style="width: 42px; height: 42px;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                        <div id="newsletterMessage" class="mt-2 small px-3" style="display:none;"></div>
                    </form>
                </div>
            </div>
        </div>

        <hr class="mt-5 mb-4 border-light opacity-10">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="copyright mb-0 text-muted small">
                    &copy; {{ date('Y') }} Go Deep Africa Safari. All Rights Reserved.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="footer-bottom-links small">
                    <a href="{{ url('/') }}" class="text-muted text-decoration-none me-3">Home</a>
                    <a href="{{ route('login') }}" class="text-muted text-decoration-none">Staff Portal</a>
                </div>
            </div>
        </div>
    </div>
    <style>
        .btn-earth { background-color: #8b4513 !important; border-color: #8b4513 !important; color: white !important; }
        .btn-earth:hover { background-color: #a0522d !important; border-color: #a0522d !important; }
        .footer-heading { color: #DEB887; font-weight: 700; }
        .newsletter-form-v2 input::placeholder { color: rgba(255,255,255,0.4); }
        .newsletter-form-v2 input:focus { background: rgba(255,255,255,0.1) !important; box-shadow: none !important; color: white !important; }
    </style>
</footer>

<script>
document.getElementById('newsletterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.email.value;
    const btn = document.getElementById('btnSubscribe');
    const msg = document.getElementById('newsletterMessage');
    const token = document.querySelector('input[name="_token"]').value;

    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

    fetch('{{ route("newsletter.subscribe") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
        msg.style.display = 'block';
        msg.className = 'mt-2 small ' + (data.errors ? 'text-danger' : 'text-success');
        msg.innerHTML = data.message || (data.errors ? Object.values(data.errors)[0][0] : 'Something went wrong');
        if(!data.errors) this.reset();
    })
    .catch(error => {
        msg.style.display = 'block';
        msg.className = 'mt-2 small text-danger';
        msg.innerHTML = 'An error occurred. Please try again.';
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Subscribe';
    });
});
</script>
