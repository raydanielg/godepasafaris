<?php

/*
|--------------------------------------------------------------------------
| Supported Locales
|--------------------------------------------------------------------------
|
| Central registry of every language the public site supports. The order
| here is the order the language switcher renders them in. Each entry:
|
|   code   => ISO 639-1 code used by app()->setLocale() and the lang/ files
|   name   => English name (used in aria-labels / admin)
|   native => Endonym shown in the switcher
|   flag   => emoji flag (fallback indicator; real flag images use `country`)
|   country => ISO 3166-1 alpha-2 code used to render a flag image (flagcdn)
|   hreflang => value used for <link rel="alternate" hreflang="...">
|
*/

return [

    'default' => 'en',

    'supported' => [
        'en' => ['code' => 'en', 'name' => 'English',            'native' => 'English',    'flag' => '🇬🇧', 'country' => 'gb', 'hreflang' => 'en'],
        'sw' => ['code' => 'sw', 'name' => 'Swahili',            'native' => 'Kiswahili',  'flag' => '🇹🇿', 'country' => 'tz', 'hreflang' => 'sw'],
        'fr' => ['code' => 'fr', 'name' => 'French',             'native' => 'Français',   'flag' => '🇫🇷', 'country' => 'fr', 'hreflang' => 'fr'],
        'es' => ['code' => 'es', 'name' => 'Spanish',            'native' => 'Español',    'flag' => '🇪🇸', 'country' => 'es', 'hreflang' => 'es'],
        'de' => ['code' => 'de', 'name' => 'German',             'native' => 'Deutsch',    'flag' => '🇩🇪', 'country' => 'de', 'hreflang' => 'de'],
        'zh' => ['code' => 'zh', 'name' => 'Chinese (Simplified)', 'native' => '简体中文', 'flag' => '🇨🇳', 'country' => 'cn', 'hreflang' => 'zh-Hans'],
    ],

];
