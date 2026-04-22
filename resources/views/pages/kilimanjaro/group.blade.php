<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Group Departures - Join Scheduled Kilimanjaro Climbs - Go Deep Africa Safari</title>
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .group-hero {
            min-height: 60vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 100%),
                        url('https://images.unsplash.com/photo-1516422213484-21db3332906c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
        .departure-card {
            transition: all 0.3s ease;
        }
        .departure-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(139, 69, 19, 0.2);
        }
        .spots-badge {
            position: absolute;
            top: 15px;
            right: 15px;
        }
        .status-open { background: #28a745; }
        .status-limited { background: #ffc107; color: #000; }
        .status-full { background: #dc3545; }
    </style>
</head>
<body>
    @include('partials.header')

    <!-- Hero -->
    <section class="group-hero text-white d-flex align-items-center">
        <div class="container text-center" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-4 py-2 mb-3">
                <i class="fas fa-users me-2"></i>Join a Group
            </span>
            <h1 class="display-3 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">
                Group Departures 2026-2027
            </h1>
            <p class="lead mx-auto mb-4" style="max-width: 700px;">
                Meet fellow adventurers, share costs, and make lifelong friends. Only $100 deposit to secure your spot!
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <span class="badge bg-success px-3 py-2"><i class="fas fa-check me-2"></i>$100 Deposit</span>
                <span class="badge bg-success px-3 py-2"><i class="fas fa-check me-2"></i>Save 10-15%</span>
                <span class="badge bg-success px-3 py-2"><i class="fas fa-check me-2"></i>Make New Friends</span>
            </div>
        </div>
    </section>

    <!-- Why Group -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="row g-4">
                <div class="col-md-4 text-center" data-aos="fade-up">
                    <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                        <i class="fas fa-piggy-bank text-white fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #3E2723;">Save Money</h4>
                    <p class="text-muted">10-15% discount compared to private climbs. Same gold standard service, lower price.</p>
                </div>
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                        <i class="fas fa-user-friends text-white fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #3E2723;">Make Friends</h4>
                    <p class="text-muted">Climb with like-minded adventurers from around the world. Share the journey!</p>
                </div>
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                        <i class="fas fa-calendar-check text-white fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #3E2723;">Guaranteed Dates</h4>
                    <p class="text-muted">Group climbs never cancel. Even if it's just you, the climb goes ahead.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Departures -->
    <section class="py-5">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h2 class="display-5 fw-bold mb-2" style="color: #3E2723; font-family: 'Playfair Display', serif;">
                        Upcoming Departures
                    </h2>
                    <p class="text-muted mb-0">Book your spot with just $100 deposit</p>
                </div>
                <div class="d-none d-md-flex gap-2">
                    <span class="badge bg-success">Open</span>
                    <span class="badge bg-warning text-dark">Limited</span>
                    <span class="badge bg-danger">Full</span>
                </div>
            </div>

            <div class="row g-4">
                @php
                $departures = [
                    ['date' => 'Jun 15, 2026', 'route' => 'Machame Route', 'days' => 6, 'price' => '$1,665', 'spots' => 8, 'total' => 12, 'status' => 'open'],
                    ['date' => 'Jun 28, 2026', 'route' => 'Lemosho Route', 'days' => 7, 'price' => '$2,205', 'spots' => 5, 'total' => 10, 'status' => 'open'],
                    ['date' => 'Jul 10, 2026', 'route' => 'Rongai Route', 'days' => 6, 'price' => '$1,665', 'spots' => 2, 'total' => 12, 'status' => 'limited'],
                    ['date' => 'Jul 22, 2026', 'route' => 'Machame Route', 'days' => 6, 'price' => '$1,665', 'spots' => 0, 'total' => 12, 'status' => 'full'],
                    ['date' => 'Aug 5, 2026', 'route' => 'Northern Circuit', 'days' => 8, 'price' => '$3,465', 'spots' => 6, 'total' => 8, 'status' => 'open'],
                    ['date' => 'Aug 18, 2026', 'route' => 'Lemosho Route', 'days' => 7, 'price' => '$2,205', 'spots' => 9, 'total' => 12, 'status' => 'open'],
                    ['date' => 'Sep 1, 2026', 'route' => 'Machame Route', 'days' => 6, 'price' => '$1,665', 'spots' => 10, 'total' => 12, 'status' => 'open'],
                    ['date' => 'Sep 15, 2026', 'route' => 'Umbwe Route', 'days' => 5, 'price' => '$1,485', 'spots' => 3, 'total' => 8, 'status' => 'limited'],
                ];
                @endphp

                @foreach($departures as $dep)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="departure-card card h-100 border-0 rounded-4 shadow-sm position-relative">
                        @php
                        $spotPercent = ($dep['spots'] / $dep['total']) * 100;
                        $statusClass = $dep['status'] == 'open' ? 'status-open' : ($dep['status'] == 'limited' ? 'status-limited' : 'status-full');
                        $statusText = $dep['status'] == 'open' ? 'Spots Available' : ($dep['status'] == 'limited' ? 'Limited Spots' : 'Fully Booked');
                        @endphp
                        <span class="spots-badge badge {{ $statusClass }}">
                            {{ $dep['spots'] }} / {{ $dep['total'] }} {{ $statusText }}
                        </span>
                        
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="text-center p-3 rounded-3" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                    <span class="d-block text-white fw-bold">{{ date('M', strtotime($dep['date'])) }}</span>
                                    <span class="d-block text-white display-6 fw-bold">{{ date('d', strtotime($dep['date'])) }}</span>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1" style="color: #3E2723;">{{ $dep['route'] }}</h5>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-clock me-1"></i>{{ $dep['days'] }} Days
                                    </span>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar {{ $statusClass }}" role="progressbar" style="width: {{ 100 - $spotPercent }}%"></div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="text-muted small">Group Price</span>
                                    <h4 class="fw-bold mb-0" style="color: #8B4513;">{{ $dep['price'] }}</h4>
                                </div>
                                <div class="text-end">
                                    <span class="text-muted small">Deposit</span>
                                    <h5 class="fw-bold mb-0 text-success">$100</h5>
                                </div>
                            </div>

                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-2 fw-bold {{ $dep['status'] == 'full' ? 'btn-secondary disabled' : '' }}" 
                               style="{{ $dep['status'] != 'full' ? 'background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;' : '' }}">
                                {{ $dep['status'] == 'full' ? 'Join Waitlist' : 'Book This Date' }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('contact') }}" class="btn btn-outline-dark rounded-pill px-5">
                    <i class="fas fa-calendar-alt me-2"></i>View All 2026-2027 Dates
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <h2 class="display-5 fw-bold mb-5 text-center" style="color: #3E2723; font-family: 'Playfair Display', serif;" data-aos="fade-up">
                How Group Departures Work
            </h2>
            <div class="row g-4">
                @php
                $steps = [
                    ['num' => '1', 'icon' => 'fa-mouse-pointer', 'title' => 'Choose Your Date', 'desc' => 'Browse our scheduled departures and pick the date that works for you.'],
                    ['num' => '2', 'icon' => 'fa-credit-card', 'title' => 'Pay $100 Deposit', 'desc' => 'Secure your spot with a small deposit. Balance due 30 days before climb.'],
                    ['num' => '3', 'icon' => 'fa-envelope', 'title' => 'Get Pre-Trip Info', 'desc' => 'Receive detailed packing list, training tips, and meeting point details.'],
                    ['num' => '4', 'icon' => 'fa-plane-arrival', 'title' => 'Arrive in Tanzania', 'desc' => 'We pick you up from the airport and take you to your hotel.'],
                    ['num' => '5', 'icon' => 'fa-users', 'title' => 'Meet Your Group', 'desc' => 'Pre-climb briefing where you meet your fellow climbers and guides.'],
                    ['num' => '6', 'icon' => 'fa-flag-checkered', 'title' => 'Summit Together!', 'desc' => 'Climb as a team, support each other, and celebrate at Uhuru Peak.'],
                ];
                @endphp

                @foreach($steps as $step)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card h-100 border-0 rounded-4 shadow-sm p-4">
                        <div class="d-flex gap-3">
                            <div class="flex-shrink-0">
                                <div class="reason-number mb-2">{{ $step['num'] }}</div>
                                <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: rgba(139, 69, 19, 0.1);">
                                    <i class="fas {{ $step['icon'] }}" style="color: #8B4513;"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2" style="color: #3E2723;">{{ $step['title'] }}</h5>
                                <p class="text-muted small mb-0">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-5">
        <div class="container py-4">
            <div class="row g-4">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="display-5 fw-bold mb-4" style="color: #3E2723; font-family: 'Playfair Display', serif;">
                        Group Climb FAQ
                    </h2>
                    <div class="accordion" id="faqAccordion">
                        @php
                        $faqs = [
                            ['q' => 'What if the group is too small?', 'a' => 'We guarantee all group departures run regardless of final numbers. Even if only 2 people book, the climb proceeds.'],
                            ['q' => 'Can I request a specific roommate?', 'a' => 'Yes! If you\'re traveling with a friend, let us know and we\'ll tent you together. Otherwise, we match by gender.'],
                            ['q' => 'Is the service different from private climbs?', 'a' => 'Absolutely not! You get the same gold standard service, equipment, and safety measures. The only difference is you share the adventure.'],
                            ['q' => 'What if I need to cancel?', 'a' => 'Cancel 30+ days before: full refund minus $50 processing. 15-30 days: 50% refund. Less than 15 days: deposit forfeited but transferable to another date.'],
                        ];
                        @endphp

                        @foreach($faqs as $faq)
                        <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }} fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $loop->index }}">
                                    {{ $faq['q'] }}
                                </button>
                            </h2>
                            <div id="faq{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    {{ $faq['a'] }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card border-0 rounded-4 shadow-lg overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1533240332313-0db49b459ad6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" style="height: 250px; object-fit: cover;" alt="Group climbing">
                        <div class="card-body p-4" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
                            <h4 class="fw-bold text-white mb-2">Private Group? No Problem!</h4>
                            <p class="text-white-75 mb-3">Have 5+ friends? Create your own group departure on any date you choose!</p>
                            <a href="{{ route('contact') }}" class="btn btn-light rounded-pill px-4">
                                <i class="fas fa-users me-2"></i>Create Private Group
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
        <div class="container py-4 text-center text-white">
            <h2 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Ready to Join a Group?</h2>
            <p class="lead mb-4 opacity-75">Book your spot with just $100 deposit</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="#" onclick="document.getElementById('departures').scrollIntoView({behavior: 'smooth'}); return false;" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                    <i class="fas fa-calendar me-2"></i>View Dates
                </a>
                <a href="{{ route('contact') }}" class="btn btn-lg btn-outline-light rounded-pill px-5 fw-bold">
                    <i class="fas fa-phone me-2"></i>Contact Us
                </a>
            </div>
        </div>
    </section>

    @include('partials.footer')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>
