<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

/**
 * Resolves and applies the request locale.
 *
 * Priority order (highest first):
 *   1. Explicit ?lang= query parameter (also persisted for next time)
 *   2. Previously stored session preference
 *   3. Persistent cookie preference
 *   4. Browser Accept-Language header (first visit only)
 *   5. Application default locale
 */
class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $supported = array_keys(config('locales.supported', []));
        $default   = config('locales.default', config('app.locale', 'en'));

        $locale = $this->resolveLocale($request, $supported, $default);

        App::setLocale($locale);
        session(['locale' => $locale]);

        $response = $next($request);

        // Persist for a year so the choice survives future visits.
        return $response->withCookie(cookie()->forever('locale', $locale));
    }

    private function resolveLocale(Request $request, array $supported, string $default): string
    {
        // 1. Explicit switch via query string.
        if ($request->filled('lang') && in_array($request->query('lang'), $supported, true)) {
            return $request->query('lang');
        }

        // 2. Session preference.
        if (in_array(session('locale'), $supported, true)) {
            return session('locale');
        }

        // 3. Cookie preference.
        if (in_array($request->cookie('locale'), $supported, true)) {
            return $request->cookie('locale');
        }

        // 4. Browser preferred language (matched against supported set).
        $preferred = $request->getPreferredLanguage($supported);
        if ($preferred && in_array($preferred, $supported, true)) {
            return $preferred;
        }

        // 5. Fallback.
        return $default;
    }
}
