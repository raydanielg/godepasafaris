<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $seoTitle = $circuit['name'] . ' Safari — Parks, Map & Best Time to Visit | Go Deep Africa';
        $seoDescription = \Illuminate\Support\Str::limit(strip_tags($circuit['tagline'] . ' ' . ($circuit['overview'][0] ?? '')), 155);
        $seoImage = $circuit['hero'];
        $seoSchema = json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Safari Circuits', 'item' => route('circuits.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $circuit['name'], 'item' => url()->current()],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    @endphp
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .circuit-hero {
            min-height: 62vh;
            background: linear-gradient(rgba(30,20,15,.55), rgba(30,20,15,.7)), url('{{ $circuit['hero'] }}');
            background-size: cover;
            background-position: center;
        }
        .fact-row { border-bottom: 1px solid rgba(0,0,0,.06); }
        .fact-row:last-child { border-bottom: 0; }
        .place-card { transition: transform .3s ease, box-shadow .3s ease; }
        .place-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(0,0,0,.10); }
        .circuit-map iframe { display:block; width:100%; border:0; border-radius:1rem; min-height:420px; }
        .wildlife-badge { background:#fdfaf5; border:1px solid rgba(139,69,19,.15); color:#3E2723; }
        @media (max-width: 768px){ .circuit-hero{ min-height:52vh; } }
    </style>
</head>
<body style="background:#fff;">
    @include('partials.header')

    <!-- Hero -->
    <section class="circuit-hero d-flex align-items-end text-white">
        <div class="container pb-5">
            <nav aria-label="breadcrumb" class="mb-2">
                <ol class="breadcrumb small mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('circuits.index') }}" class="text-white-50 text-decoration-none">Safari Circuits</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $circuit['name'] }}</li>
                </ol>
            </nav>
            <span class="badge rounded-pill px-3 py-2 mb-3" style="background:{{ $circuit['accent'] }};">
                <i class="fas fa-map-signs me-1"></i>Tanzania Safari Circuit
            </span>
            <h1 class="display-3 fw-bold mb-2" style="font-family:'Nunito', sans-serif;">{{ $circuit['name'] }}</h1>
            <p class="lead mb-0" style="max-width:760px;">{{ $circuit['tagline'] }}</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <!-- Overview -->
            <div class="col-lg-8">
                <h2 class="fw-bold mb-4" style="font-family:'Nunito', sans-serif; color:#3E2723;">About the {{ $circuit['name'] }}</h2>
                @foreach($circuit['overview'] as $para)
                    <p class="text-muted mb-3" style="line-height:1.8;">{{ $para }}</p>
                @endforeach

                <!-- Wildlife -->
                <h5 class="fw-bold mt-4 mb-3" style="color:#3E2723;"><i class="fas fa-paw me-2" style="color:{{ $circuit['accent'] }};"></i>Wildlife &amp; Highlights</h5>
                <div class="d-flex flex-wrap gap-2 mb-2">
                    @foreach($circuit['wildlife'] as $w)
                        <span class="badge rounded-pill px-3 py-2 wildlife-badge">{{ $w }}</span>
                    @endforeach
                </div>
            </div>

            <!-- Quick facts -->
            <div class="col-lg-4">
                <div class="card border-0 rounded-4 shadow-sm p-4" style="position:sticky; top:100px;">
                    <h5 class="fw-bold mb-3" style="color:#3E2723;"><i class="fas fa-circle-info me-2" style="color:{{ $circuit['accent'] }};"></i>Quick Facts</h5>
                    @foreach($circuit['facts'] as $label => $value)
                    <div class="fact-row py-3">
                        <div class="small text-uppercase fw-bold text-muted" style="letter-spacing:.5px;">{{ $label }}</div>
                        <div class="small text-dark mt-1">{{ $value }}</div>
                    </div>
                    @endforeach
                    <a href="#" class="btn w-100 mt-4 rounded-pill py-3 fw-bold text-white" style="background:{{ $circuit['accent'] }};" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                        <i class="fas fa-paper-plane me-2"></i>Plan This Safari
                    </a>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="mt-5" data-aos="fade-up">
            <h2 class="fw-bold mb-2" style="font-family:'Nunito', sans-serif; color:#3E2723;"><i class="fas fa-map-location-dot me-2" style="color:{{ $circuit['accent'] }};"></i>{{ $circuit['name'] }} Map</h2>
            <p class="text-muted mb-3">Explore the region and the parks that make up the {{ $circuit['name'] }}.</p>
            <div class="circuit-map shadow-sm rounded-4 overflow-hidden">
                <iframe
                    src="https://maps.google.com/maps?q={{ $circuit['map']['lat'] }},{{ $circuit['map']['lng'] }}&z={{ $circuit['map']['zoom'] }}&output=embed"
                    height="450" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    title="{{ $circuit['name'] }} map"></iframe>
            </div>
        </div>

        <!-- Parks & attractions -->
        <div class="mt-5">
            <h2 class="fw-bold mb-4" style="font-family:'Nunito', sans-serif; color:#3E2723;">Parks &amp; Attractions</h2>
            <div class="row g-4">
                @foreach($circuit['places'] as $place)
                @php $destMatch = $relatedDestinations->firstWhere('slug', \Illuminate\Support\Str::slug($place['name'])); @endphp
                <div class="col-md-6" data-aos="fade-up">
                    <div class="place-card card h-100 border-0 rounded-4 shadow-sm p-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width:46px;height:46px;background:{{ $circuit['accent'] }}1a;">
                                <i class="fas fa-location-dot" style="color:{{ $circuit['accent'] }};"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2" style="color:#3E2723;">{{ $place['name'] }}</h5>
                                <p class="text-muted small mb-3">{{ $place['desc'] }}</p>
                                <div class="d-flex flex-wrap gap-2">
                                    @if($destMatch)
                                    <a href="{{ route('destinations.show', $destMatch->slug) }}" class="btn btn-sm rounded-pill px-3 text-white fw-bold" style="background:{{ $circuit['accent'] }};">
                                        <i class="fas fa-arrow-right me-1"></i>Explore
                                    </a>
                                    @endif
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($place['name'] . ', Tanzania') }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                        <i class="fas fa-map-marker-alt me-1"></i>View on map
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Other circuits -->
        <div class="mt-5 pt-4 border-top">
            <h5 class="fw-bold mb-3" style="color:#3E2723;">Explore Other Circuits</h5>
            <div class="d-flex flex-wrap gap-2">
                @foreach(config('circuits') as $slug => $other)
                    @if($slug !== $circuit['slug'])
                    <a href="{{ route('circuits.show', $slug) }}" class="btn btn-outline-dark rounded-pill px-4">
                        <i class="fas fa-map-signs me-2"></i>{{ $other['name'] }}
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 700, once: true });</script>
</body>
</html>
