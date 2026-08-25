<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', [
        'seoTitle' => 'Kilimanjaro Success Calculator: Your Summit Odds',
        'seoDescription' => 'Estimate your chance of reaching Uhuru Peak. See how route choice, trek length, acclimatisation and fitness change your Kilimanjaro summit success odds.',
        'seoKeywords' => 'Kilimanjaro success rate, Kilimanjaro summit chances, Kilimanjaro route success rates',
    ])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .calculator-hero {
            min-height: 50vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 100%),
                        url('https://images.unsplash.com/photo-1627894483216-2138af692e32?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
        .calculator-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        .result-badge {
            font-size: 3rem;
            font-weight: bold;
            color: #8B4513;
        }
    </style>
</head>
<body>
    @include('partials.header')

    <section class="calculator-hero text-white d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-3 fw-bold mb-4" style="font-family: 'Nunito', sans-serif;">
                Kilimanjaro Success Calculator
            </h1>
            <p class="lead">Estimate your chances of reaching Uhuru Peak</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="calculator-card p-4 p-md-5">
                        <h3 class="fw-bold mb-4 text-center" style="color: #3E2723;">Answer a Few Questions</h3>
                        
                        <form id="successCalculator">
                            <div class="mb-4">
                                <label class="form-label fw-bold">What route will you take?</label>
                                <select class="form-select form-select-lg rounded-3" id="route">
                                    <option value="70">Marangu (Coca-Cola Route) - 5-6 days</option>
                                    <option value="85" selected>Machame (Whiskey Route) - 6-7 days</option>
                                    <option value="90">Lemosho Route - 7-8 days</option>
                                    <option value="92">Northern Circuit - 8-9 days</option>
                                    <option value="75">Rongai Route - 6-7 days</option>
                                    <option value="65">Umbwe Route - 5-6 days</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">How would you rate your fitness level?</label>
                                <select class="form-select form-select-lg rounded-3" id="fitness">
                                    <option value="-10">Beginner / Not very active</option>
                                    <option value="0" selected>Moderate - Exercise sometimes</option>
                                    <option value="5">Good - Exercise regularly</option>
                                    <option value="10">Excellent - Very active / Athletic</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Have you done high altitude before?</label>
                                <select class="form-select form-select-lg rounded-3" id="altitude">
                                    <option value="0" selected>Never / Not sure</option>
                                    <option value="5">Yes, up to 3,000m</option>
                                    <option value="10">Yes, up to 4,000m</option>
                                    <option value="15">Yes, above 5,000m</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">How old are you?</label>
                                <select class="form-select form-select-lg rounded-3" id="age">
                                    <option value="-5">Under 20</option>
                                    <option value="0" selected>20-40 years</option>
                                    <option value="-5">41-55 years</option>
                                    <option value="-10">Over 55</option>
                                </select>
                            </div>

                            <button type="button" class="btn w-100 rounded-pill py-3 fw-bold" onclick="calculateSuccess()" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                                <i class="fas fa-calculator me-2"></i>Calculate My Success Rate
                            </button>
                        </form>

                        <div id="result" class="text-center mt-5 d-none">
                            <h4 class="fw-bold mb-3">Your Estimated Success Rate</h4>
                            <div class="result-badge" id="percentage">85%</div>
                            <p class="text-muted mt-3" id="message">Great choice! Machame route with your profile gives you excellent chances.</p>
                            <a href="{{ route('contact') }}" class="btn btn-outline-dark rounded-pill px-5 mt-3">
                                <i class="fas fa-envelope me-2"></i>Get Expert Advice
                            </a>
                        </div>
                    </div>

                    <div class="alert alert-info rounded-4 mt-4">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Note:</strong> This is an estimate based on statistics. Actual success depends on many factors including weather, acclimatization, and determination!
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script>
        function calculateSuccess() {
            const base = parseInt(document.getElementById('route').value);
            const fitness = parseInt(document.getElementById('fitness').value);
            const altitude = parseInt(document.getElementById('altitude').value);
            const age = parseInt(document.getElementById('age').value);
            
            let total = base + fitness + altitude + age;
            total = Math.max(30, Math.min(98, total)); // Keep between 30-98%
            
            document.getElementById('percentage').textContent = total + '%';
            
            let message = '';
            if (total >= 90) message = 'Excellent! With this profile and route, you have outstanding chances of summiting!';
            else if (total >= 80) message = 'Very good! Your chances are strong. Follow our preparation advice for best results.';
            else if (total >= 70) message = 'Good chances! Consider a longer route or more training to improve odds.';
            else message = 'Moderate chances. We recommend more preparation or choosing a longer acclimatization route.';
            
            document.getElementById('message').textContent = message;
            document.getElementById('result').classList.remove('d-none');
            document.getElementById('result').scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>
</html>
