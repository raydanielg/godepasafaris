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
|   flag   => emoji flag for a lightweight, dependency-free indicator
|   hreflang => value used for <link rel="alternate" hreflang="...">
|
*/

return [

    'default' => 'en',

    'supported' => [
        'en' => ['code' => 'en', 'name' => 'English',            'native' => 'English',    'flag' => '🇬🇧', 'hreflang' => 'en'],
        'sw' => ['code' => 'sw', 'name' => 'Swahili',            'native' => 'Kiswahili',  'flag' => '🇹🇿', 'hreflang' => 'sw'],
        'fr' => ['code' => 'fr', 'name' => 'French',             'native' => 'Français',   'flag' => '🇫🇷', 'hreflang' => 'fr'],
        'es' => ['code' => 'es', 'name' => 'Spanish',            'native' => 'Español',    'flag' => '🇪🇸', 'hreflang' => 'es'],
        'zh' => ['code' => 'zh', 'name' => 'Chinese (Simplified)', 'native' => '简体中文', 'flag' => '🇨🇳', 'hreflang' => 'zh-Hans'],
    ],

];
