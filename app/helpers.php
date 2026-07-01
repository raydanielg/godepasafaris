<?php

use App\Services\Translator;

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
