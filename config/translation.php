<?php

/*
|--------------------------------------------------------------------------
| Dynamic (database) content translation
|--------------------------------------------------------------------------
|
| Powers tr() / @t for translating DB-stored strings (package titles,
| descriptions, etc.) at render time. Each unique string is translated
| once per locale and cached in the `translations` table, so the external
| API is hit only on the first appearance of a given string.
|
| The default driver is "mymemory" — a free, key-less translation API.
| To upgrade quality later, set TRANSLATION_DRIVER=deepl (+ DEEPL_KEY) or
| point "libretranslate" at your own instance. No code changes needed.
|
*/

return [

    'enabled' => env('TRANSLATION_ENABLED', true),

    // Language DB content is authored in; never translated to itself.
    'source_locale' => 'en',

    // mymemory | libretranslate | deepl
    'driver' => env('TRANSLATION_DRIVER', 'mymemory'),

    // Seconds before an API call is abandoned (falls back to original text).
    'timeout' => (int) env('TRANSLATION_TIMEOUT', 4),

    // Map app locales to the code each engine expects.
    'locale_map' => [
        'sw' => 'sw',
        'fr' => 'fr',
        'es' => 'es',
        'de' => 'de',
        'zh' => 'zh-CN',
    ],

    'mymemory' => [
        'endpoint' => 'https://api.mymemory.translated.net/get',
        // Optional: a contact email raises the free anonymous daily quota.
        'email' => env('MYMEMORY_EMAIL'),
    ],

    'libretranslate' => [
        'endpoint' => env('LIBRETRANSLATE_URL'),      // e.g. https://libretranslate.com/translate
        'api_key'  => env('LIBRETRANSLATE_KEY'),
    ],

    'deepl' => [
        'endpoint' => env('DEEPL_ENDPOINT', 'https://api-free.deepl.com/v2/translate'),
        'api_key'  => env('DEEPL_KEY'),
    ],

];
