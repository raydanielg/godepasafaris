<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo', [
        'seoTitle' => $categoryTitle . ' Packing List for Tanzania Safari & Kilimanjaro',
        'seoDescription' => 'Essential ' . strtolower($categoryTitle) . ' packing guides for your Tanzania safari or Kilimanjaro trek, with practical checklists put together by our local guides.',
        'seoKeywords' => $categoryTitle . ' packing list, safari packing list, Tanzania safari gear, Kilimanjaro gear',
    ])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header')

    <section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%); min-height: 40vh; display: flex; align-items: center;">
        <div class="container text-center text-white" data-aos="fade-up">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('packing-list.index') }}" class="text-white-75">Packing Lists</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $categoryTitle }}</li>
                </ol>
            </nav>
            <h1 class="display-4 fw-bold mb-3" style="font-family: 'Nunito', sans-serif;">
                {{ $categoryTitle }} Packing
            </h1>
            <p class="lead opacity-75">Essential packing guides for your {{ strtolower($categoryTitle) }} adventure</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-4">
            <div class="row g-4">
                @forelse($packingLists as $list)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card h-100 border-0 rounded-4 shadow-sm">
                        @if($list->image)
                        <img src="{{ asset('storage/' . $list->image) }}" class="w-100" style="height: 200px; object-fit: cover;" alt="">
                        @endif
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-2" style="color: #3E2723;">
                                <i class="fas {{ $list->icon }} me-2" style="color: #8B4513;"></i>{{ $list->title }}
                            </h5>
                            <p class="text-muted small mb-3">{{ Str::limit($list->description, 80) }}</p>
                            <div class="d-flex gap-2 mb-3">
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-list me-1"></i>{{ $list->items->count() }}
                                </span>
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-star me-1"></i>{{ $list->items->where('is_essential', true)->count() }}
                                </span>
                            </div>
                            <a href="{{ route('packing-list.show', $list->slug) }}" class="btn w-100 rounded-pill text-white" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                View List <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-suitcase fa-3x text-light mb-3"></i>
                    <h5 class="text-muted">No packing lists in this category yet</h5>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('partials.footer')
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>
