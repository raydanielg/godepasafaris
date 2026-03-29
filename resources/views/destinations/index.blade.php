<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Safari Destinations - Go Deep Africa Safari</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header')

    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/images/Serengeti-National-Park-1.jpg') }}');">
        <div class="container text-center">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">All Safari Destinations</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Discover the breathtaking beauty of Tanzania's diverse landscapes</p>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <!-- Filters -->
            <div class="destination-filters mb-5 d-flex flex-wrap justify-content-center gap-2 animate__animated animate__fadeInUp">
                @foreach($categories as $cat)
                <a href="{{ route('destinations', ['category' => $cat]) }}" 
                   class="btn filter-btn {{ (request('category', 'All') == $cat) ? 'active' : '' }}">
                    {{ $cat }}
                </a>
                @endforeach
            </div>

            <!-- Destinations Grid -->
            <div class="row g-4">
                @foreach($destinations as $dest)
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp">
                    <div class="destination-card h-100 rounded-4 overflow-hidden border-0 shadow-sm bg-white">
                        <a href="{{ route('destinations.show', $dest->slug) }}" class="text-decoration-none">
                            <div class="dest-img-wrapper" style="height: 250px; position: relative; overflow: hidden;">
                                <img src="{{ asset($dest->image) }}" class="w-100 h-100 object-fit-cover transition-all" alt="{{ $dest->title }}">
                                <div class="dest-category-badge small">{{ $dest->category }}</div>
                            </div>
                        </a>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <a href="{{ route('destinations.show', $dest->slug) }}" class="text-decoration-none">
                                    <h4 class="fw-bold mb-0 text-dark hover-primary" style="font-family: 'Playfair Display', serif;">{{ $dest->title }}</h4>
                                </a>
                                <span class="badge border border-dark text-dark rounded-pill px-3 py-1 small">Tanzania</span>
                            </div>
                            <p class="text-muted small mb-4">{{ Str::limit($dest->description, 150) }}</p>
                            
                            <div class="dest-info-list mb-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-money-bill-wave text-primary small"></i>
                                    <span class="small text-dark"><strong>Rate:</strong> {{ $dest->rate_range }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="far fa-calendar-alt text-primary small"></i>
                                    <span class="small text-dark"><strong>Best time:</strong> {{ $dest->best_time }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-sun text-primary small"></i>
                                    <span class="small text-dark"><strong>High season:</strong> {{ $dest->high_season }}</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('destinations.show', $dest->slug) }}" class="text-primary fw-bold text-decoration-none small hover-arrow">
                                {{ $dest->title }} tours <i class="fas fa-arrow-right ms-1 transition-all"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.footer')
    @include('partials.whatsapp')
</body>
</html>
