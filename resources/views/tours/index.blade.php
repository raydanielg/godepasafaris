<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Safari Tours - Go Deep Africa Safari</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    @include('partials.header')

    <section class="page-header animate__animated animate__fadeIn" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/images/Serengeti-National-Park-1.jpg') }}');">
        <div class="container text-center">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">All Safari Tours</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Tanzania safari, trips, tour packages & vacation</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="intro-text mb-5 p-4 bg-white rounded-4 shadow-sm animate__animated animate__fadeInUp">
            <p class="mb-0 text-muted">Looking for the best Tanzania safari packages? Whether you dream of a classic African safari tour in Tanzania, a luxury private safari in the Serengeti, or a budget-friendly safari trip to Ngorongoro, we've got you covered. Our handpicked safari tours in Tanzania include thrilling wildlife encounters, breathtaking landscapes, and expert local guides who bring every moment to life. From Tanzania safari private tours to group adventures, from short tour safaris in Tanzania to multi-day Tanzania safaris across the country, you’ll find the perfect journey here. If you don’t see the Tanzania safari package you’re looking for, simply request a free custom safari quote — we’ll design a tailor‑made safari Africa Tanzania experience just for you</p>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeIn">
            <h5 class="fw-bold mb-0">Showing 1 - {{ $tours->count() }} of 76</h5>
            <div class="text-muted small">Tanzania safari, trips, tour packages & vacation</div>
        </div>

        <div class="row g-5">
            <!-- Sidebar Filters -->
            <div class="col-lg-3 animate__animated animate__fadeInLeft">
                <div class="sticky-top" style="top: 100px;">
                    <div class="filter-sidebar bg-white p-4 rounded-4 shadow-sm">
                        <div class="filter-group mb-4">
                            <h6 class="filter-group-title">Where you want to go ?</h6>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control border-0 bg-light" placeholder="Where to?">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0"><i class="fas fa-calendar-alt"></i></span>
                                <input type="text" class="form-control border-0 bg-light" placeholder="When?">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0"><i class="fas fa-users"></i></span>
                                <input type="text" class="form-control border-0 bg-light" placeholder="Travelers">
                            </div>
                        </div>

                        <div class="filter-group mb-4">
                            <h6 class="filter-group-title">Price</h6>
                            <input type="range" class="form-range custom-range" min="10" max="10000" id="priceRange">
                            <div class="d-flex justify-content-between small text-muted mt-2">
                                <span>$10</span>
                                <span>$10000+</span>
                            </div>
                        </div>

                        <div class="filter-group mb-4">
                            <h6 class="filter-group-title">Tour Length</h6>
                            <input type="range" class="form-range custom-range" min="1" max="21" id="lengthRange">
                            <div class="d-flex justify-content-between small text-muted mt-2">
                                <span>1-Day</span>
                                <span>21+Day</span>
                            </div>
                        </div>

                        <div class="filter-group mb-4">
                            <h6 class="filter-group-title">Trip Type</h6>
                            <div class="filter-check-list">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="private">
                                    <label class="form-check-label" for="private">Private</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="shared">
                                    <label class="form-check-label" for="shared">Shared</label>
                                </div>
                            </div>
                        </div>

                        <div class="filter-group mb-4">
                            <h6 class="filter-group-title">Safari Type</h6>
                            <div class="filter-check-list">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="lodge">
                                    <label class="form-check-label" for="lodge">Lodge</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="camping">
                                    <label class="form-check-label" for="camping">Camping</label>
                                </div>
                            </div>
                        </div>

                        <div class="filter-group mb-4">
                            <h6 class="filter-group-title">Starting From</h6>
                            <div class="filter-check-list">
                                @foreach($filters['starting_from'] as $start)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="start{{ $loop->index }}">
                                    <label class="form-check-label d-flex justify-content-between w-100" for="start{{ $loop->index }}">
                                        {{ $start }} <span class="text-muted">(0)</span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="filter-group mb-4">
                            <h6 class="filter-group-title">Standard Level</h6>
                            <div class="filter-check-list">
                                @foreach($filters['standard_level'] as $level)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="level{{ $loop->index }}">
                                    <label class="form-check-label" for="level{{ $loop->index }}">{{ $level }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="filter-group">
                            <h6 class="filter-group-title">Specialized Tours</h6>
                            <div class="filter-check-list">
                                @foreach($filters['specialized_tours'] as $tour_type)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="specialized{{ $loop->index }}">
                                    <label class="form-check-label" for="specialized{{ $loop->index }}">{{ $tour_type }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tours Grid -->
            <div class="col-lg-9" id="tourListContainer">
                @include('tours.partials.tour_list')

                <!-- Pagination -->
                <nav class="mt-5" id="paginationContainer">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><span class="page-link border-0 shadow-sm rounded-circle mx-1">Prev</span></li>
                        <li class="page-item active"><a class="page-link border-0 shadow-sm rounded-circle mx-1" href="#">1</a></li>
                        <li class="page-item"><a class="page-link border-0 shadow-sm rounded-circle mx-1" href="#">2</a></li>
                        <li class="page-item"><a class="page-link border-0 shadow-sm rounded-circle mx-1" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.whatsapp')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tourContainer = document.getElementById('tourListContainer');
        const filters = document.querySelectorAll('.filter-check-list input, #priceRange, #lengthRange');
        
        const fetchTours = () => {
            const formData = new FormData();
            filters.forEach(filter => {
                if (filter.type === 'checkbox' && filter.checked) {
                    formData.append(filter.id, '1');
                } else if (filter.type === 'range') {
                    formData.append(filter.id, filter.value);
                }
            });

            const params = new URLSearchParams(formData).toString();
            
            tourContainer.style.opacity = '0.5';
            
            fetch(`{{ route('tours.all') }}?${params}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                tourContainer.innerHTML = html;
                tourContainer.style.opacity = '1';
                // Re-initialize animations if needed
            })
            .catch(error => {
                console.error('Error fetching tours:', error);
                tourContainer.style.opacity = '1';
            });
        };

        filters.forEach(filter => {
            filter.addEventListener('change', fetchTours);
        });
    });
    </script>
</body>
</html>
