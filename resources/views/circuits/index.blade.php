<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $seoTitle = 'Tanzania Safari Circuits — Northern, Southern & Eastern | Go Deep Africa';
        $seoDescription = "Compare Tanzania's safari circuits — the Northern Circuit (Serengeti, Ngorongoro, Kilimanjaro), the wild Southern Circuit (Nyerere, Ruaha) and the coastal Eastern Circuit (Saadani, Zanzibar). Maps, parks and best times to visit.";
    @endphp
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .circuits-hero {
            min-height: 45vh;
            background: linear-gradient(rgba(30,20,15,.6), rgba(30,20,15,.75)), url('https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1920&q=80');
            background-size: cover; background-position: center;
        }
        .circuit-tile { transition: transform .35s ease, box-shadow .35s ease; overflow:hidden; }
        .circuit-tile:hover { transform: translateY(-8px); box-shadow: 0 20px 45px rgba(0,0,0,.15); }
        .circuit-tile img { transition: transform .5s ease; }
        .circuit-tile:hover img { transform: scale(1.06); }
    </style>
</head>
<body style="background:#fff;">
    @include('partials.header')

    <section class="circuits-hero d-flex align-items-center text-white text-center">
        <div class="container" data-aos="fade-up">
            <h1 class="display-3 fw-bold mb-3" style="font-family:'Playfair Display',serif;">Tanzania Safari Circuits</h1>
            <p class="lead mx-auto mb-0" style="max-width:760px;">Three distinct ways to experience Tanzania — from the famous Northern plains to the wild south and the Swahili coast.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-4">
            @foreach($circuits as $slug => $circuit)
            <div class="col-lg-4 col-md-6" data-aos="fade-up">
                <a href="{{ route('circuits.show', $slug) }}" class="text-decoration-none">
                    <div class="circuit-tile card h-100 border-0 rounded-4 shadow-sm">
                        <div style="height:220px; overflow:hidden; border-radius:1rem 1rem 0 0;">
                            <img src="{{ $circuit['hero'] }}" class="w-100 h-100" style="object-fit:cover;" alt="{{ $circuit['name'] }}" loading="lazy" decoding="async">
                        </div>
                        <div class="card-body p-4">
                            <span class="badge rounded-pill px-3 py-2 mb-2" style="background:{{ $circuit['accent'] }};">{{ $circuit['name'] }}</span>
                            <p class="text-muted small mb-3">{{ $circuit['tagline'] }}</p>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @foreach(array_slice($circuit['places'], 0, 3) as $p)
                                    <span class="badge bg-light text-dark border small">{{ $p['name'] }}</span>
                                @endforeach
                                @if(count($circuit['places']) > 3)
                                    <span class="badge bg-light text-muted border small">+{{ count($circuit['places']) - 3 }} more</span>
                                @endif
                            </div>
                            <span class="fw-bold" style="color:{{ $circuit['accent'] }};">Explore circuit <i class="fas fa-arrow-right ms-1"></i></span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    @include('partials.footer')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 700, once: true });</script>
</body>
</html>
