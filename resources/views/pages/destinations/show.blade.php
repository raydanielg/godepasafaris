<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $destDesc = $destination->short_description ?: ($destination->tagline ?: $destination->description);
        $seoTitle = tr($destination->name) . ' — Safari Guide, Wildlife & Best Time to Visit | Go Deep Africa';
        $seoDescription = \Illuminate\Support\Str::limit(strip_tags(tr($destDesc)), 155);
        $seoImage = $destination->hero_display_image;
        $seoSchema = json_encode([
            [
                '@context' => 'https://schema.org',
                '@type' => 'TouristAttraction',
                'name' => tr($destination->name),
                'description' => strip_tags(tr($destination->description ?: $destDesc)),
                'image' => $destination->hero_display_image,
                'url' => url()->current(),
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressRegion' => strip_tags(tr($destination->location ?? 'Tanzania')),
                    'addressCountry' => 'TZ',
                ],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Destinations', 'item' => route('destinations')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => tr($destination->name), 'item' => url()->current()],
                ],
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
</head>
<body>
    @include('partials.header')

    <!-- Hero -->
    <section class="position-relative" style="min-height: 70vh;">
        <section class="destination-hero d-flex align-items-center text-white" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ $destination->hero_display_image }}');">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(62,39,35,0.8) 100%);"></div>
        </section>
        
        <div class="container position-relative text-white d-flex flex-column justify-content-end" style="min-height: 70vh; padding-bottom: 4rem;">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('destinations') }}" class="text-white-75">Destinations</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ tr($destination->name) }}</li>
                </ol>
            </nav>
            
            <span class="badge bg-warning text-dark px-3 py-2 mb-3 align-self-start">
                <i class="fas fa-map-marker-alt me-2"></i>{{ tr($destination->location) }}
            </span>

            <h1 class="display-3 fw-bold mb-3" style="font-family: 'Nunito', sans-serif;">
                {{ tr($destination->name) }}
            </h1>
            <p class="lead mb-4" style="max-width: 700px;">{{ tr($destination->tagline) }}</p>
            
            <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('contact') }}" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;">
                    <i class="fas fa-calendar-check me-2"></i>Plan Your Visit
                </a>
                <a href="{{ route('tours.all') }}" class="btn btn-lg btn-outline-light rounded-pill px-5 fw-bold">
                    <i class="fas fa-search me-2"></i>View Related Tours
                </a>
            </div>
        </div>
    </section>

    <!-- Info Cards -->
    <section class="py-4" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%); margin-top: -1px;">
        <div class="container">
            <div class="row g-4 text-center text-white">
                <div class="col-6 col-md-3">
                    <i class="fas fa-ruler-combined fa-2x mb-2" style="color: #DEB887;"></i>
                    <h5 class="fw-bold mb-1">{{ tr($destination->area) }}</h5>
                    <small class="opacity-75">Area</small>
                </div>
                <div class="col-6 col-md-3">
                    <i class="fas fa-calendar fa-2x mb-2" style="color: #DEB887;"></i>
                    <h5 class="fw-bold mb-1">{{ tr($destination->established) }}</h5>
                    <small class="opacity-75">Established</small>
                </div>
                <div class="col-6 col-md-3">
                    <i class="fas fa-paw fa-2x mb-2" style="color: #DEB887;"></i>
                    <h5 class="fw-bold mb-1">{{ tr($destination->wildlife_count) }}</h5>
                    <small class="opacity-75">Wildlife</small>
                </div>
                <div class="col-6 col-md-3">
                    <i class="fas fa-sun fa-2x mb-2" style="color: #DEB887;"></i>
                    <h5 class="fw-bold mb-1">{{ $destination->activities->count() }}+</h5>
                    <small class="opacity-75">Activities</small>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="py-5">
        <div class="container py-4">
            <div class="row g-5">
                <div class="col-lg-8">
                    <h2 class="display-5 fw-bold mb-4" style="color: #3E2723; font-family: 'Nunito', sans-serif;">
                        {{ __('messages.dest.about') }} {{ tr($destination->name) }}
                    </h2>
                    <p class="lead text-muted mb-4">{{ tr($destination->description) }}</p>
                    
                    @if($destination->highlight_1 || $destination->highlight_2 || $destination->highlight_3)
                    <h4 class="fw-bold mb-3" style="color: #3E2723;">Highlights</h4>
                    <div class="row g-3 mb-4">
                        @if($destination->highlight_1)
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: #f8f9fa;">
                                <i class="fas fa-star" style="color: #8B4513;"></i>
                                <span class="fw-bold">{{ tr($destination->highlight_1) }}</span>
                            </div>
                        </div>
                        @endif
                        @if($destination->highlight_2)
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: #f8f9fa;">
                                <i class="fas fa-star" style="color: #8B4513;"></i>
                                <span class="fw-bold">{{ tr($destination->highlight_2) }}</span>
                            </div>
                        </div>
                        @endif
                        @if($destination->highlight_3)
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: #f8f9fa;">
                                <i class="fas fa-star" style="color: #8B4513;"></i>
                                <span class="fw-bold">{{ tr($destination->highlight_3) }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Activities -->
                    @if($destination->activities->count() > 0)
                    <h4 class="fw-bold mb-3" style="color: #3E2723;">Available Activities</h4>
                    <div class="row g-3">
                        @foreach($destination->activities as $activity)
                        <div class="col-md-6">
                            <div class="card border-0 rounded-4 p-3 h-100" style="background: #f8f9fa;">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="icon-circle flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                        <i class="fas {{ $activity->icon }} text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1" style="color: #3E2723;">{{ tr($activity->name) }}</h6>
                                        @if($activity->description)
                                        <small class="text-muted">{{ tr($activity->description) }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Tour Packages -->
                    @if(isset($relatedPackages) && $relatedPackages->count() > 0)
                    <h4 class="fw-bold mb-3 mt-5" style="color: #3E2723;">Safari Packages Featuring {{ tr($destination->name) }}</h4>
                    <div class="row g-4">
                        @foreach($relatedPackages as $pkg)
                        <div class="col-md-6">
                            <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">
                                <div style="height:180px; overflow:hidden;">
                                    <img src="{{ asset($pkg->image) }}" class="w-100 h-100" style="object-fit:cover;" alt="{{ tr($pkg->title) }}" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='{{ asset('images/logo/logo.png') }}';this.style.objectFit='contain';this.style.background='#fdfaf5';">
                                </div>
                                <div class="card-body p-4 d-flex flex-column">
                                    <h6 class="fw-bold mb-2" style="color:#3E2723;">{{ tr($pkg->title) }}</h6>
                                    <p class="text-muted small mb-3">{{ \Illuminate\Support\Str::limit(tr($pkg->summary), 90) }}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <span class="fw-bold" style="color:#8B4513;">${{ number_format($pkg->price, 0) }} @if($pkg->has_duration)<small class="text-muted fw-normal">/ {{ $pkg->duration_label }}</small>@endif</span>
                                        <a href="{{ route('safari.show', $pkg->slug) }}" class="btn btn-sm rounded-pill px-3 text-white fw-bold" style="background:#8B4513;">{{ __('messages.common.view_details') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Gallery -->
                    @php
                        $gallery = is_array($destination->gallery ?? null) ? array_filter($destination->gallery) : [];
                    @endphp
                    @if(count($gallery) > 0)
                    <h4 class="fw-bold mb-3 mt-5" style="color: #3E2723;">Gallery</h4>
                    <div class="row g-3">
                        @foreach($gallery as $img)
                        @php $src = \Illuminate\Support\Str::startsWith($img, ['http://', 'https://']) ? $img : (\Illuminate\Support\Str::startsWith($img, 'storage/') ? asset($img) : asset('storage/'.ltrim($img, '/'))); @endphp
                        <div class="col-6 col-md-4">
                            <a href="{{ $src }}" target="_blank" rel="noopener">
                                <img src="{{ $src }}" class="w-100 rounded-3 shadow-sm" style="height:150px; object-fit:cover;" alt="{{ tr($destination->name) }} photo" loading="lazy" decoding="async">
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 rounded-4 shadow-lg p-4" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%); position: sticky; top: 100px;">
                        <h5 class="fw-bold text-white mb-4">
                            <i class="fas fa-info-circle me-2" style="color: #DEB887;"></i>Quick Info
                        </h5>
                        
                        <div class="mb-3">
                            <small class="text-white-50 d-block">{{ __('messages.dest.best_time') }}</small>
                            <span class="text-white fw-bold">{{ tr($destination->best_time) }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-white-50 d-block">{{ __('messages.dest.location') }}</small>
                            <span class="text-white fw-bold">{{ tr($destination->location) }}</span>
                        </div>
                        
                        <div class="mb-4">
                            <small class="text-white-50 d-block">{{ __('messages.dest.established') }}</small>
                            <span class="text-white fw-bold">{{ tr($destination->established) }}</span>
                        </div>

                        <a href="javascript:void(0)" class="btn w-100 rounded-pill py-3 fw-bold" style="background: linear-gradient(135deg, #DEB887 0%, #D2691E 100%); color: #3E2723;" data-bs-toggle="modal" data-bs-target="#generalInquiryModal">
                            <i class="fas fa-envelope me-2"></i>Enquire Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
    @include('partials.general_inquiry_modal')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
        
        // Auto-set the destination name in the inquiry modal
        document.querySelector('[data-bs-target="#generalInquiryModal"]').addEventListener('click', function() {
            const select = document.getElementById('inquiry_tour_select');
            if (select) {
                const destinationName = "{{ $destination->name }}";
                // Check if the option exists, if not add it or set to general
                let found = false;
                for (let i = 0; i < select.options.length; i++) {
                    if (select.options[i].text.includes(destinationName)) {
                        select.selectedIndex = i;
                        found = true;
                        break;
                    }
                }
                if (!found) {
                    select.value = "General Inquiry";
                }
            }
        });
    </script>
</body>
</html>
