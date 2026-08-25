@include('partials.seo')

<!-- Common CSS & Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
<link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<style>
    :root {
        --primary-earth: #8B4513;
        --secondary-earth: #A0522D;
        --accent-green: #556B2F;
        --light-earth: #DEB887;
        --dark-earth: #3E2723;
        --beige-bg: #F5F5DC;
    }

    body {
        font-family: 'Nunito', sans-serif;
        background-color: var(--beige-bg);
        color: var(--dark-earth);
        margin: 0;
        overflow-x: hidden;
    }

    /* Global Mobile Optimizations */
    @media (max-width: 768px) {
        .main-header {
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .top-header {
            display: none !important;
        }
        .bottom-header {
            margin: 10px !important;
            background-color: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px);
        }
    }

    /* Flatpickr Custom Styling */
    .flatpickr-calendar {
        border-radius: 15px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        border: none !important;
        background: #fff !important;
    }
    .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange {
        background: var(--primary-earth) !important;
        border-color: var(--primary-earth) !important;
    }
    .flatpickr-months .flatpickr-month, .flatpickr-current-month .flatpickr-monthDropdown-months, .flatpickr-current-month input.cur-year {
        color: var(--dark-earth) !important;
        fill: var(--dark-earth) !important;
    }
    .flatpickr-weekday {
        background: transparent !important;
        color: var(--dark-earth) !important;
        font-weight: bold !important;
    }

    /* Common Components Styling */
    .btn-earth { 
        background-color: var(--primary-earth) !important; 
        border-color: var(--primary-earth) !important; 
        color: white !important; 
    }
    .btn-earth:hover { 
        background-color: var(--secondary-earth) !important; 
        border-color: var(--secondary-earth) !important; 
    }

    .section-title {
        text-align: center;
        margin: 60px 0 40px;
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--dark-earth);
        position: relative;
    }

    .section-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: var(--primary-earth);
        margin: 10px auto;
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 1.8rem !important;
            margin: 40px 0 25px !important;
        }
    }
</style>
