<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kilimanjaro Routes - Compare All Routes - Go Deep Africa Safari</title>
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .routes-hero {
            min-height: 60vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 100%),
                        url('https://images.unsplash.com/photo-1516422213484-21db3332906c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
        .route-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .route-card:hover {
            transform: translateY(-10px);
            border-color: #8B4513;
        }
        .route-card.featured {
            border-color: #8B4513;
            transform: scale(1.02);
        }
        .route-badge {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            color: white;
            padding: 8px 24px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
        }
        .difficulty-bar {
            height: 8px;
            border-radius: 4px;
            background: #e0e0e0;
            overflow: hidden;
        }
        .difficulty-fill {
            height: 100%;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    @include('partials.header')

    <!-- Hero -->
    <section class="routes-hero text-white d-flex align-items-center">
        <div class="container text-center" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-4 py-2 mb-3">
                <i class="fas fa-route me-2"></i>Route Comparison
            </span>
            <h1 class="display-3 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">
                All Kilimanjaro Routes
            </h1>
            <p class="lead mx-auto mb-4" style="max-width: 700px;">
                Compare difficulty, scenery, success rates, and duration to find your perfect route to Uhuru Peak.
            </p>
        </div>
    </section>

    <!-- Route Cards -->
    <section class="py-5">
        <div class="container py-4">
            <div class="row g-4">
                <!-- Machame Route -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="route-card card h-100 border-0 rounded-4 shadow-sm position-relative">
                        <span class="route-badge">Most Popular</span>
                        <div class="card-body p-4 p-lg-5">
                            <h4 class="fw-bold mb-2" style="color: #3E2723;">Machame Route</h4>
                            <p class="text-muted small mb-4">The Whiskey Route - Scenic and popular</p>
                            
                            <div class="mb-4">
                                <span class="display-4 fw-bold" style="color: #8B4513;">6-7</span>
                                <span class="text-muted">days</span>
                            </div>

                            <div class="mb-4">
                                <small class="text-muted d-block mb-1">Difficulty</small>
                                <div class="difficulty-bar"><div class="difficulty-fill bg-warning" style="width: 70%"></div></div>
                            </div>

                            <ul class="list-unstyled mb-4 small">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>93% success rate</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Best scenery</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Good acclimatization</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i>Camping accommodation</li>
                            </ul>

                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-2 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Enquire Now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Marangu Route -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="route-card card h-100 border-0 rounded-4 shadow-sm position-relative">
                        <div class="card-body p-4 p-lg-5">
                            <h4 class="fw-bold mb-2" style="color: #3E2723;">Marangu Route</h4>
                            <p class="text-muted small mb-4">The Coca-Cola Route - Easiest path</p>
                            
                            <div class="mb-4">
                                <span class="display-4 fw-bold" style="color: #8B4513;">5-6</span>
                                <span class="text-muted">days</span>
                            </div>

                            <div class="mb-4">
                                <small class="text-muted d-block mb-1">Difficulty</small>
                                <div class="difficulty-bar"><div class="difficulty-fill bg-success" style="width: 40%"></div></div>
                            </div>

                            <ul class="list-unstyled mb-4 small">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>85% success rate</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Hut accommodation</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Easiest climb</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i>Most popular</li>
                            </ul>

                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-2 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Enquire Now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Lemosho Route -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="route-card featured card h-100 border-0 rounded-4 shadow-lg position-relative">
                        <span class="route-badge">Best Scenery</span>
                        <div class="card-body p-4 p-lg-5">
                            <h4 class="fw-bold mb-2" style="color: #3E2723;">Lemosho Route</h4>
                            <p class="text-muted small mb-4">Most scenic route - Remote and beautiful</p>
                            
                            <div class="mb-4">
                                <span class="display-4 fw-bold" style="color: #8B4513;">7-8</span>
                                <span class="text-muted">days</span>
                            </div>

                            <div class="mb-4">
                                <small class="text-muted d-block mb-1">Difficulty</small>
                                <div class="difficulty-bar"><div class="difficulty-fill bg-warning" style="width: 60%"></div></div>
                            </div>

                            <ul class="list-unstyled mb-4 small">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>95% success rate</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Best scenery</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Low traffic</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i>Excellent acclimatization</li>
                            </ul>

                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-2 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Enquire Now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Rongai Route -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="route-card card h-100 border-0 rounded-4 shadow-sm position-relative">
                        <div class="card-body p-4 p-lg-5">
                            <h4 class="fw-bold mb-2" style="color: #3E2723;">Rongai Route</h4>
                            <p class="text-muted small mb-4">The only route from the north</p>
                            
                            <div class="mb-4">
                                <span class="display-4 fw-bold" style="color: #8B4513;">6-7</span>
                                <span class="text-muted">days</span>
                            </div>

                            <div class="mb-4">
                                <small class="text-muted d-block mb-1">Difficulty</small>
                                <div class="difficulty-bar"><div class="difficulty-fill bg-warning" style="width: 55%"></div></div>
                            </div>

                            <ul class="list-unstyled mb-4 small">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>90% success rate</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Less crowded</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Dry conditions</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i>Camping accommodation</li>
                            </ul>

                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-2 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Enquire Now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Northern Circuit -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="route-card card h-100 border-0 rounded-4 shadow-sm position-relative">
                        <span class="route-badge">Longest Route</span>
                        <div class="card-body p-4 p-lg-5">
                            <h4 class="fw-bold mb-2" style="color: #3E2723;">Northern Circuit</h4>
                            <p class="text-muted small mb-4">The longest route - Best acclimatization</p>
                            
                            <div class="mb-4">
                                <span class="display-4 fw-bold" style="color: #8B4513;">8-9</span>
                                <span class="text-muted">days</span>
                            </div>

                            <div class="mb-4">
                                <small class="text-muted d-block mb-1">Difficulty</small>
                                <div class="difficulty-bar"><div class="difficulty-fill bg-warning" style="width: 65%"></div></div>
                            </div>

                            <ul class="list-unstyled mb-4 small">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>98% success rate</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Best acclimatization</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Very scenic</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i>Low traffic</li>
                            </ul>

                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-2 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Enquire Now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Umbwe Route -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="route-card card h-100 border-0 rounded-4 shadow-sm position-relative">
                        <div class="card-body p-4 p-lg-5">
                            <h4 class="fw-bold mb-2" style="color: #3E2723;">Umbwe Route</h4>
                            <p class="text-muted small mb-4">The steepest route - For experienced climbers</p>
                            
                            <div class="mb-4">
                                <span class="display-4 fw-bold" style="color: #8B4513;">5-6</span>
                                <span class="text-muted">days</span>
                            </div>

                            <div class="mb-4">
                                <small class="text-muted d-block mb-1">Difficulty</small>
                                <div class="difficulty-bar"><div class="difficulty-fill bg-danger" style="width: 85%"></div></div>
                            </div>

                            <ul class="list-unstyled mb-4 small">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>80% success rate</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Shortest route</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Challenging</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i>For experienced hikers</li>
                            </ul>

                            <a href="{{ route('contact') }}" class="btn w-100 rounded-pill py-2 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                Enquire Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Route Comparison Table -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <h2 class="display-5 fw-bold mb-4 text-center" style="color: #3E2723; font-family: 'Playfair Display', serif;" data-aos="fade-up">
                Quick Comparison
            </h2>
            <div class="card border-0 rounded-4 shadow-lg overflow-hidden" data-aos="fade-up">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
                                <tr>
                                    <th class="text-white fw-bold py-3">Route</th>
                                    <th class="text-white fw-bold py-3">Days</th>
                                    <th class="text-white fw-bold py-3">Difficulty</th>
                                    <th class="text-white fw-bold py-3">Success Rate</th>
                                    <th class="text-white fw-bold py-3">Traffic</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold" style="color: #8B4513;">Machame</td>
                                    <td>6-7</td>
                                    <td>Medium</td>
                                    <td><span class="badge bg-success">93%</span></td>
                                    <td><span class="badge bg-danger">High</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" style="color: #8B4513;">Marangu</td>
                                    <td>5-6</td>
                                    <td>Easy</td>
                                    <td><span class="badge bg-warning">85%</span></td>
                                    <td><span class="badge bg-danger">High</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" style="color: #8B4513;">Lemosho</td>
                                    <td>7-8</td>
                                    <td>Medium</td>
                                    <td><span class="badge bg-success">95%</span></td>
                                    <td><span class="badge bg-success">Low</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" style="color: #8B4513;">Rongai</td>
                                    <td>6-7</td>
                                    <td>Medium</td>
                                    <td><span class="badge bg-success">90%</span></td>
                                    <td><span class="badge bg-success">Low</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" style="color: #8B4513;">Northern Circuit</td>
                                    <td>8-9</td>
                                    <td>Medium</td>
                                    <td><span class="badge bg-success">98%</span></td>
                                    <td><span class="badge bg-success">Low</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" style="color: #8B4513;">Umbwe</td>
                                    <td>5-6</td>
                                    <td>Hard</td>
                                    <td><span class="badge bg-warning">80%</span></td>
                                    <td><span class="badge bg-success">Low</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
        <div class="container py-4 text-center text-white">
            <h2 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Need Help Choosing?</h2>
            <p class="lead mb-4 opacity-75">Our experts can help you select the perfect route based on your fitness and goals</p>
            <a href="{{ route('contact') }}" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                <i class="fas fa-comments me-2"></i>Talk to an Expert
            </a>
        </div>
    </section>

    @include('partials.footer')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>
