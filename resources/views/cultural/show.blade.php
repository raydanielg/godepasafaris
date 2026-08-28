<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $waNumber = '255794636471';
        $heroImg = $experience->image_url ?: 'https://images.unsplash.com/photo-1523805009345-7448845a9e53?auto=format&fit=crop&w=1920&q=80';
        $avg = $experience->reviews->count() ? round($experience->reviews->avg('rating'), 1) : null;
        $seoTitle = tr($experience->name) . ' — Cultural Safari Tanzania | Go Deep Africa';
        // The tagline used to win outright, but several are under 50 characters —
        // too short for Google to use, so it wrote its own snippet instead. Prefer
        // whichever field actually says enough, then top up from region/duration.
        $expDesc = trim(strip_tags(tr($experience->tagline ?: '')));
        if (mb_strlen($expDesc) < 70) {
            $expDesc = trim(strip_tags(tr($experience->description ?: '')));
        }
        if (mb_strlen($expDesc) < 70) {
            $expDesc = implode(' ', array_filter([
                tr($experience->name) . ' in Tanzania.',
                $experience->tagline ? trim(strip_tags(tr($experience->tagline))) : null,
                $experience->region ? 'Located in ' . strip_tags($experience->region) . '.' : null,
                $experience->duration ? 'Duration: ' . strip_tags($experience->duration) . '.' : null,
                'Arranged by Go Deep Africa Safari, a locally owned Tanzanian operator.',
            ]));
        }
        $seoDescription = \Illuminate\Support\Str::limit($expDesc, 155);
        $seoImage = $heroImg;
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'TouristAttraction',
            'name' => tr($experience->name),
            'description' => strip_tags(tr($experience->description)),
            'image' => $heroImg,
            'address' => ['@type' => 'PostalAddress', 'addressRegion' => strip_tags((string) $experience->region), 'addressCountry' => 'TZ'],
        ];
        if ($avg) {
            $schema['aggregateRating'] = ['@type' => 'AggregateRating', 'ratingValue' => $avg, 'reviewCount' => $experience->reviews->count()];
        }
        $seoSchema = json_encode([$schema, [
            '@context' => 'https://schema.org', '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Cultural Safari', 'item' => route('cultural.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => tr($experience->name), 'item' => url()->current()],
            ],
        ]], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    @endphp
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .cul-detail-hero{ min-height:56vh; display:flex; align-items:flex-end; color:#fff;
            background:linear-gradient(rgba(30,20,15,.35), rgba(40,25,15,.8)), url('{{ $heroImg }}'); background-size:cover; background-position:center; }
        .cul-gallery img{ height:150px; width:100%; object-fit:cover; border-radius:.8rem; }
        .review-card{ background:#fdfaf5; border:1px solid rgba(139,69,19,.1); border-radius:1rem; }
    </style>
</head>
<body style="background:#fff;">
    @include('partials.header')

    <section class="cul-detail-hero">
        <div class="container pb-5">
            <nav aria-label="breadcrumb" class="mb-2">
                <ol class="breadcrumb small mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cultural.index') }}" class="text-white-50 text-decoration-none">Cultural Safari</a></li>
                    <li class="breadcrumb-item active text-white">{{ tr($experience->name) }}</li>
                </ol>
            </nav>
            <span class="badge rounded-pill px-3 py-2 mb-2" style="background:#8B4513;"><i class="fas fa-location-dot me-1"></i>{{ $experience->region }}</span>
            <h1 class="display-4 fw-bold mb-2" style="font-family:'Nunito', sans-serif;">{{ tr($experience->name) }}</h1>
            <p class="lead mb-0" style="max-width:720px;">{{ tr($experience->tagline) }}</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3" style="font-family:'Nunito', sans-serif; color:#3E2723;">About this Experience</h2>
                <p class="text-muted" style="line-height:1.8;">{{ tr($experience->description) }}</p>

                @if(count($experience->highlight_list))
                <h4 class="fw-bold mt-4 mb-3" style="color:#3E2723;">Highlights</h4>
                <div class="row g-3">
                    @foreach($experience->highlight_list as $h)
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2 p-3 rounded-3" style="background:#f8f9fa;">
                            <i class="fas fa-star" style="color:#8B4513;"></i><span class="fw-semibold">{{ tr($h) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                @if(count($experience->activity_list))
                <h4 class="fw-bold mt-4 mb-3" style="color:#3E2723;">Activities</h4>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($experience->activity_list as $a)
                        <span class="badge rounded-pill px-3 py-2" style="background:#fdfaf5; color:#3E2723; border:1px solid rgba(139,69,19,.15);">{{ tr($a) }}</span>
                    @endforeach
                </div>
                @endif

                @if(count($experience->gallery_urls))
                <h4 class="fw-bold mt-5 mb-3" style="color:#3E2723;">Gallery</h4>
                <div class="cul-gallery row g-3">
                    @foreach($experience->gallery_urls as $g)
                    <div class="col-6 col-md-4"><a href="{{ $g }}" target="_blank" rel="noopener"><img src="{{ $g }}" alt="{{ tr($experience->name) }}" loading="lazy"></a></div>
                    @endforeach
                </div>
                @endif

                <!-- Reviews -->
                <div class="mt-5">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <h4 class="fw-bold mb-0" style="color:#3E2723;">Visitor Reviews</h4>
                        @if($avg)<span class="badge bg-warning text-dark">{{ $avg }} ★ ({{ $experience->reviews->count() }})</span>@endif
                    </div>
                    @forelse($experience->reviews as $rev)
                    <div class="review-card p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold" style="color:#3E2723;">{{ $rev->name }}@if($rev->location)<small class="text-muted fw-normal"> · {{ $rev->location }}</small>@endif</span>
                            <span>@for($i=0;$i<5;$i++)<i class="fas fa-star {{ $i < $rev->rating ? 'text-warning' : 'text-muted opacity-25' }}" style="font-size:.8rem;"></i>@endfor</span>
                        </div>
                        <p class="text-muted small mb-0">{{ $rev->comment }}</p>
                    </div>
                    @empty
                    <p class="text-muted small">Be the first to experience and review this cultural tour.</p>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar / booking -->
            <div class="col-lg-4">
                <div class="card border-0 rounded-4 shadow-lg p-4" style="position:sticky; top:100px;">
                    @if($experience->price)
                    <div class="mb-3">
                        <span class="text-muted small">From</span>
                        <span class="h3 fw-bold ms-1" style="color:#8B4513;">${{ number_format($experience->price, 0) }}</span>
                        <span class="text-muted small">/ person</span>
                    </div>
                    @endif
                    <ul class="list-unstyled small mb-4">
                        @if($experience->region)<li class="mb-2"><i class="fas fa-location-dot me-2" style="color:#8B4513;"></i>{{ $experience->region }}</li>@endif
                        @if($experience->duration)<li class="mb-2"><i class="fas fa-clock me-2" style="color:#8B4513;"></i>{{ $experience->duration }}</li>@endif
                        @if($experience->best_time)<li class="mb-2"><i class="fas fa-calendar me-2" style="color:#8B4513;"></i>Best time: {{ $experience->best_time }}</li>@endif
                    </ul>
                    <button type="button" class="btn w-100 rounded-pill py-3 fw-bold text-white mb-2" style="background:linear-gradient(135deg,#8B4513,#D2691E);" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                        <i class="fas fa-paper-plane me-2"></i>Book / Enquire
                    </button>
                    <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Hello Go Deep Africa, I am interested in the ' . $experience->name . ' cultural experience.') }}" target="_blank" rel="noopener" class="btn w-100 rounded-pill py-3 fw-bold text-white" style="background:#25D366;">
                        <i class="fab fa-whatsapp me-2"></i>Book on WhatsApp
                    </a>
                </div>
            </div>
        </div>

        <!-- Related -->
        @if($related->count())
        <div class="mt-5 pt-4 border-top">
            <h4 class="fw-bold mb-4" style="font-family:'Nunito', sans-serif; color:#3E2723;">Other Cultural Experiences</h4>
            <div class="row g-4">
                @foreach($related as $r)
                <div class="col-md-4">
                    <a href="{{ route('cultural.show', $r) }}" class="text-decoration-none">
                        <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">
                            <div style="height:160px; overflow:hidden;">
                                @if($r->image_url)<img src="{{ $r->image_url }}" class="w-100 h-100" style="object-fit:cover;" alt="{{ $r->name }}" loading="lazy">
                                @else<div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background:linear-gradient(135deg,#3E2723,#8B4513);"><i class="fas {{ $r->icon ?: 'fa-people-group' }} text-white" style="font-size:2rem; opacity:.7;"></i></div>@endif
                            </div>
                            <div class="card-body p-3">
                                <h6 class="fw-bold mb-1" style="color:#3E2723;">{{ tr($r->name) }}</h6>
                                <small class="text-muted">{{ $r->region }}</small>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 700, once: true });
        // Pre-select this experience in the enquiry form so the booking records it.
        document.addEventListener('DOMContentLoaded', function () {
            var modal = document.getElementById('generalInquiryModal');
            if (!modal) return;
            modal.addEventListener('show.bs.modal', function () {
                var sel = document.getElementById('inquiry_tour_select');
                if (!sel) return;
                var name = @json($experience->name);
                if (!Array.from(sel.options).some(function (o) { return o.value === name; })) {
                    sel.add(new Option(name, name, true, true), 0);
                }
                sel.value = name;
            });
        });
    </script>
</body>
</html>
