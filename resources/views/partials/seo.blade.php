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

    /*
     | Google shows roughly the first 60 characters of a title. Titles written
     | across the site ran to 113, so the useful part was being cut off and the
     | brand — the least important half for a non-brand search — was what got
     | lost. Trim in the order a person would: drop the brand suffix first, then
     | a trailing descriptive clause, and only then cut on a word boundary.
     | A title already within budget is never touched.
     */
    $seoTitle = trim(preg_replace('/\s+/', ' ', $seoTitle));
    if (mb_strlen($seoTitle) > 60) {
        foreach ([' | ', ' — ', ' – ', ' - '] as $sep) {
            if (mb_strpos($seoTitle, $sep) !== false) {
                $head = trim(mb_substr($seoTitle, 0, mb_strpos($seoTitle, $sep)));
                // Only accept the shorter form if it still says something useful.
                if (mb_strlen($head) >= 25 && mb_strlen($head) <= 60) {
                    $seoTitle = $head;
                    break;
                }
            }
        }
    }
    if (mb_strlen($seoTitle) > 60) {
        $cut = mb_substr($seoTitle, 0, 60);
        $sp  = mb_strrpos($cut, ' ');
        $seoTitle = rtrim($sp > 30 ? mb_substr($cut, 0, $sp) : $cut, " ,-–—|:");
    }

    /*
     | Descriptions: Google truncates near 160. Trim long ones on a sentence or
     | word boundary rather than mid-word.
     */
    $seoDescription = trim(preg_replace('/\s+/', ' ', $seoDescription));
    if (mb_strlen($seoDescription) > 160) {
        $cut = mb_substr($seoDescription, 0, 160);
        $dot = mb_strrpos($cut, '. ');
        if ($dot !== false && $dot > 90) {
            $seoDescription = mb_substr($cut, 0, $dot + 1);
        } else {
            $sp = mb_strrpos($cut, ' ');
            $seoDescription = rtrim($sp > 90 ? mb_substr($cut, 0, $sp) : $cut, " ,;:-") . '…';
        }
    }
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
