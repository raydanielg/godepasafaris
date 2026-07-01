---
name: i18n-architecture
description: How multi-language (i18n) works on the Go Deep Africa Safari site — conventions for adding translations
metadata:
  type: project
---

The public site supports 6 locales: en (default), sw, fr, es, de, zh. Architecture:

- **Registry:** `config/locales.php` — code, native name, flag emoji, hreflang. Order here = switcher order.
- **Resolution:** `app/Http/Middleware/SetLocale.php` (appended to web group in `bootstrap/app.php`). Priority: `?lang=` → session → cookie → browser `Accept-Language` → default. Persists to session + 1-year cookie.
- **Strings:** `lang/<code>/messages.php`, grouped arrays (nav, common, booking, footer, home, hero, inquiry, cta, packages). Reference in Blade as `{{ __('messages.<group>.<key>') }}`. All 5 files MUST have identical key sets.
- **Switcher:** `resources/views/partials/language_switcher.blade.php`, included with `['variant' => 'compact']` (desktop navbar) or `'block'` (mobile sidebar). Links use `request()->fullUrlWithQuery(['lang' => $code])`.
- **hreflang:** emitted in `partials/seo.blade.php` looping `config('locales.supported')` + x-default.

**When adding translations:** add the key to ALL 5 lang files (keep parity), then reference it. Verify with the flatten-and-diff PHP one-liner (parity) and grep partials for `messages.*` refs that resolve.

Covered so far (static UI): header nav (both menus), footer, hero, general_inquiry_modal, prefooter_cta, packages, tour_list. NOT yet done: page bodies (contact, about, blog, safari/destination detail views).

**Dynamic DB content** is auto-translated + cached (chosen approach: free engine):
- `config/translation.php` — driver (default `mymemory`, free/no-key; `deepl`/`libretranslate` optional via env), locale_map, timeout.
- `app/Services/Translator.php` — `Translator::text($str, $locale)`. Caches each unique string per locale in the `translations` table (migration `2026_07_01_000001`), model `App\Models\TranslationCache`. Chunks long text <480 chars for MyMemory. ALWAYS falls back to original text on any error (never breaks a page).
- Helper `tr($str)` (defined in `app/helpers.php`, required in `AppServiceProvider::register`) + Blade `@t` / `@traw`. Use `{{ tr($model->title) }}` for DB fields.
- Requires `php artisan migrate` to create the `translations` table. First page load per language is slower (API calls) then cached. Set `MYMEMORY_EMAIL` in .env to raise free quota, or `TRANSLATION_DRIVER=deepl` + `DEEPL_KEY` for better quality.
- Wired so far: package titles/summaries, destination names/taglines (header mega-menus), packages partial, tour_list cards.
