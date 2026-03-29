<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Frequently Asked Questions - Go Deep Africa Safari</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .bg-earth { background-color: #8b4513 !important; }
        .text-earth { color: #8b4513 !important; }
        .accordion-button:not(.collapsed) { background-color: #fdf5e6; color: #8b4513; }
        .accordion-button:focus { border-color: #8b4513; box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.1); }
    </style>
</head>
<body class="bg-light">
    @include('partials.header')
    <div class="container py-5 mt-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">FAQs</h1>
            <p class="text-muted">Answers to the most common questions about our safaris and treks.</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <!-- Kilimanjaro -->
                    <div class="mb-4">
                        <h3 class="fw-bold mb-3 text-earth"><i class="fas fa-mountain me-2"></i> Kilimanjaro Treks</h3>
                        <div class="accordion-item border-0 shadow-sm rounded-4 mb-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#kili1">
                                    When is the best time to climb Kilimanjaro?
                                </button>
                            </h2>
                            <div id="kili1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    The best times are from late December to early March and mid-June to late October when the weather is clearest.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Safari -->
                    <div class="mb-4">
                        <h3 class="fw-bold mb-3 text-earth"><i class="fas fa-paw me-2"></i> Safari Tours</h3>
                        <div class="accordion-item border-0 shadow-sm rounded-4 mb-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#safari1">
                                    Which parks should I visit for a 5-day safari?
                                </button>
                            </h2>
                            <div id="safari1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    For a 5-day trip, we highly recommend Tarangire, Ngorongoro Crater, and the Serengeti.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
</body>
</html>
