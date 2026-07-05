<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $seoTitle = 'Cultural Safari Tanzania — Maasai, Hadzabe, Chagga & More | Go Deep Africa';
        $seoDescription = "Meet Tanzania's people on an authentic cultural safari — Maasai warriors, Hadzabe hunter-gatherers, Chagga coffee farmers, Makonde carvers and more. Village visits, dances, crafts and history.";
    @endphp
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .cul-hero{ min-height:60vh; display:flex; align-items:center; color:#fff;
            background:linear-gradient(rgba(40,25,15,.55), rgba(62,39,35,.85)), url('{{ bg('bg_cultural', 'https://images.unsplash.com/photo-1523805009345-7448845a9e53?auto=format&fit=crop&w=1920&q=80') }}');
            background-size:cover; background-position:center; }
        .cul-card{ transition:transform .35s ease, box-shadow .35s ease; overflow:hidden; }
        .cul-card:hover{ transform:translateY(-8px); box-shadow:0 20px 45px rgba(0,0,0,.14); }
        .cul-card img{ transition:transform .5s ease; }
        .cul-card:hover img{ transform:scale(1.06); }
        .cul-ico{ width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.4rem;background:linear-gradient(135deg,#8B4513,#D2691E); }
    </style>
</head>
<body style="background:#fff;">
    @include('partials.header')

    <section class="cul-hero">
        <div class="container" data-aos="fade-up">
            <span class="badge rounded-pill px-3 py-2 mb-3" style="background:#8B4513;"><i class="fas fa-people-group me-1"></i>Cultural Safari</span>
            <h1 class="display-3 fw-bold mb-3" style="font-family:'Playfair Display',serif;">Meet the People of Tanzania</h1>
            <p class="lead mb-0" style="max-width:760px;">Beyond the wildlife lies a living culture. Share a day with the Maasai, Hadzabe, Chagga, Makonde and more — authentic, respectful encounters that support local communities.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-3">
            <div class="row g-4">
                @forelse($experiences as $exp)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <a href="{{ route('cultural.show', $exp) }}" class="text-decoration-none">
                        <div class="cul-card card h-100 border-0 rounded-4 shadow-sm">
                            <div style="height:210px; overflow:hidden; border-radius:1rem 1rem 0 0; position:relative;">
                                @if($exp->image_url)
                                    <img src="{{ $exp->image_url }}" class="w-100 h-100" style="object-fit:cover;" alt="{{ $exp->name }}" loading="lazy">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background:linear-gradient(135deg,#3E2723,#8B4513);">
                                        <i class="fas {{ $exp->icon ?: 'fa-people-group' }} text-white" style="font-size:3rem; opacity:.7;"></i>
                                    </div>
                                @endif
                                @if($exp->is_featured)<span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2"><i class="fas fa-star me-1"></i>Popular</span>@endif
                            </div>
                            <div class="card-body p-4">
                                <small class="text-uppercase fw-bold" style="color:#8B4513; letter-spacing:.5px;">{{ $exp->region }}</small>
                                <h3 class="h5 fw-bold mt-1 mb-2" style="color:#3E2723; font-family:'Playfair Display',serif;">{{ tr($exp->name) }}</h3>
                                <p class="text-muted small mb-3">{{ tr($exp->tagline) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    @if($exp->price)<span class="fw-bold" style="color:#8B4513;">From ${{ number_format($exp->price, 0) }}</span>@else<span></span>@endif
                                    <span class="fw-bold small" style="color:#8B4513;">Explore <i class="fas fa-arrow-right ms-1"></i></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center text-muted py-5"><p>Cultural experiences are coming soon.</p></div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-5" style="background:linear-gradient(135deg,#3E2723,#5D4037);">
        <div class="container py-3 text-center text-white">
            <h2 class="fw-bold mb-3" style="font-family:'Playfair Display',serif;">Add a Cultural Day to Your Safari</h2>
            <p class="lead mb-4 opacity-75">Our team will weave any cultural experience into your itinerary.</p>
            <a href="#" class="btn btn-lg rounded-pill px-5 fw-bold" style="background:linear-gradient(135deg,#DEB887,#D2691E); color:#3E2723;" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                <i class="fas fa-paper-plane me-2"></i>Plan My Cultural Safari
            </a>
        </div>
    </section>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 700, once: true });</script>
</body>
</html>
