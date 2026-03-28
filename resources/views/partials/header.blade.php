<header class="main-header">
    <!-- Top Header: Logo, Email, Contact Info -->
    <div class="top-header py-3 px-4 px-lg-5 animate__animated animate__fadeInDown">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="header-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Go Deep Africa Safari Logo" class="img-fluid" style="max-height: 80px;">
                </a>
            </div>
            
            <div class="header-contact-info d-none d-md-flex gap-4 align-items-center">
                <div class="header-socials d-flex gap-3 me-3 pe-3 border-end">
                    <a href="https://www.tiktok.com/@godeepafricasafar?_r=1&_d=ea2f55g68hamde&sec_uid=MS4wLjABAAAA9QgYff6T9D5ggw4R-sHMM3ZvjRY2rWL-pGeGJJK-7KDhR10NfGWPaBFuB-3cCedE&share_author_id=7360181590935782405&sharer_language=en&source=h5_m&u_code=edjg8mim3bfcak&timestamp=1774716159&user_id=7360181590935782405&sec_user_id=MS4wLjABAAAA9QgYff6T9D5ggw4R-sHMM3ZvjRY2rWL-pGeGJJK-7KDhR10NfGWPaBFuB-3cCedE&item_author_type=1&utm_source=copy&utm_campaign=client_share&utm_medium=android&share_iid=7620799729350444820&share_link_id=9863272e-6781-4c72-96fc-8cd3d626e0c3&share_app_id=1233&ugbiz_name=ACCOUNT&ug_btm=b8727%2Cb7360&social_share_type=5&enable_checksum=1" target="_blank" class="social-link tiktok"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.tiktok.com/@godeepafricasafar?_r=1&_d=ea2f55g68hamde&sec_uid=MS4wLjABAAAA9QgYff6T9D5ggw4R-sHMM3ZvjRY2rWL-pGeGJJK-7KDhR10NfGWPaBFuB-3cCedE&share_author_id=7360181590935782405&sharer_language=en&source=h5_m&u_code=edjg8mim3bfcak&timestamp=1774716159&user_id=7360181590935782405&sec_user_id=MS4wLjABAAAA9QgYff6T9D5ggw4R-sHMM3ZvjRY2rWL-pGeGJJK-7KDhR10NfGWPaBFuB-3cCedE&item_author_type=1&utm_source=copy&utm_campaign=client_share&utm_medium=android&share_iid=7620799729350444820&share_link_id=9863272e-6781-4c72-96fc-8cd3d626e0c3&share_app_id=1233&ugbiz_name=ACCOUNT&ug_btm=b8727%2Cb7360&social_share_type=5&enable_checksum=1" target="_blank" class="social-link instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/share/1DkJwJSKre/" target="_blank" class="social-link facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.threads.com/@godeepafricasafariexpendition" target="_blank" class="social-link threads"><i class="fa-brands fa-threads"></i></a>
                </div>
                <div class="contact-item d-flex align-items-center gap-2">
                    <i class="fas fa-envelope text-primary"></i>
                    <div>
                        <small class="d-block text-muted">Email Us</small>
                        <a href="mailto:info@godeepafricasafari.com" class="text-decoration-none text-dark fw-bold">info@godeepafricasafari.com</a>
                    </div>
                </div>
                
                <div class="contact-item d-flex align-items-center gap-2">
                    <i class="fas fa-phone-alt text-primary"></i>
                    <div>
                        <small class="d-block text-muted">Call Anytime</small>
                        <a href="tel:+966542586758" class="text-decoration-none text-dark fw-bold d-block">+966 542 586 758</a>
                        <a href="tel:+255794636471" class="text-decoration-none text-dark fw-bold d-block">+255 794 636 471</a>
                    </div>
                </div>

                <div class="contact-item d-flex align-items-center gap-2">
                    <i class="fas fa-map-marker-alt text-primary"></i>
                    <div>
                        <small class="d-block text-muted">Visit Us</small>
                        <span class="fw-bold">Arusha, Tanzania</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Header: Navigation Menu -->
    <nav class="bottom-header sticky-top navbar navbar-expand-lg navbar-dark shadow-sm py-0 animate__animated animate__fadeIn">
        <div class="container-fluid px-lg-5 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <button class="navbar-toggler my-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Inquiry Button for Mobile Header -->
                <a href="#" class="btn btn-earth btn-sm px-3 rounded-pill d-lg-none">INQUIRY</a>
            </div>
            
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active py-3 px-3" href="{{ url('/') }}">HOME</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle py-3 px-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            KILIMANJARO
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Machame Route</a></li>
                            <li><a class="dropdown-item" href="#">Lemosho Route</a></li>
                            <li><a class="dropdown-item" href="#">Marangu Route</a></li>
                            <li><a class="dropdown-item" href="#">Rongai Route</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle py-3 px-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            SAFARI
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Serengeti Safari</a></li>
                            <li><a class="dropdown-item" href="#">Ngorongoro Crater</a></li>
                            <li><a class="dropdown-item" href="#">Tarangire National Park</a></li>
                            <li><a class="dropdown-item" href="#">Lake Manyara</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-3 px-3" href="#">DAY TRIPS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-3 px-3" href="#">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-3 px-3" href="#">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-3 px-3" href="#">CONTACTS</a>
                    </li>
                </ul>
                
                <div class="auth-buttons d-flex gap-3 py-2 d-none d-lg-block">
                    <a href="#" class="btn btn-earth px-4 rounded-pill">INQUIRY NOW</a>
                </div>
            </div>
        </div>
    </nav>
</header>
