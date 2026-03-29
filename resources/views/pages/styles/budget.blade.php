<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', ['title' => 'Budget Safaris - Go Deep Africa Safari'])
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .bg-earth { background-color: #8b4513 !important; }
        .text-earth { color: #8b4513 !important; }
        .btn-earth { background-color: #8b4513 !important; border-color: #8b4513 !important; color: white !important; }
        .btn-earth:hover { background-color: #a0522d !important; border-color: #a0522d !important; }
        .feature-card { transition: transform 0.3s ease; border: none; border-radius: 1.5rem; }
        .feature-card:hover { transform: translateY(-10px); }
        .icon-circle { width: 70px; height: 70px; background: #fdf5e6; color: #8b4513; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin-bottom: 1.5rem; }
    </style>
</head>
<body class="bg-light">
    @include('partials.header')
    
    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1516422213484-21db3332906c?auto=format&fit=crop&w=1920&q=80'); height: 450px; background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; color: white;">
        <div class="container text-center">
            <h1 class="display-3 fw-bold animate__animated animate__fadeInUp">Budget Safaris</h1>
            <p class="lead fs-4 animate__animated animate__fadeInUp animate__delay-1s">Incredible Adventures That Don't Break the Bank</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <h2 class="display-5 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Smart Travel, Real Adventure</h2>
                <p class="lead text-muted">We believe that the magic of the African Savannah should be accessible to everyone. Our Budget Safaris are designed for travelers who prioritize experiences over expensive thread counts.</p>
                <p>By choosing strategically located campsites and high-quality public lodges, we reduce the cost without ever compromising on the quality of your wildlife encounters. You get the same expert guides, the same rugged 4x4 vehicles, and the same breathtaking landscapes as our luxury guests.</p>
                <div class="d-flex gap-3 mt-4">
                    <button class="btn btn-earth rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">GET A FREE QUOTE</button>
                    <a href="{{ route('tours.all') }}" class="btn btn-outline-dark rounded-pill px-4 py-2">EXPLORE TOURS</a>
                </div>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <div class="row g-4">
                    <div class="col-6">
                        <div class="card feature-card shadow-sm p-4 h-100">
                            <div class="icon-circle"><i class="fas fa-wallet"></i></div>
                            <h5 class="fw-bold">Best Price</h5>
                            <p class="small text-muted mb-0">Direct local prices with no hidden booking fees.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card feature-card shadow-sm p-4 h-100">
                            <div class="icon-circle"><i class="fas fa-user-friends"></i></div>
                            <h5 class="fw-bold">Expert Guides</h5>
                            <p class="small text-muted mb-0">The same senior guides who lead our premium tours.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card feature-card shadow-sm p-4 h-100">
                            <div class="icon-circle"><i class="fas fa-campground"></i></div>
                            <h5 class="fw-bold">Quality Gear</h5>
                            <p class="small text-muted mb-0">Safe, clean, and modern camping equipment provided.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card feature-card shadow-sm p-4 h-100">
                            <div class="icon-circle"><i class="fas fa-utensils"></i></div>
                            <h5 class="fw-bold">Great Food</h5>
                            <p class="small text-muted mb-0">Fresh meals prepared by professional safari chefs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5 mt-5">
            <div class="col-lg-8">
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm">
                    <h3 class="fw-bold mb-4">How We Keep It Budget-Friendly</h3>
                    <p>Many travelers wonder how we can offer such low prices. The secret lies in our local roots and operational efficiency:</p>
                    <ul class="list-unstyled">
                        <li class="mb-4 d-flex gap-3">
                            <i class="fas fa-check-circle text-earth mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Public Campsites & Lodges</h6>
                                <p class="small text-muted">Instead of staying in private concessions that cost thousands per night, we use well-maintained national park campsites and local lodges that offer a true "bush" experience at a fraction of the cost.</p>
                            </div>
                        </li>
                        <li class="mb-4 d-flex gap-3">
                            <i class="fas fa-check-circle text-earth mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Direct Operations</h6>
                                <p class="small text-muted">We own our vehicles and employ our guides directly. There are no middle-men or international travel agents taking a cut from your payment.</p>
                            </div>
                        </li>
                        <li class="mb-4 d-flex gap-3">
                            <i class="fas fa-check-circle text-earth mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Group Synchronization</h6>
                                <p class="small text-muted">We synchronize departures to share costs on fuel and logistics, allowing solo travelers to join others and save money while making new friends.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-dark text-white p-4 p-md-5 rounded-4 shadow-sm h-100 d-flex flex-column justify-content-center">
                    <h4 class="fw-bold mb-3 text-earth-light" style="color: #deb887;">Still Unsure?</h4>
                    <p class="small opacity-75 mb-4">If you're not sure which style fits your budget best, just tell us your limit and we'll design the best possible itinerary for you.</p>
                    <a href="https://wa.me/255794636471" class="btn btn-earth w-100 rounded-pill mb-3 py-3 fw-bold"><i class="fab fa-whatsapp me-2"></i> CHAT ON WHATSAPP</a>
                    <p class="text-center small mb-0 opacity-50">Response time: < 15 mins</p>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
</body>
</html>
