<?php

use App\Models\SiteSetting;
use App\Services\Translator;

if (! function_exists('bg')) {
    /**
     * Resolve an admin-managed page background image to a URL.
     * Returns the uploaded/chosen image when set, otherwise the given default
     * (which may be a local asset path or an external URL).
     *
     * Usage in Blade:  url('{{ bg('bg_cultural', 'images/default.jpg') }}')
     */
    function bg(string $key, ?string $default = null): ?string
    {
        return SiteSetting::image($key, $default);
    }
}

if (! function_exists('tr')) {
    /**
     * Translate a dynamic (database) string into the current locale.
     * Safe everywhere — returns the original text for English or on error.
     *
     * Usage in Blade:  {{ tr($package->title) }}   or   {!! tr($post->body) !!}
     */
    function tr(?string $text, ?string $locale = null): string
    {
        return Translator::text($text, $locale);
    }
}
