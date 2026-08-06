<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    /**
     * The admin dashboard is behind "auth" alone, which only proves the
     * visitor is logged in — not that they hold the admin/sub_admin role.
     * This gate closes that gap now that role-based access matters.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->isAdmin()) {
            abort(403, 'You do not have permission to access this area.');
        }

        return $next($request);
    }
}
