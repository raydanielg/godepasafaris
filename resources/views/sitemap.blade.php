{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <priority>1.0</priority>
        <changefreq>daily</changefreq>
    </url>
    <url>
        <loc>{{ route('tours.all') }}</loc>
        <priority>0.9</priority>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ route('kilimanjaro') }}</loc>
        <priority>0.9</priority>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ route('blog') }}</loc>
        <priority>0.8</priority>
        <changefreq>daily</changefreq>
    </url>
    <url>
        <loc>{{ route('contact') }}</loc>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('about') }}</loc>
        <priority>0.7</priority>
    </url>

    @foreach($safaris as $safari)
    <url>
        <loc>{{ route('safari.show', $safari->slug) }}</loc>
        <lastmod>{{ $safari->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach($kilis as $kili)
    <url>
        <loc>{{ route('kilimanjaro.show', $kili->slug) }}</loc>
        <lastmod>{{ $kili->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach($posts as $post)
    <url>
        <loc>{{ route('blog.show', $post->slug) }}</loc>
        <lastmod>{{ $post->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <priority>0.7</priority>
    </url>
    @endforeach

    @foreach($routes as $route)
    <url>
        <loc>{{ route('kilimanjaro.route.show', $route) }}</loc>
        <priority>0.7</priority>
    </url>
    @endforeach
</urlset>
