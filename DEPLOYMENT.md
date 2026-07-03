# Deployment — cPanel Shared Hosting

This guide deploys **Go Deep Africa Safari** to a cPanel host (e.g. `https://godeepafricasafari.com:2083`).

Because `vendor/` and `public/build/` are committed to the repository, the server does **not** need Composer or Node.js — you upload the built project as-is.

---

## 1. Prerequisites (in cPanel)

1. **PHP version** — set to **8.3 or 8.4** (cPanel » *MultiPHP Manager*). Enable the extensions Laravel needs: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`, `curl`.
2. **MySQL database** — cPanel » *MySQL Databases*: create a database and a user, add the user to the database with **All Privileges**. Note the `dbname`, `username`, `password` (they'll be prefixed with your cPanel account name).

---

## 2. Upload the project

Upload everything **except** local-only files (already handled by `.gitignore`): not `.env`, `node_modules/`, or `database/*.sqlite`.

**Recommended layout** — keep the Laravel app *outside* the public web root:

```
/home/<cpaneluser>/
├── godeepafrica/          ← the whole project (app, vendor, resources, …)
│   ├── app/  config/  routes/  vendor/  …
│   └── public/            ← Laravel's public dir
└── public_html/           ← the domain's document root
```

Then point the site at `godeepafrica/public` using **one** of these:

### Option A — Change the document root (cleanest)
If your host lets you edit the domain's document root (cPanel » *Domains*), set it to:
```
/home/<cpaneluser>/godeepafrica/public
```
Done — nothing else to move.

### Option B — Serve from `public_html`
If the document root must stay `public_html`:
1. Copy the **contents** of `godeepafrica/public/` into `public_html/`.
2. Edit `public_html/index.php` and update the two require paths to point up into the app folder:
   ```php
   require __DIR__.'/../godeepafrica/vendor/autoload.php';
   $app = require_once __DIR__.'/../godeepafrica/bootstrap/app.php';
   ```
3. Keep `public_html/.htaccess` (from the project's `public/.htaccess`).

---

## 3. Environment file

Create `.env` in the project root (copy from `.env.example`) and fill in real values:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://godeepafricasafari.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=<cpaneluser>_godeepafrica
DB_USERNAME=<cpaneluser>_dbuser
DB_PASSWORD=********

MAIL_MAILER=smtp
MAIL_HOST=mail.godeepafricasafari.com
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
MAIL_USERNAME=info@godeepafricasafari.com
MAIL_PASSWORD=********
MAIL_FROM_ADDRESS="info@godeepafricasafari.com"
MAIL_ADMIN_ADDRESS="info@godeepafricasafari.com"

TRANSLATION_API_ENABLED=false
```

Then generate the app key (cPanel » *Terminal*, or via an SSH session):
```bash
php artisan key:generate
```
> No terminal? Generate a key locally with `php artisan key:generate --show` and paste it into `APP_KEY=` in the server's `.env`.

---

## 4. Database

- **With Terminal/SSH:**
  ```bash
  php artisan migrate --force
  php artisan db:seed --force        # first deploy only, to load starter content
  ```
- **Without Terminal:** run `php artisan migrate --seed` locally against a copy, export the SQL (cPanel » *phpMyAdmin* » *Export*) and import it into the cPanel database.

---

## 5. Permissions

Ensure these are writable by the web server (usually `755` dirs / `644` files is enough on cPanel):
```
storage/                 (and all subfolders)
bootstrap/cache/
```
Then link storage so uploaded images are served:
```bash
php artisan storage:link
```
> No Terminal? Create the symlink in cPanel, or copy `storage/app/public` into `public/storage`.

---

## 6. Optimise & cache

```bash
php artisan optimize        # caches config, routes and views
php artisan optimize:clear  # run this instead after each future update
```

---

## 7. Front-end assets

`public/build/` is already committed, so the compiled CSS/JS ship with the project — nothing to build on the server. If you change styles/scripts later, run `npm run build` **locally** and re-upload `public/build/`.

---

## 8. (Optional) Queue & scheduler

Bookings send mail synchronously, so a worker isn't required. If you later move mail/translation warming to the queue (`QUEUE_CONNECTION=database`), add a cron job in cPanel » *Cron Jobs*:
```
* * * * * cd /home/<cpaneluser>/godeepafrica && php artisan schedule:run >> /dev/null 2>&1
```

---

## 9. Post-deploy checklist

- [ ] Home page loads over HTTPS with no errors (`APP_DEBUG=false`).
- [ ] `/zanzibar` and `/safari-circuits/northern` render, maps display.
- [ ] Language switch works (`?lang=fr`, `?lang=sw`, …).
- [ ] Submit a test enquiry — confirm it reaches `MAIL_ADMIN_ADDRESS` and shows in the admin dashboard.
- [ ] Admin login works; create/edit a package and upload an image.
- [ ] `robots.txt` and `/sitemap.xml` resolve.

---

## Updating an existing deployment

```bash
# upload changed files, then:
php artisan migrate --force
php artisan optimize:clear
```

> **Note on OneDrive-synced clones:** if you develop inside a OneDrive folder, `vendor/…/server.php` can appear "deleted" in `git status` when files are dehydrated/offline. It is intact in git and unused in production — do not stage that deletion.
