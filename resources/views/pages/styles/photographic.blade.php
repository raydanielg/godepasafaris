<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', [
        'seoTitle' => 'Photographic Safaris in Tanzania | Capture the Wild | Go Deep Africa',
        'seoDescription' => 'Photographic safaris designed for great light, low angles and unhurried sightings across Tanzania. Capture the Great Migration and Big Five with Go Deep Africa Safari.',
    ])
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .bg-earth { background-color: #8b4513 !important; }
        .text-earth { color: #8b4513 !important; }
        .btn-earth { background-color: #8b4513 !important; border-color: #8b4513 !important; color: white !important; }
        .btn-earth:hover { background-color: #a0522d !important; border-color: #a0522d !important; }
    </style>
</head>
<body class="bg-light">
    @include('partials.header')

    <!-- Hero Section -->
    <section class="position-relative" style="min-height: 60vh;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(62,39,35,0.7)), url('https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center;"></div>
        <div class="container position-relative text-white d-flex flex-column justify-content-center" style="min-height: 60vh;">
            <h1 class="display-3 fw-bold mb-3" style="font-family: 'Nunito', sans-serif;">Photographic Safaris</h1>
            <p class="lead fs-4 mb-4">Capture the Untamed Beauty of Africa</p>
            <div class="d-flex gap-3">
                <button class="btn btn-earth rounded-pill px-5 py-3 fw-bold" data-bs-toggle="modal" data-bs-target="#generalInquiryModal" onclick="preselectPhotographicSafari()">
                    <i class="fas fa-camera me-2"></i>PLAN YOUR SHOOT
                </button>
            </div>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="py-5">
        <div class="container py-4">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="display-5 fw-bold mb-4" style="font-family: 'Nunito', sans-serif; color: #3E2723;">Focus on the Perfect Shot</h2>
                    <p class="lead text-muted mb-4">Our Photographic Safaris are specialized journeys designed for both amateur and professional photographers. We provide the patience, expertise, and equipment necessary to capture Africa's wildlife in its most stunning moments.</p>
                    <p class="text-muted mb-4">We use specially modified 4x4 vehicles with 360-degree views and lower mounts for the perfect angle. Our guides are trained to position the vehicle according to the light and animal behavior, ensuring you never miss a beat.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-3"></i>Customized vehicles for photography</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-3"></i>Expert photography guides</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-3"></i>Golden hour scheduling</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-earth me-3"></i>Bean bags and lens support</li>
                    </ul>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1612036782180-6f0b6cd846fe?auto=format&fit=crop&w=1200&q=80" class="img-fluid rounded-4 shadow-lg" alt="Wildlife Photography">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="font-family: 'Nunito', sans-serif; color: #3E2723;">Why Choose Our Photographic Safaris</h2>
                <p class="text-muted">Everything you need for the perfect wildlife photography experience</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">
                        <div class="bg-earth bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-camera-retro fa-2x text-earth"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #3E2723;">Modified Vehicles</h4>
                        <p class="text-muted">Equipped with beanbags, charging points, and unobstructed views for heavy lenses and optimal shooting angles.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">
                        <div class="bg-earth bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-sun fa-2x text-earth"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #3E2723;">Golden Hour Focus</h4>
                        <p class="text-muted">Extended time in the field during the best light conditions at sunrise and sunset for dramatic shots.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">
                        <div class="bg-earth bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-user-edit fa-2x text-earth"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #3E2723;">Expert Positioning</h4>
                        <p class="text-muted">Guides who understand light, composition, and animal anticipation for the perfect frame.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Photo Gallery -->
    <section class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="font-family: 'Nunito', sans-serif; color: #3E2723;">Capture These Moments</h2>
                <p class="text-muted">Stunning wildlife photography opportunities await you</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="position-relative overflow-hidden rounded-4 shadow-lg" style="height: 300px;">
                        <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=800&q=80" class="w-100 h-100 object-fit-cover" alt="Lion in Serengeti">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                            <h5 class="text-white fw-bold mb-0">Big Cats of the Serengeti</h5>
                            <small class="text-white-75">Lions, leopards, and cheetahs in action</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="position-relative overflow-hidden rounded-4 shadow-lg" style="height: 300px;">
                        <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=800&q=80" class="w-100 h-100 object-fit-cover" alt="Elephants">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                            <h5 class="text-white fw-bold mb-0">Majestic Elephants</h5>
                            <small class="text-white-75">Tarangire and Ngorongoro herds</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="position-relative overflow-hidden rounded-4 shadow-lg" style="height: 300px;">
                        <img src="https://images.unsplash.com/photo-1621414050946-6e2f5a96b4aa?auto=format&fit=crop&w=800&q=80" class="w-100 h-100 object-fit-cover" alt="Kilimanjaro">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                            <h5 class="text-white fw-bold mb-0">Kilimanjaro Landscapes</h5>
                            <small class="text-white-75">Dramatic mountain backdrops</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="position-relative overflow-hidden rounded-4 shadow-lg" style="height: 300px;">
                        <img src="https://images.unsplash.com/photo-1604599340287-2042e4dc3a84?auto=format&fit=crop&w=800&q=80" class="w-100 h-100 object-fit-cover" alt="Birds">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                            <h5 class="text-white fw-bold mb-0">Bird Photography</h5>
                            <small class="text-white-75">Lake Manyara's flamingos and more</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="position-relative overflow-hidden rounded-4 shadow-lg" style="height: 300px;">
                        <img src="https://images.unsplash.com/photo-1504173010664-32509aeebb62?auto=format&fit=crop&w=800&q=80" class="w-100 h-100 object-fit-cover" alt="Giraffes">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                            <h5 class="text-white fw-bold mb-0">Giraffe Silhouettes</h5>
                            <small class="text-white-75">Against golden sunsets</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="position-relative overflow-hidden rounded-4 shadow-lg" style="height: 300px;">
                        <img src="https://images.unsplash.com/photo-1559893126-55d04dc7a90d?auto=format&fit=crop&w=800&q=80" class="w-100 h-100 object-fit-cover" alt="Zebras">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                            <h5 class="text-white fw-bold mb-0">Great Migration</h5>
                            <small class="text-white-75">Millions on the move</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%);">
        <div class="container py-4 text-center text-white">
            <h2 class="display-4 fw-bold mb-3" style="font-family: 'Nunito', sans-serif;">Ready to Capture Africa?</h2>
            <p class="lead mb-4" style="color: rgba(255,255,255,0.9);">Book your photographic safari today and create memories that last forever</p>
            <button class="btn btn-light rounded-pill px-5 py-3 fw-bold text-earth" data-bs-toggle="modal" data-bs-target="#generalInquiryModal" onclick="preselectPhotographicSafari()">
                <i class="fas fa-camera me-2"></i>START YOUR JOURNEY
            </button>
        </div>
    </section>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        function preselectPhotographicSafari() {
            setTimeout(function() {
                const select = document.getElementById('inquiry_tour_select');
                if (select) {
                    let found = false;
                    for (let i = 0; i < select.options.length; i++) {
                        if (select.options[i].text.includes('Photographic') || select.options[i].text.includes('photographic')) {
                            select.selectedIndex = i;
                            found = true;
                            break;
                        }
                    }
                    if (!found) {
                        select.value = "General Inquiry";
                    }
                }
            }, 300);
        }
    </script>
</body>
</html>
