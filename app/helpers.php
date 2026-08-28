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

if (! function_exists('setting')) {
    /**
     * Read an admin-managed site setting (Admin → Settings).
     * Falls back to $default when unset, and never throws.
     *
     * Usage in Blade:  {{ setting('contact_phone', '+255 794 636 471') }}
     */
    function setting(string $key, ?string $default = null): ?string
    {
        return SiteSetting::get($key, $default);
    }
}

if (! function_exists('phone_digits')) {
    /**
     * Strip a displayed phone number down to digits for tel: and wa.me links,
     * so the visible number and the link can never drift apart.
     * "+255 794 636 471" -> "255794636471"
     */
    function phone_digits(?string $number): string
    {
        return preg_replace('/\D+/', '', (string) $number);
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
