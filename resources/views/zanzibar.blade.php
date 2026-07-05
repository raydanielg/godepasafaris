<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $seoTitle = 'Zanzibar Holidays — Beaches, Stone Town, Spice & Marine Tours | Go Deep Africa';
        $seoDescription = 'Discover magical Zanzibar: white-sand beaches (Nungwi, Paje, Kendwa), UNESCO Stone Town, spice farms, dolphin & turtle tours, Prison Island tortoises and Jozani Forest. Book your Zanzibar adventure.';
        $seoImage = $z['hero_image'];
        $waNumber = preg_replace('/\D/', '', $z['whatsapp']);
        $seoSchema = json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'TouristDestination',
            'name' => 'Zanzibar',
            'description' => 'Zanzibar — the Spice Island: beaches, UNESCO Stone Town, spice farms, marine life and Swahili culture off the coast of Tanzania.',
            'image' => $z['hero_image'],
            'url' => url()->current(),
            'geo' => ['@type' => 'GeoCoordinates', 'latitude' => -6.1659, 'longitude' => 39.2026],
            'touristType' => ['Beach holidays', 'Cultural tourism', 'Honeymoon', 'Marine & diving'],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    @endphp
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .znz {
            --deep:#0B4F6C; --teal:#1F7A8C; --aqua:#2EC4B6; --sand:#F7F2E9; --coral:#FF7F50; --ink:#0A2E36;
            font-family:'Nunito',sans-serif; color:var(--ink); background:#fff;
        }
        .znz h1,.znz h2,.znz h3,.znz .display-title{ font-family:'Playfair Display',serif; }
        .znz-hero{
            min-height:100vh; position:relative; display:flex; align-items:center;
            background:linear-gradient(180deg, rgba(10,46,54,.35) 0%, rgba(11,79,108,.75) 100%), url('{{ bg('bg_zanzibar', $z['hero_image']) }}');
            background-size:cover; background-position:center;
        }
        .znz-hero .content{ color:#fff; max-width:820px; }
        .znz-eyebrow{ letter-spacing:1.5px; text-transform:uppercase; font-weight:800; font-size:1.25rem; color:#FFE1A8; text-shadow:0 2px 12px rgba(0,0,0,.55); }
        @media (max-width:576px){ .znz-eyebrow{ font-size:1rem; letter-spacing:1px; } }
        .btn-coral{ background:var(--coral); border:none; color:#fff; font-weight:700; }
        .btn-coral:hover{ background:#ff6a35; color:#fff; }
        .btn-wa{ background:#25D366; border:none; color:#fff; font-weight:700; }
        .btn-wa:hover{ background:#1eb257; color:#fff; }
        .btn-teal-outline{ border:2px solid #fff; color:#fff; background:transparent; font-weight:700; }
        .btn-teal-outline:hover{ background:#fff; color:var(--deep); }
        /* sticky section nav */
        .znz-subnav{ position:sticky; top:0; z-index:60; background:rgba(255,255,255,.92); backdrop-filter:blur(10px); border-bottom:1px solid rgba(0,0,0,.06); }
        .znz-subnav a{ white-space:nowrap; color:var(--deep); font-weight:700; font-size:.85rem; text-decoration:none; padding:.5rem .9rem; border-radius:999px; }
        .znz-subnav a:hover{ background:var(--sand); color:var(--teal); }
        .znz-section{ padding:70px 0; }
        .znz-section.alt{ background:var(--sand); }
        .znz-kicker{ color:var(--teal); font-weight:800; letter-spacing:2px; text-transform:uppercase; font-size:.8rem; }
        .znz-heading{ font-size:2.3rem; font-weight:800; color:var(--deep); }
        .znz-rule{ width:70px; height:4px; border-radius:4px; background:linear-gradient(90deg,var(--teal),var(--aqua)); }
        .znz-card{ background:#fff; border:1px solid rgba(11,79,108,.08); border-radius:1.1rem; transition:transform .3s ease, box-shadow .3s ease; height:100%; }
        .znz-card:hover{ transform:translateY(-7px); box-shadow:0 18px 40px rgba(11,79,108,.14); }
        .znz-ico{ width:54px; height:54px; border-radius:14px; display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.25rem; background:linear-gradient(135deg,var(--teal),var(--aqua)); overflow:hidden; flex-shrink:0; }
        .znz-ico img{ width:100%; height:100%; object-fit:cover; border-radius:inherit; }
        .znz-card-banner{ height:190px; overflow:hidden; border-radius:1.1rem 1.1rem 0 0; }
        .znz-card-banner img{ width:100%; height:100%; object-fit:cover; transition:transform .4s ease; }
        .znz-card:hover .znz-card-banner img{ transform:scale(1.05); }
        .znz-badge{ background:var(--sand); color:var(--deep); border:1px solid rgba(11,79,108,.12); border-radius:999px; font-weight:600; font-size:.72rem; padding:.3rem .7rem; }
        .pkg-card{ overflow:hidden; }
        .pkg-head{ background:linear-gradient(135deg,var(--deep),var(--teal)); color:#fff; }
        .pkg-price{ color:var(--coral); font-weight:800; }
        .fav-btn{ background:rgba(255,255,255,.9); border:none; width:38px; height:38px; border-radius:50%; color:#bbb; }
        .fav-btn.active{ color:var(--coral); }
        .znz-map iframe{ display:block; width:100%; border:0; min-height:420px; border-radius:1rem; }
        .znz-float-wa{ position:fixed; right:18px; bottom:18px; z-index:1000; width:56px; height:56px; border-radius:50%; background:#25D366; color:#fff; display:flex; align-items:center; justify-content:center; font-size:1.5rem; box-shadow:0 10px 25px rgba(37,211,102,.45); }
        .znz-float-wa:hover{ color:#fff; transform:scale(1.06); }
        @media (max-width:768px){ .znz-heading{ font-size:1.8rem; } .znz-hero{ min-height:92vh; } }
    </style>
</head>
<body class="znz">
    @include('partials.header')

    <!-- HERO -->
    <header class="znz-hero">
        <div class="container content" data-aos="fade-up">
            <p class="znz-eyebrow mb-3">Discover Magical Zanzibar — The Jewel of the Indian Ocean</p>
            <h1 class="display-3 fw-bold mb-3">Where History, Culture, Adventure &amp; Paradise Meet.</h1>
            <p class="lead mb-4" style="max-width:680px; opacity:.95;">
                Experience pristine white-sand beaches, ancient Stone Town heritage, spice farms, marine adventures,
                dolphin tours, giant tortoise encounters and authentic Swahili culture — all in one unforgettable island.
            </p>
            <div class="d-flex flex-column flex-sm-row gap-3">
                <a href="#packages" class="btn btn-coral btn-lg rounded-pill px-4 py-3">
                    <i class="fas fa-umbrella-beach me-2"></i>Book Your Zanzibar Adventure
                </a>
                <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Hello Go Deep Africa, I would like to plan a Zanzibar trip.') }}" target="_blank" rel="noopener" class="btn btn-teal-outline btn-lg rounded-pill px-4 py-3">
                    <i class="fab fa-whatsapp me-2"></i>Chat on WhatsApp
                </a>
            </div>
        </div>
    </header>

    <!-- SECTION NAV -->
    <nav class="znz-subnav">
        <div class="container py-2">
            <div class="d-flex gap-1 overflow-auto py-1">
                <a href="#beaches"><i class="fas fa-umbrella-beach me-1"></i>Beaches</a>
                <a href="#heritage"><i class="fas fa-landmark me-1"></i>Stone Town</a>
                <a href="#spice"><i class="fas fa-seedling me-1"></i>Spice Farms</a>
                <a href="#marine"><i class="fas fa-water me-1"></i>Marine &amp; Turtles</a>
                <a href="#prison"><i class="fas fa-hippo me-1"></i>Prison Island</a>
                <a href="#jozani"><i class="fas fa-paw me-1"></i>Jozani Forest</a>
                <a href="#packages"><i class="fas fa-gem me-1"></i>Packages</a>
            </div>
        </div>
    </nav>

    @php
        $sectionHead = function ($kicker, $title, $sub = null) {
            return ['kicker' => $kicker, 'title' => $title, 'sub' => $sub];
        };
    @endphp

    <!-- 1 · BEACHES -->
    <section id="beaches" class="znz-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="znz-kicker">Beach Paradise</div>
                <h2 class="znz-heading mt-2">Zanzibar's Finest Beaches</h2>
                <div class="znz-rule mx-auto mt-3"></div>
            </div>
            <div class="row g-4">
                @foreach($z['beaches'] as $b)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="znz-card overflow-hidden">
                        @if(!empty($b['image']))
                        <div class="znz-card-banner"><img src="{{ $b['image'] }}" alt="{{ $b['name'] }}" loading="lazy"></div>
                        @endif
                        <div class="p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="znz-ico"><i class="fas {{ $b['icon'] }}"></i></div>
                                <div>
                                    <h3 class="h5 fw-bold mb-0" style="color:var(--deep);">{{ $b['name'] }}</h3>
                                    <small class="text-muted"><i class="far fa-calendar me-1"></i>Best: {{ $b['best_time'] }}</small>
                                </div>
                            </div>
                            <p class="text-muted small mb-3">{{ $b['desc'] }}</p>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($b['activities'] as $act)
                                    <span class="znz-badge">{{ $act }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 2 · STONE TOWN & CULTURE -->
    <section id="heritage" class="znz-section alt">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="znz-kicker">Historical &amp; Cultural Heritage</div>
                <h2 class="znz-heading mt-2">Stone Town — A UNESCO World Heritage Site</h2>
                <div class="znz-rule mx-auto mt-3"></div>
                <p class="text-muted mt-3 mx-auto" style="max-width:640px;">A living maze of Swahili, Arab, Indian and European history where every carved door tells a story.</p>
            </div>
            <div class="row g-4">
                @foreach($z['stone_town'] as $s)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="znz-card p-4 h-100">
                        <div class="znz-ico mb-3">@if(!empty($s['image']))<img src="{{ $s['image'] }}" alt="{{ $s['name'] }}" loading="lazy">@else<i class="fas {{ $s['icon'] }}"></i>@endif</div>
                        <h3 class="h6 fw-bold" style="color:var(--deep);">{{ $s['name'] }}</h3>
                        <p class="text-muted small mb-0">{{ $s['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-5" data-aos="fade-up">
                <h3 class="h4 fw-bold text-center mb-4" style="color:var(--deep);">Authentic Swahili Culture Experiences</h3>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    @foreach($z['culture'] as $c)
                        <div class="znz-card px-4 py-3 d-flex align-items-center gap-2">
                            <i class="fas {{ $c['icon'] }}" style="color:var(--teal);"></i>
                            <span class="fw-semibold small">{{ $c['name'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- 3 · SPICE ISLAND -->
    <section id="spice" class="znz-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="znz-kicker">Spice Island Adventures</div>
                <h2 class="znz-heading mt-2">Why Zanzibar is Called the Spice Island</h2>
                <div class="znz-rule mx-auto mt-3"></div>
                <p class="text-muted mt-3 mx-auto" style="max-width:640px;">For centuries Zanzibar's cloves, cinnamon and vanilla drew traders from across the world. A spice tour is a feast for every sense.</p>
            </div>
            <div class="row g-4">
                @foreach($z['spices'] as $sp)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="znz-card p-4 d-flex align-items-start gap-3 h-100">
                        <div class="znz-ico flex-shrink-0">@if(!empty($sp['image']))<img src="{{ $sp['image'] }}" alt="{{ $sp['name'] }}" loading="lazy">@else<i class="fas {{ $sp['icon'] }}"></i>@endif</div>
                        <div>
                            <h3 class="h6 fw-bold mb-1" style="color:var(--deep);">{{ $sp['name'] }}</h3>
                            <p class="text-muted small mb-0">{{ $sp['desc'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 4 · MARINE & TURTLES -->
    <section id="marine" class="znz-section alt">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="znz-kicker">Marine &amp; Conservation</div>
                <h2 class="znz-heading mt-2">Turtles, Dolphins &amp; the Living Reef</h2>
                <div class="znz-rule mx-auto mt-3"></div>
            </div>
            <div class="row g-4 mb-4">
                @foreach($z['turtle'] as $t)
                <div class="col-md-6" data-aos="fade-up">
                    <div class="znz-card p-4 d-flex align-items-start gap-3 h-100">
                        <div class="znz-ico flex-shrink-0">@if(!empty($t['image']))<img src="{{ $t['image'] }}" alt="{{ $t['name'] }}" loading="lazy">@else<i class="fas {{ $t['icon'] }}"></i>@endif</div>
                        <div>
                            <h3 class="h6 fw-bold mb-1" style="color:var(--deep);">{{ $t['name'] }}</h3>
                            <p class="text-muted small mb-0">{{ $t['desc'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row g-3">
                @foreach($z['marine'] as $m)
                <div class="col-lg-3 col-6" data-aos="fade-up">
                    <div class="znz-card p-3 text-center h-100">
                        <i class="fas {{ $m['icon'] }} mb-2" style="color:var(--teal); font-size:1.4rem;"></i>
                        <div class="fw-semibold small">{{ $m['name'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 5 · PRISON ISLAND -->
    <section id="prison" class="znz-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="znz-kicker">Prison Island (Changuu)</div>
                <h2 class="znz-heading mt-2">Giant Tortoises &amp; Island History</h2>
                <div class="znz-rule mx-auto mt-3"></div>
                <p class="text-muted mt-3 mx-auto" style="max-width:640px;">{{ $z['prison_island']['intro'] }}</p>
            </div>
            <div class="row g-4">
                @foreach($z['prison_island']['features'] as $f)
                <div class="col-lg-3 col-md-6" data-aos="fade-up">
                    <div class="znz-card p-4 text-center h-100">
                        <div class="znz-ico mx-auto mb-3">@if(!empty($f['image']))<img src="{{ $f['image'] }}" alt="{{ $f['name'] }}" loading="lazy">@else<i class="fas {{ $f['icon'] }}"></i>@endif</div>
                        <h3 class="h6 fw-bold" style="color:var(--deep);">{{ $f['name'] }}</h3>
                        <p class="text-muted small mb-0">{{ $f['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 6 · JOZANI FOREST -->
    <section id="jozani" class="znz-section alt">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="znz-kicker">Jozani Forest National Park</div>
                <h2 class="znz-heading mt-2">Home of the Rare Red Colobus Monkey</h2>
                <div class="znz-rule mx-auto mt-3"></div>
                <p class="text-muted mt-3 mx-auto" style="max-width:640px;">{{ $z['jozani']['intro'] }}</p>
            </div>
            <div class="row g-4">
                @foreach($z['jozani']['features'] as $f)
                <div class="col-lg-3 col-md-6" data-aos="fade-up">
                    <div class="znz-card p-4 text-center h-100">
                        <div class="znz-ico mx-auto mb-3">@if(!empty($f['image']))<img src="{{ $f['image'] }}" alt="{{ $f['name'] }}" loading="lazy">@else<i class="fas {{ $f['icon'] }}"></i>@endif</div>
                        <h3 class="h6 fw-bold" style="color:var(--deep);">{{ $f['name'] }}</h3>
                        <p class="text-muted small mb-0">{{ $f['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 7 · PACKAGES -->
    <section id="packages" class="znz-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="znz-kicker">Luxury &amp; Romantic Packages</div>
                <h2 class="znz-heading mt-2">Choose Your Zanzibar Experience</h2>
                <div class="znz-rule mx-auto mt-3"></div>
                <p class="text-muted mt-3">Indicative from-prices per person — tailor any itinerary with our team.</p>
            </div>
            <div class="row g-4">
                @foreach($z['packages'] as $pkg)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="znz-card pkg-card h-100 d-flex flex-column">
                        <div class="pkg-head p-4 position-relative">
                            <button type="button" class="fav-btn position-absolute top-0 end-0 m-3 shadow-sm" data-fav="{{ $pkg['name'] }}" aria-label="Save to favourites">
                                <i class="fas fa-heart"></i>
                            </button>
                            <span class="znz-badge mb-2 d-inline-block">{{ $pkg['tag'] }}</span>
                            <h3 class="h5 fw-bold mb-1 text-white"><i class="fas {{ $pkg['icon'] }} me-2"></i>{{ $pkg['name'] }}</h3>
                            <small class="text-white-50"><i class="far fa-moon me-1"></i>{{ $pkg['nights'] }} nights</small>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <div class="mb-3">
                                <span class="text-muted small">From</span>
                                <span class="pkg-price h4 ms-1">${{ number_format($pkg['from']) }}</span>
                                <span class="text-muted small">/ person</span>
                            </div>
                            <ul class="list-unstyled small mb-4">
                                @foreach($pkg['includes'] as $inc)
                                    <li class="mb-2"><i class="fas fa-check-circle me-2" style="color:var(--aqua);"></i>{{ $inc }}</li>
                                @endforeach
                            </ul>
                            <div class="mt-auto d-grid gap-2">
                                <button type="button" class="btn btn-coral rounded-pill py-2" data-bs-toggle="modal" data-bs-target="#generalInquiryModal" data-package="{{ $pkg['name'] }}">
                                    <i class="fas fa-paper-plane me-2"></i>Book / Enquire
                                </button>
                                <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Hello Go Deep Africa, I am interested in the ' . $pkg['name'] . ' Zanzibar package.') }}" target="_blank" rel="noopener" class="btn btn-wa rounded-pill py-2">
                                    <i class="fab fa-whatsapp me-2"></i>Book on WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- MAP -->
    <section class="znz-section alt">
        <div class="container">
            <div class="text-center mb-4" data-aos="fade-up">
                <div class="znz-kicker">Find Your Way</div>
                <h2 class="znz-heading mt-2">Explore Zanzibar</h2>
                <div class="znz-rule mx-auto mt-3"></div>
            </div>
            <div class="znz-map shadow-sm rounded-4 overflow-hidden" data-aos="fade-up">
                <iframe src="https://maps.google.com/maps?q=Zanzibar,Tanzania&z=10&output=embed" height="450" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Map of Zanzibar"></iframe>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="znz-section" style="background:linear-gradient(135deg,var(--deep),var(--teal)); color:#fff;">
        <div class="container text-center" data-aos="zoom-in">
            <h2 class="fw-bold mb-3">Ready for Your Island Escape?</h2>
            <p class="lead mb-4" style="opacity:.9;">Let our Zanzibar specialists craft your perfect beach, culture and adventure itinerary.</p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                <button class="btn btn-coral btn-lg rounded-pill px-5" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                    <i class="fas fa-paper-plane me-2"></i>Start Planning
                </button>
                <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener" class="btn btn-wa btn-lg rounded-pill px-5">
                    <i class="fab fa-whatsapp me-2"></i>Chat Now
                </a>
            </div>
        </div>
    </section>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')

    <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener" class="znz-float-wa" aria-label="Chat on WhatsApp"><i class="fab fa-whatsapp"></i></a>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 700, once: true });

        // Pre-select the chosen package inside the enquiry modal.
        document.querySelectorAll('[data-package]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var name = this.getAttribute('data-package');
                var sel = document.getElementById('inquiry_tour_select');
                if (sel) {
                    var matched = Array.from(sel.options).find(function (o) { return o.text.trim() === name; });
                    if (matched) { sel.value = matched.value; }
                }
            });
        });

        // Lightweight favourites (stored locally in the browser — no account needed).
        (function () {
            var KEY = 'znz_favourites';
            var favs = JSON.parse(localStorage.getItem(KEY) || '[]');
            document.querySelectorAll('.fav-btn').forEach(function (btn) {
                var id = btn.getAttribute('data-fav');
                if (favs.indexOf(id) !== -1) { btn.classList.add('active'); }
                btn.addEventListener('click', function () {
                    var i = favs.indexOf(id);
                    if (i === -1) { favs.push(id); btn.classList.add('active'); }
                    else { favs.splice(i, 1); btn.classList.remove('active'); }
                    localStorage.setItem(KEY, JSON.stringify(favs));
                });
            });
        })();
    </script>
</body>
</html>
