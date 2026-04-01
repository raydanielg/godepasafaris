<!-- Primary Meta Tags -->
<title>@yield('title', 'Go Deep Africa Safari - Authentic Tanzania Safari & Kilimanjaro Trekking')</title>
<meta name="title" content="@yield('meta_title', 'Go Deep Africa Safari - Authentic Tanzania Safari & Kilimanjaro Trekking')">
<meta name="description" content="@yield('meta_description', 'Experience authentic Tanzania safaris, Serengeti balloon tours, and Kilimanjaro trekking with Go Deep Africa Safari. Locally owned experts in Arusha.')">
<meta name="keywords" content="Tanzania Safari, Kilimanjaro Trekking, Serengeti Balloon Safari, Arusha Safari, Giving Back Tanzania, Luxury Safari Tanzania, Budget Safari Tanzania">
<meta name="author" content="Go Deep Africa Safari">
<meta name="robots" content="index, follow">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="@yield('meta_title', 'Go Deep Africa Safari - Authentic Tanzania Safari & Kilimanjaro Trekking')">
<meta property="og:description" content="@yield('meta_description', 'Experience authentic Tanzania safaris, Serengeti balloon tours, and Kilimanjaro trekking with Go Deep Africa Safari. Every safari supports local orphans and women.')">
<meta property="og:image" content="@yield('meta_image', asset('images/logo/logo.png'))">
<meta property="og:site_name" content="Go Deep Africa Safari">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="@yield('meta_title', 'Go Deep Africa Safari - Authentic Tanzania Safari & Kilimanjaro Trekking')">
<meta property="twitter:description" content="@yield('meta_description', 'Experience authentic Tanzania safaris with a purpose. Supporting local communities through every booking.')">
<meta property="twitter:image" content="@yield('meta_image', asset('images/logo/logo.png'))">

<!-- Structured Data (JSON-LD) -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "TravelAgency",
  "name": "Go Deep Africa Safari",
  "image": "{{ asset('images/logo/logo.png') }}",
  "@@id": "{{ url('/') }}",
  "url": "{{ url('/') }}",
  "telephone": "+966542586758",
  "address": {
    "@@type": "PostalAddress",
    "streetAddress": "Arusha",
    "addressLocality": "Arusha",
    "addressCountry": "TZ"
  },
  "geo": {
    "@@type": "GeoCoordinates",
    "latitude": -3.3731,
    "longitude": 36.6858
  },
  "sameAs": [
    "https://www.facebook.com/share/1DkJwJSKre/",
    "https://www.instagram.com/godeepafricasafariexpendition",
    "https://www.tiktok.com/@godeepafricasafar"
  ],
  "areaServed": "Tanzania",
  "priceRange": "$$"
}
</script>

<!-- Canonical Link -->
<link rel="canonical" href="{{ url()->current() }}">

<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
