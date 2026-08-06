<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class BlockSuspiciousIps
{
    /**
     * Repeated honeypot/timing/Turnstile failures from the same IP earn a
     * temporary block (see PreventsSpam::recordSpamStrike). This middleware
     * is the enforcement side: checked before the booking controller runs.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = 'booking_ip_blocked:'.$request->ip();

        if (Cache::get($key)) {
            abort(429, 'Too many suspicious requests from this address. Please try again later.');
        }

        return $next($request);
    }
}
