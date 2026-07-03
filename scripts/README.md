# scripts/

Maintenance and deployment helpers. These are **command-line only** and live
outside the web root — they are never served to visitors.

| File                  | Purpose |
|-----------------------|---------|
| `fix-permissions.php` | Reset `storage/` and `bootstrap/cache/` permissions after an upload. Run with `php scripts/fix-permissions.php`. |
| `storage-fix.sh`      | Re-create the `storage` symlink and writable folders on the server. |
| `server-diagnose.sh`  | Print PHP version, extensions and paths to diagnose a hosting issue. |
| `dev-server.php`      | Router for a local preview via the PHP built-in server: `php -S 127.0.0.1:8000 -t public scripts/dev-server.php`. Not used in production. |
| `auto_push.ps1`       | Local git convenience script (Windows). |

> Prefer Laravel's own tooling where possible: `php artisan storage:link`,
> `php artisan optimize` / `php artisan optimize:clear`.
