<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', [
        'seoTitle' => 'Why Climb Kilimanjaro With Go Deep Africa Safari',
        'seoDescription' => 'Locally owned, fair porter treatment, seasoned summit guides and strong success rates - the reasons trekkers choose Go Deep Africa Safari for Kilimanjaro.',
        'seoKeywords' => 'best Kilimanjaro tour operator, ethical Kilimanjaro trek, local Kilimanjaro guides, Kilimanjaro success rate',
    ])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .why-us-hero {
            min-height: 70vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 50%, rgba(62,39,35,0.9) 100%),
                        url('https://images.unsplash.com/photo-1627894483216-2138af692e32?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .reason-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .reason-card:hover {
            transform: translateY(-5px);
            border-color: #8B4513;
            box-shadow: 0 15px 40px rgba(139, 69, 19, 0.15);
        }
        .reason-number {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .category-badge {
            position: absolute;
            top: -10px;
            right: 20px;
        }
    </style>
</head>
<body>
    @include('partials.header')

    <!-- Hero Section -->
    <section class="why-us-hero text-white d-flex align-items-center">
        <div class="container text-center" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-4 py-2 mb-3 animate__animated animate__fadeInDown">
                <i class="fas fa-trophy me-2"></i>Kilimanjaro Climbing
            </span>
            <h1 class="display-2 fw-bold mb-4 animate__animated animate__fadeInUp" style="font-family: 'Nunito', sans-serif; text-shadow: 2px 4px 20px rgba(0,0,0,0.5);">
                52 Reasons Why We Set<br>the Gold Standard
            </h1>
            <p class="lead mx-auto mb-4 animate__animated animate__fadeInUp" style="max-width: 800px; text-shadow: 1px 2px 10px rgba(0,0,0,0.5);">
                Based on insights from over 8,000 successful expeditions, these are the reasons why climbers choose Go Deep Africa Safari for their Kilimanjaro adventure.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap animate__animated animate__fadeInUp">
                <a href="#reasons" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                    <i class="fas fa-list-ol me-2"></i>See All 52
                </a>
                <a href="{{ route('kilimanjaro') }}" class="btn btn-lg btn-outline-light rounded-pill px-5 fw-bold">
                    <i class="fas fa-mountain me-2"></i>View Routes
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Banner -->
    <section class="py-4" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
        <div class="container">
            <div class="row text-center text-white g-4">
                <div class="col-6 col-md-3" data-aos="fade-up">
                    <h3 class="display-5 fw-bold mb-1" style="color: #DEB887;">8,000+</h3>
                    <p class="small mb-0 opacity-75">Successful Summits</p>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="50">
                    <h3 class="display-5 fw-bold mb-1" style="color: #DEB887;">98%</h3>
                    <p class="small mb-0 opacity-75">Success Rate</p>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="display-5 fw-bold mb-1" style="color: #DEB887;">15+</h3>
                    <p class="small mb-0 opacity-75">Years Experience</p>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="150">
                    <h3 class="display-5 fw-bold mb-1" style="color: #DEB887;">4.9★</h3>
                    <p class="small mb-0 opacity-75">Guest Rating</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Categories -->
    <section class="py-4 bg-light sticky-top" style="z-index: 100;">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <button class="btn btn-outline-dark rounded-pill active" onclick="filterReasons('all')">All 52</button>
                <button class="btn btn-outline-dark rounded-pill" onclick="filterReasons('safety')">🛡️ Safety</button>
                <button class="btn btn-outline-dark rounded-pill" onclick="filterReasons('guides')">👨‍🏫 Guides</button>
                <button class="btn btn-outline-dark rounded-pill" onclick="filterReasons('equipment')">⛺ Equipment</button>
                <button class="btn btn-outline-dark rounded-pill" onclick="filterReasons('service')">🍽️ Service</button>
                <button class="btn btn-outline-dark rounded-pill" onclick="filterReasons('value')">💰 Value</button>
            </div>
        </div>
    </section>

    <!-- 52 Reasons Grid -->
    <section id="reasons" class="py-5">
        <div class="container py-4">
            <div class="row g-4" id="reasons-grid">
                @php
                $reasons = [
                    ['num' => 1, 'cat' => 'safety', 'icon' => 'fa-heartbeat', 'title' => 'Medical-Grade Pulse Oximeters', 'desc' => 'Daily oxygen level monitoring for every climber'],
                    ['num' => 2, 'cat' => 'safety', 'icon' => 'fa-kit-medical', 'title' => 'Emergency Oxygen Cylinders', 'desc' => 'Available on every climb, not just high camps'],
                    ['num' => 3, 'cat' => 'safety', 'icon' => 'fa-helicopter', 'title' => 'Evacuation Insurance Included', 'desc' => 'Helicopter evacuation covered in every package'],
                    ['num' => 4, 'cat' => 'guides', 'icon' => 'fa-certificate', 'title' => ' certified Guides', 'desc' => 'All guides hold WFR or Wilderness First Responder certification'],
                    ['num' => 5, 'cat' => 'guides', 'icon' => 'fa-graduation-cap', 'title' => '15+ Years Average Experience', 'desc' => 'Our senior guides have summited 300+ times'],
                    ['num' => 6, 'cat' => 'service', 'icon' => 'fa-utensils', 'title' => 'Fresh, Nutritious Meals', 'desc' => '3 hot meals daily with dietary accommodations'],
                    ['num' => 7, 'cat' => 'equipment', 'icon' => 'fa-campground', 'title' => 'Mountain Hardwear Tents', 'desc' => '4-season expedition tents, not budget alternatives'],
                    ['num' => 8, 'cat' => 'equipment', 'icon' => 'fa-snowflake', 'title' => 'Sub-Zero Sleeping Bags', 'desc' => '-25°C rated bags, sanitized after each use'],
                    ['num' => 9, 'cat' => 'service', 'icon' => 'fa-wine-glass', 'title' => 'Summit Celebration Champagne', 'desc' => 'Toast your achievement at Uhuru Peak'],
                    ['num' => 10, 'cat' => 'service', 'icon' => 'fa-hot-tub', 'title' => 'Hot Water Bottles in Tent', 'desc' => 'Warm your sleeping bag before cold nights'],
                    ['num' => 11, 'cat' => 'value', 'icon' => 'fa-hand-holding-usd', 'title' => 'No Hidden Costs', 'desc' => 'Park fees, transfers, meals - all included upfront'],
                    ['num' => 12, 'cat' => 'safety', 'icon' => 'fa-stethoscope', 'title' => 'Twice-Daily Health Checks', 'desc' => 'Morning and evening medical assessments'],
                    ['num' => 13, 'cat' => 'guides', 'icon' => 'fa-users', 'title' => '3:1 Client-to-Guide Ratio', 'desc' => 'More personalized attention on the mountain'],
                    ['num' => 14, 'cat' => 'equipment', 'icon' => 'fa-solar-panel', 'title' => 'Solar Charging Stations', 'desc' => 'Keep devices powered throughout the climb'],
                    ['num' => 15, 'cat' => 'service', 'icon' => 'fa-shower', 'title' => 'Portable Hot Showers', 'desc' => 'Available on longer routes, not just wet wipes'],
                    ['num' => 16, 'cat' => 'value', 'icon' => 'fa-calendar-check', 'title' => 'Flexible Booking Policy', 'desc' => 'Free date changes up to 30 days before'],
                    ['num' => 17, 'cat' => 'safety', 'icon' => 'fa-mask-ventilator', 'title' => 'Gamow Bag Available', 'desc' => 'Portable hyperbaric chamber at base camp'],
                    ['num' => 18, 'cat' => 'guides', 'icon' => 'fa-language', 'title' => 'English, Spanish, French Guides', 'desc' => 'Multiple language options available'],
                    ['num' => 19, 'cat' => 'equipment', 'icon' => 'fa-mountain', 'title' => 'Free Trekking Poles', 'desc' => 'High-quality Leki poles for all climbers'],
                    ['num' => 20, 'cat' => 'service', 'icon' => 'fa-birthday-cake', 'title' => 'Birthday/Special Occasion Cakes', 'desc' => 'Celebrate milestones on the mountain'],
                    ['num' => 21, 'cat' => 'value', 'icon' => 'fa-percent', 'title' => 'Best Price Guarantee', 'desc' => 'Match any comparable operator\'s price'],
                    ['num' => 22, 'cat' => 'safety', 'icon' => 'fa-walkie-talkie', 'title' => 'Satellite Communication', 'desc' => '24/7 emergency contact capability'],
                    ['num' => 23, 'cat' => 'guides', 'icon' => 'fa-medal', 'title' => 'Guides Trained in UK/US', 'desc' => 'International standards, local expertise'],
                    ['num' => 24, 'cat' => 'equipment', 'icon' => 'fa-vest', 'title' => 'Free Rental Jacket', 'desc' => 'Down jackets available if you forget yours'],
                    ['num' => 25, 'cat' => 'service', 'icon' => 'fa-wifi', 'title' => 'WiFi at Most Camps', 'desc' => 'Stay connected (where signal permits)'],
                    ['num' => 26, 'cat' => 'safety', 'icon' => 'fa-eye', 'title' => 'Daily Vision Tests', 'desc' => 'Early altitude sickness detection'],
                    ['num' => 27, 'cat' => 'guides', 'icon' => 'fa-book-open', 'title' => 'First Aid Training Included', 'desc' => 'Free wilderness first aid for groups'],
                    ['num' => 28, 'cat' => 'equipment', 'icon' => 'fa-bed', 'title' => 'Comfortable Camp Cots', 'desc' => 'Sleep off the ground, not on rocks'],
                    ['num' => 29, 'cat' => 'service', 'icon' => 'fa-coffee', 'title' => 'Fresh Coffee Every Morning', 'desc' => 'Real coffee, not instant - wake up right'],
                    ['num' => 30, 'cat' => 'value', 'icon' => 'fa-undo', 'title' => '100% Money-Back Promise', 'desc' => 'If we don\'t deliver as promised'],
                    ['num' => 31, 'cat' => 'safety', 'icon' => 'fa-hospital', 'title' => 'On-Call Doctor Available', 'desc' => '24/7 medical consultation by phone'],
                    ['num' => 32, 'cat' => 'guides', 'icon' => 'fa-leaf', 'title' => 'Leave No Trace Certified', 'desc' => 'Environmentally responsible climbing'],
                    ['num' => 33, 'cat' => 'equipment', 'icon' => 'fa-tint', 'title' => 'Water Purification Systems', 'desc' => 'Safe drinking water at every camp'],
                    ['num' => 34, 'cat' => 'service', 'icon' => 'fa-music', 'title' => 'Traditional Songs at Camp', 'desc' => 'Cultural experience with Chagga music'],
                    ['num' => 35, 'cat' => 'value', 'icon' => 'fa-gift', 'title' => 'Free Airport Transfers', 'desc' => 'Both ways, included in all packages'],
                    ['num' => 36, 'cat' => 'safety', 'icon' => 'fa-thermometer-half', 'title' => 'Weather Monitoring Daily', 'desc' => 'Professional meteorological updates'],
                    ['num' => 37, 'cat' => 'guides', 'icon' => 'fa-smile', 'title' => '98% Guest Satisfaction', 'desc' => 'Based on post-climb surveys'],
                    ['num' => 38, 'cat' => 'equipment', 'icon' => 'fa-lightbulb', 'title' => 'LED Headlamps Provided', 'desc' => 'Quality lighting for summit night'],
                    ['num' => 39, 'cat' => 'service', 'icon' => 'fa-camera', 'title' => 'Professional Photo Package', 'desc' => 'Optional summit photography service'],
                    ['num' => 40, 'cat' => 'value', 'icon' => 'fa-hands-helping', 'title' => 'Porter Welfare Program', 'desc' => 'Fair wages, proper equipment for staff'],
                    ['num' => 41, 'cat' => 'safety', 'icon' => 'fa-route', 'title' => 'GPS Tracking Enabled', 'desc' => 'Family can follow your progress online'],
                    ['num' => 42, 'cat' => 'guides', 'icon' => 'fa-star', 'title' => 'Featured in Top Magazines', 'desc' => 'National Geographic, Travel + Leisure'],
                    ['num' => 43, 'cat' => 'equipment', 'icon' => 'fa-box-open', 'title' => 'Spare Gear Available', 'desc' => 'Emergency replacements if gear fails'],
                    ['num' => 44, 'cat' => 'service', 'icon' => 'fa-soap', 'title' => 'Hand Washing Stations', 'desc' => 'Hygiene maintained at all camps'],
                    ['num' => 45, 'cat' => 'value', 'icon' => 'fa-coins', 'title' => 'Group Discounts Available', 'desc' => '5+ people save 10%, 10+ save 15%'],
                    ['num' => 46, 'cat' => 'safety', 'icon' => 'fa-first-aid', 'title' => 'Comprehensive First Aid Kits', 'desc' => 'Every guide carries extensive medical supplies'],
                    ['num' => 47, 'cat' => 'guides', 'icon' => 'fa-award', 'title' => 'Award-Winning Service', 'desc' => 'Tourism Excellence Awards 2023 & 2024'],
                    ['num' => 48, 'cat' => 'equipment', 'icon' => 'fa-suitcase-rolling', 'title' => 'Gear Storage Available', 'desc' => 'Leave non-climb items safely in Arusha'],
                    ['num' => 49, 'cat' => 'service', 'icon' => 'fa-comments', 'title' => 'Pre-Climb Briefing', 'desc' => 'Detailed preparation meeting before departure'],
                    ['num' => 50, 'cat' => 'value', 'icon' => 'fa-receipt', 'title' => 'Transparent Pricing', 'desc' => 'No surprise fees, ever'],
                    ['num' => 51, 'cat' => 'safety', 'icon' => 'fa-life-ring', 'title' => 'Rescue Insurance for Staff', 'desc' => 'Our porters and guides are fully covered'],
                    ['num' => 52, 'cat' => 'guides', 'icon' => 'fa-heart', 'title' => 'We Love What We Do', 'desc' => 'Passion for mountains, genuine care for climbers'],
                ];
                @endphp

                @foreach($reasons as $reason)
                <div class="col-md-6 col-lg-4 reason-item" data-category="{{ $reason['cat'] }}" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    <div class="reason-card card h-100 border-0 rounded-4 shadow-sm position-relative">
                        <span class="category-badge badge bg-dark">
                            {{ ucfirst($reason['cat']) }}
                        </span>
                        <div class="card-body p-4">
                            <div class="d-flex gap-3 mb-3">
                                <div class="reason-number flex-shrink-0">
                                    {{ $reason['num'] }}
                                </div>
                                <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: rgba(139, 69, 19, 0.1);">
                                    <i class="fas {{ $reason['icon'] }}" style="color: #8B4513; font-size: 1.2rem;"></i>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-2" style="color: #3E2723;">{{ $reason['title'] }}</h5>
                            <p class="text-muted small mb-0">{{ $reason['desc'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
        <div class="container py-4 text-center text-white">
            <h2 class="fw-bold mb-3" style="font-family: 'Nunito', sans-serif;">Ready to Experience the Gold Standard?</h2>
            <p class="lead mb-4 opacity-75">Join thousands of successful climbers who chose Go Deep Africa Safari</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('kilimanjaro') }}" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                    <i class="fas fa-mountain me-2"></i>View Routes & Prices
                </a>
                <a href="{{ route('contact') }}" class="btn btn-lg btn-outline-light rounded-pill px-5 fw-bold">
                    <i class="fas fa-phone me-2"></i>Contact Us
                </a>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        function filterReasons(category) {
            const items = document.querySelectorAll('.reason-item');
            const buttons = document.querySelectorAll('.sticky-top .btn');
            
            // Update active button
            buttons.forEach(btn => {
                btn.classList.remove('active', 'btn-dark');
                btn.classList.add('btn-outline-dark');
            });
            event.target.classList.remove('btn-outline-dark');
            event.target.classList.add('btn-dark', 'active');
            
            // Filter items
            items.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = '';
                    setTimeout(() => item.style.opacity = '1', 10);
                } else {
                    item.style.opacity = '0';
                    setTimeout(() => item.style.display = 'none', 300);
                }
            });
        }
    </script>
</body>
</html>
