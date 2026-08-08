@php
    /*
     | Per-page SEO. Pass any of these to @include('partials.seo', [...]);
     | anything omitted falls back to the site-wide default, so pages that
     | include this partial without arguments behave exactly as before.
     */
    $defaultTitle = 'Go Deep Africa Safari | Authentic Tanzania Safari & Kilimanjaro Trekking';
    $defaultDesc  = 'Experience authentic Tanzania safaris, Serengeti balloon tours, and Kilimanjaro trekking with Go Deep Africa Safari. Locally owned experts in Arusha supporting local communities.';

    $seoTitle       = $seoTitle       ?? $defaultTitle;
    $seoDescription = trim((string) ($seoDescription ?? $defaultDesc));
    $seoImage       = $seoImage       ?? asset('images/logo/logo.png');
    $seoKeywords    = $seoKeywords    ?? 'Tanzania Safari, Kilimanjaro Trekking, Serengeti Balloon Safari, Arusha Safari, Giving Back Tanzania, Luxury Safari Tanzania, Budget Safari Tanzania';
    $seoType        = $seoType        ?? 'website';
    $seoRobots      = $seoRobots      ?? 'index, follow';
    // Optional extra JSON-LD (raw json string) for the current page.
    $seoSchema      = $seoSchema      ?? null;

    // Canonical URL: force the production scheme + host (from APP_URL) so that
    // http/https and www/non-www variants all point at ONE canonical and don't
    // split ranking signals. Falls back to the request URL on local/dev hosts.
    // Query strings are excluded (getPathInfo), so ?lang=xx variants correctly
    // canonicalise to the base page.
    $appUrl = rtrim((string) config('app.url'), '/');
    if ($appUrl === '' || str_contains($appUrl, 'localhost') || str_contains($appUrl, '127.0.0.1')) {
        $canonicalUrl = url()->current();
    } else {
        $path = request()->getPathInfo();
        $canonicalUrl = $appUrl . ($path === '/' ? '' : $path);
    }
@endphp

<!-- CSRF token (used by AJAX forms) -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Primary Meta Tags -->
<title>{{ $seoTitle }}</title>
<meta name="title" content="{{ $seoTitle }}">
<meta name="description" content="{{ $seoDescription }}">
<meta name="keywords" content="{{ $seoKeywords }}">
<meta name="author" content="Go Deep Africa Safari">
<meta name="robots" content="{{ $seoRobots }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $seoType }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:image" content="{{ $seoImage }}">
<meta property="og:site_name" content="Go Deep Africa Safari">
<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $canonicalUrl }}">
<meta property="twitter:title" content="{{ $seoTitle }}">
<meta property="twitter:description" content="{{ $seoDescription }}">
<meta property="twitter:image" content="{{ $seoImage }}">

<!-- Structured Data (JSON-LD) -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "TravelAgency",
  "name": "Go Deep Africa Safari",
  "image": "{{ asset('images/logo/logo.png') }}",
  "@@id": "{{ url('/') }}",
  "url": "{{ url('/') }}",
  "telephone": "+255794636471",
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

@if($seoSchema)
<!-- Page-specific Structured Data -->
<script type="application/ld+json">
{!! $seoSchema !!}
</script>
@endif

<!-- Canonical Link -->
<link rel="canonical" href="{{ $canonicalUrl }}">

<!-- Hreflang alternates (multilingual) -->
@foreach(config('locales.supported', []) as $localeCode => $localeMeta)
<link rel="alternate" hreflang="{{ $localeMeta['hreflang'] }}" href="{{ request()->fullUrlWithQuery(['lang' => $localeCode]) }}">
@endforeach
<link rel="alternate" hreflang="x-default" href="{{ request()->fullUrlWithQuery(['lang' => config('locales.default', 'en')]) }}">

<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
