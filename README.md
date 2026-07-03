# Go Deep Africa Safari

A tourism platform for a Tanzania-based safari and Kilimanjaro tour operator, built with **Laravel 13** and **Bootstrap 5**. It presents safari packages, destinations and the Northern / Southern / Eastern circuits, a dedicated Zanzibar experience, a blog and an impact ("Giving Back") section, and captures bookings and enquiries through the site and via email.

## Features

- **Public site** — home, safari packages, destinations, safari circuits (with maps), Zanzibar landing page, Kilimanjaro routes, blog, about, contact and impact pages.
- **Multi-language** — English, Kiswahili, French, Spanish, German and Simplified Chinese. Static UI strings live in `lang/`; dynamic (database) content is translated from a baked, self-contained translation table (no external API is contacted at runtime).
- **Admin panel** — manage packages, destinations, Kilimanjaro packages, blog posts, packing lists, the impact section, menus, announcements, bookings and site settings.
- **Bookings & enquiries** — validated forms that notify the business by email and appear in the admin dashboard.
- **SEO** — per-page titles/descriptions, Open Graph/Twitter tags, JSON-LD structured data, `hreflang` alternates, sitemap and robots.txt.

## Tech stack

| Area      | Choice                                  |
|-----------|-----------------------------------------|
| Framework | Laravel 13 (PHP 8.3+)                    |
| Frontend  | Blade, Bootstrap 5, Vite, Sass          |
| Database  | MySQL (production) / SQLite (local)     |
| Auth      | Laravel UI + Sanctum                    |

## Local setup

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate

# SQLite is the simplest local database:
#   set DB_CONNECTION=sqlite in .env, then:
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"

php artisan migrate --seed
npm run build            # or: npm run dev
php artisan serve        # http://127.0.0.1:8000
```

Default seeded content includes safari packages, destinations (including Zanzibar), blog posts and the baked translations.

## Configuration notes

- **Translations** — `config/translation.php`. `TRANSLATION_API_ENABLED=false` (default) keeps the site fully self-contained: it serves the translations shipped in `database/data/translations.php`. See [docs on regenerating translations](database/data/translations.php).
- **Mail** — set the SMTP block in `.env` to the sending mailbox (see `.env.example`). Booking/enquiry notifications go to `MAIL_ADMIN_ADDRESS`.
- **Circuits & Zanzibar content** — editable in `config/circuits.php` and `config/zanzibar.php`.

## Deployment

See **[DEPLOYMENT.md](DEPLOYMENT.md)** for the shared-hosting (cPanel) deployment guide.

## Project layout

```
app/            Controllers, models, services (Translator), jobs
config/         App config + circuits.php, zanzibar.php, locales.php, translation.php
database/       Migrations, seeders, and database/data/translations.php (baked translations)
lang/           UI translation files (en, sw, fr, es, de, zh)
resources/      Blade views, Sass, JS
routes/         web.php, api.php
scripts/        Deployment / maintenance helpers (CLI only)
```
