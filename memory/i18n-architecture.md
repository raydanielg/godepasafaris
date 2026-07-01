---
name: i18n-architecture
description: How multi-language (i18n) works on the Go Deep Africa Safari site — conventions for adding translations
metadata:
  type: project
---

The public site supports 5 locales: en (default), sw, fr, es, zh. Architecture:

- **Registry:** `config/locales.php` — code, native name, flag emoji, hreflang. Order here = switcher order.
- **Resolution:** `app/Http/Middleware/SetLocale.php` (appended to web group in `bootstrap/app.php`). Priority: `?lang=` → session → cookie → browser `Accept-Language` → default. Persists to session + 1-year cookie.
- **Strings:** `lang/<code>/messages.php`, grouped arrays (nav, common, booking, footer, home, hero, inquiry, cta, packages). Reference in Blade as `{{ __('messages.<group>.<key>') }}`. All 5 files MUST have identical key sets.
- **Switcher:** `resources/views/partials/language_switcher.blade.php`, included with `['variant' => 'compact']` (desktop navbar) or `'block'` (mobile sidebar). Links use `request()->fullUrlWithQuery(['lang' => $code])`.
- **hreflang:** emitted in `partials/seo.blade.php` looping `config('locales.supported')` + x-default.

**When adding translations:** add the key to ALL 5 lang files (keep parity), then reference it. Verify with the flatten-and-diff PHP one-liner (parity) and grep partials for `messages.*` refs that resolve.

Covered so far: header nav (both menus), footer, hero, general_inquiry_modal, prefooter_cta, packages. NOT yet done: page bodies (contact, about, blog, safari/destination detail views) and DB-stored content (package/destination titles+descriptions — would need translation columns or spatie/laravel-translatable). See [[i18n-remaining-work]].
