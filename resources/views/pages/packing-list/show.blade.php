<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $packingList->title }} - Go Deep Africa Safari</title>
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .packing-detail-hero {
            min-height: 50vh;
            background: linear-gradient(135deg, rgba(62,39,35,0.9) 0%, rgba(139,69,19,0.85) 100%);
            display: flex;
            align-items: center;
        }
        .checklist-item {
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }
        .checklist-item:hover {
            background: #f8f9fa;
            border-left-color: #8B4513;
        }
        .checklist-item.essential {
            background: linear-gradient(135deg, #fff8e1 0%, #fff3e0 100%);
            border-left-color: #FFD700;
        }
        .essential-star {
            color: #FFD700;
        }
        .print-section {
            display: none;
        }
        @media print {
            .no-print { display: none !important; }
            .print-section { display: block !important; }
        }
    </style>
</head>
<body>
    @include('partials.header')

    <!-- Hero -->
    <section class="packing-detail-hero text-white position-relative">
        @if($packingList->image)
        <div class="position-absolute top-0 start-0 w-100 h-100">
            <img src="{{ asset('storage/' . $packingList->image) }}" class="w-100 h-100 object-fit-cover" style="opacity: 0.3;" alt="">
        </div>
        @endif
        <div class="container position-relative" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('packing-list.index') }}" class="text-white-75">Packing Lists</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">{{ $packingList->title }}</li>
                        </ol>
                    </nav>
                    <span class="badge mb-3" style="background: {{ $packingList->category == 'kilimanjaro' ? '#8B4513' : ($packingList->category == 'safari' ? '#D2691E' : '#6c757d') }};">
                        {{ ucfirst($packingList->category) }}
                    </span>
                    <h1 class="display-4 fw-bold mb-3" style="font-family: 'Playfair Display', serif;">
                        <i class="fas {{ $packingList->icon }} me-3"></i>{{ $packingList->title }}
                    </h1>
                    <p class="lead opacity-75 mb-4">{{ $packingList->description }}</p>
                    <div class="d-flex flex-wrap gap-3">
                        <span class="badge bg-light text-dark px-3 py-2">
                            <i class="fas fa-list me-2"></i>{{ $packingList->items->count() }} Items
                        </span>
                        <span class="badge bg-warning text-dark px-3 py-2">
                            <i class="fas fa-star me-2"></i>{{ $packingList->items->where('is_essential', true)->count() }} Essential
                        </span>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0 no-print">
                    <button onclick="window.print()" class="btn btn-light rounded-pill px-4 fw-bold mb-2">
                        <i class="fas fa-print me-2"></i>Print List
                    </button>
                    <a href="{{ route('packing-list.index') }}" class="btn btn-outline-light rounded-pill px-4 fw-bold d-block">
                        <i class="fas fa-arrow-left me-2"></i>All Lists
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Checklist -->
    <section class="py-5">
        <div class="container py-4">
            <!-- Progress -->
            <div class="card border-0 rounded-4 shadow-sm mb-4 no-print" data-aos="fade-up">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold mb-0" style="color: #3E2723;">Packing Progress</h6>
                        <span class="text-muted small"><span id="checked-count">0</span> / {{ $packingList->items->count() }} items</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0%; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);"></div>
                    </div>
                </div>
            </div>

            <!-- Items -->
            <div class="row">
                <!-- Essential Items -->
                @if($packingList->items->where('is_essential', true)->count() > 0)
                <div class="col-12 mb-4" data-aos="fade-up">
                    <h4 class="fw-bold mb-3" style="color: #3E2723;">
                        <i class="fas fa-star text-warning me-2"></i>Essential Items
                        <span class="badge bg-warning text-dark ms-2">Must Have</span>
                    </h4>
                    <div class="card border-0 rounded-4 shadow-sm">
                        <div class="list-group list-group-flush">
                            @foreach($packingList->items->where('is_essential', true) as $item)
                            <div class="list-group-item checklist-item essential p-3 d-flex align-items-center gap-3">
                                <div class="form-check no-print">
                                    <input class="form-check-input item-check" type="checkbox" value="" style="width: 20px; height: 20px; cursor: pointer;">
                                </div>
                                <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle bg-white shadow-sm" style="width: 45px; height: 45px; flex-shrink: 0;">
                                    <i class="fas {{ $item->icon ?? 'fa-check' }} text-muted"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1" style="color: #3E2723;">
                                        {{ $item->item_name }}
                                        <i class="fas fa-star essential-star ms-1 small"></i>
                                    </h6>
                                    @if($item->description)
                                    <p class="text-muted small mb-0">{{ $item->description }}</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Recommended Items -->
                @if($packingList->items->where('is_essential', false)->where('is_recommended', true)->count() > 0)
                <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="fw-bold mb-3" style="color: #3E2723;">
                        <i class="fas fa-thumbs-up text-success me-2"></i>Recommended Items
                    </h4>
                    <div class="card border-0 rounded-4 shadow-sm">
                        <div class="list-group list-group-flush">
                            @foreach($packingList->items->where('is_essential', false)->where('is_recommended', true) as $item)
                            <div class="list-group-item checklist-item p-3 d-flex align-items-center gap-3">
                                <div class="form-check no-print">
                                    <input class="form-check-input item-check" type="checkbox" value="" style="width: 20px; height: 20px; cursor: pointer;">
                                </div>
                                <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle bg-light" style="width: 45px; height: 45px; flex-shrink: 0;">
                                    <i class="fas {{ $item->icon ?? 'fa-check' }} text-muted"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1" style="color: #3E2723;">{{ $item->item_name }}</h6>
                                    @if($item->description)
                                    <p class="text-muted small mb-0">{{ $item->description }}</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Related Lists -->
    @if($relatedLists->count() > 0)
    <section class="py-5 bg-light">
        <div class="container py-4">
            <h3 class="fw-bold mb-4 text-center" style="color: #3E2723; font-family: 'Playfair Display', serif;">
                More {{ ucfirst($packingList->category) }} Packing Lists
            </h3>
            <div class="row g-4">
                @foreach($relatedLists as $list)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('packing-list.show', $list->slug) }}" class="card border-0 rounded-4 shadow-sm text-decoration-none h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
                                    <i class="fas {{ $list->icon }} text-white"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1" style="color: #3E2723;">{{ $list->title }}</h6>
                                    <span class="text-muted small">{{ $list->items->count() }} items</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @include('partials.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        // Progress tracking
        const checkboxes = document.querySelectorAll('.item-check');
        const progressBar = document.getElementById('progress-bar');
        const checkedCount = document.getElementById('checked-count');
        const totalItems = checkboxes.length;

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateProgress);
        });

        function updateProgress() {
            const checked = document.querySelectorAll('.item-check:checked').length;
            const percentage = (checked / totalItems) * 100;
            
            progressBar.style.width = percentage + '%';
            checkedCount.textContent = checked;
        }
    </script>
</body>
</html>
