<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
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
        <loc>{{ route('safari') }}</loc>
        <priority>0.9</priority>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ route('kilimanjaro') }}</loc>
        <priority>0.9</priority>
        <changefreq>weekly</changefreq>
    </url>
    {{-- Kilimanjaro sub-pages: high-intent commercial and research queries
         (route comparison, pricing, packing, group dates). Each has its own
         unique title/description, so they are worth indexing separately. --}}
    <url>
        <loc>{{ route('kilimanjaro.routes') }}</loc>
        <priority>0.9</priority>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>{{ route('kilimanjaro.private-tours') }}</loc>
        <priority>0.9</priority>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>{{ route('kilimanjaro.group-departures') }}</loc>
        <priority>0.8</priority>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ route('kilimanjaro.packing-list') }}</loc>
        <priority>0.8</priority>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>{{ route('kilimanjaro.why-us') }}</loc>
        <priority>0.7</priority>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>{{ route('kilimanjaro.success-calculator') }}</loc>
        <priority>0.7</priority>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>{{ route('kilimanjaro.other-mountains') }}</loc>
        <priority>0.7</priority>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>{{ route('kilimanjaro.articles') }}</loc>
        <priority>0.6</priority>
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
    <url>
        <loc>{{ route('destinations') }}</loc>
        <priority>0.9</priority>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ route('zanzibar') }}</loc>
        <priority>0.8</priority>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ route('cultural.index') }}</loc>
        <priority>0.8</priority>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ route('circuits.index') }}</loc>
        <priority>0.8</priority>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ route('impact') }}</loc>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('packing-list.index') }}</loc>
        <priority>0.6</priority>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>{{ route('testimonials') }}</loc>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ route('faq') }}</loc>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>{{ route('how.works') }}</loc>
        <priority>0.5</priority>
    </url>

    @foreach($styles as $style)
    <url>
        <loc>{{ route('styles.' . $style) }}</loc>
        <priority>0.6</priority>
    </url>
    @endforeach

    @foreach($destinations as $destination)
    <url>
        <loc>{{ route('destinations.show', $destination->slug) }}</loc>
        @if($destination->updated_at)<lastmod>{{ $destination->updated_at->tz('UTC')->toAtomString() }}</lastmod>@endif
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach($cultural as $experience)
    <url>
        <loc>{{ route('cultural.show', $experience->slug) }}</loc>
        @if($experience->updated_at)<lastmod>{{ $experience->updated_at->tz('UTC')->toAtomString() }}</lastmod>@endif
        <priority>0.7</priority>
    </url>
    @endforeach

    @foreach($circuits as $circuit)
    <url>
        <loc>{{ route('circuits.show', $circuit) }}</loc>
        <priority>0.7</priority>
    </url>
    @endforeach

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
