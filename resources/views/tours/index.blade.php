<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo')
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
            <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">Safaris</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Tanzania safari, trips, tour packages & vacation</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="intro-text mb-5 p-4 bg-white rounded-4 shadow-sm animate__animated animate__fadeInUp">
            <p class="mb-0 text-muted">Looking for the best Tanzania safari packages? Whether you dream of a classic African safari tour in Tanzania, a luxury private safari in the Serengeti, or a budget-friendly safari trip to Ngorongoro, we've got you covered. Our handpicked safari tours in Tanzania include thrilling wildlife encounters, breathtaking landscapes, and expert local guides who bring every moment to life. From Tanzania safari private tours to group adventures, from short tour safaris in Tanzania to multi-day Tanzania safaris across the country, you’ll find the perfect journey here. If you don’t see the Tanzania safari package you’re looking for, simply request a free custom safari quote — we’ll design a tailor‑made safari Africa Tanzania experience just for you</p>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeIn">
            <h5 class="fw-bold mb-0">Showing 1 - {{ $tours->count() }} of 76</h5>
            <button class="btn btn-earth d-lg-none rounded-pill px-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterSidebar" aria-controls="filterSidebar">
                <i class="fas fa-filter me-2"></i> Filters
            </button>
            <div class="text-muted small d-none d-lg-block">Tanzania safari, trips, tour packages & vacation</div>
        </div>

        <div class="row g-5">
            <!-- Sidebar Filters (Desktop) -->
            <div class="col-lg-3 d-none d-lg-block animate__animated animate__fadeInLeft">
                <div class="sticky-top" style="top: 100px;">
                    <div class="filter-sidebar bg-white p-4 rounded-4 shadow-sm">
                        @include('tours.partials.filters_content')
                    </div>
                </div>
            </div>

            <!-- Mobile Filter Offcanvas -->
            <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="filterSidebar" aria-labelledby="filterSidebarLabel">
                <div class="offcanvas-header bg-light">
                    <h5 class="offcanvas-title fw-bold" id="filterSidebarLabel">Search Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    @include('tours.partials.filters_content')
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
    @include('partials.ai_chatbot')
    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("input[type=date]", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                minDate: "today",
                animate: true
            });
        });
    </script>

    @include('partials.general_inquiry_modal')
    @include('partials.booking_modal')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const typeFilter = urlParams.get('type');
        
        if (typeFilter) {
            // Uncheck all trip types first if needed, or just handle specific ones
            const privateCheck = document.getElementById('private');
            const sharedCheck = document.getElementById('shared');
            
            // For Safari Type (Lodge/Camping)
            const lodgeCheck = document.getElementById('lodge');
            const campingCheck = document.getElementById('camping');

            if (typeFilter === 'kilimanjaro') {
                // Assuming you might add a 'Kilimanjaro' checkbox in the future
                // or want to filter specifically by specialized tours
                // For now, let's trigger the fetch with the param
                fetchTours();
            } else if (typeFilter === 'safari') {
                if (lodgeCheck) lodgeCheck.checked = true;
                fetchTours();
            }
        }

        const bookingModal = document.getElementById('bookingModal');
        if (bookingModal) {
            bookingModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const tourTitle = button.getAttribute('data-tour-title');
                const tourId = button.getAttribute('data-tour-id');
                
                const modalTitle = bookingModal.querySelector('.modal-title');
                const tourIdInput = bookingModal.querySelector('#modal_tour_id');
                const tourNameInput = bookingModal.querySelector('#modal_tour_name');
                
                modalTitle.textContent = 'Book Your Safari: ' + tourTitle;
                if (tourIdInput) tourIdInput.value = tourId;
                if (tourNameInput) tourNameInput.value = tourTitle;
            });
        }
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
