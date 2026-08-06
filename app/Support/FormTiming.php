<?php

namespace App\Support;

use Illuminate\Support\Facades\Crypt;

/**
 * Encodes the time a form was rendered into a signed, opaque token so the
 * server can later measure how long the visitor took to submit it. Real
 * visitors need at least a couple of seconds to read and fill a form; bots
 * that fetch the page and immediately POST do not.
 */
class FormTiming
{
    public static function token(): string
    {
        return Crypt::encryptString((string) now()->timestamp);
    }

    /**
     * Seconds between render and submission, or null if the token is
     * missing/tampered with (itself a signal worth treating as suspicious).
     */
    public static function elapsedSeconds(?string $token): ?int
    {
        if (!$token) {
            return null;
        }

        try {
            $renderedAt = (int) Crypt::decryptString($token);
        } catch (\Throwable) {
            return null;
        }

        return max(0, now()->timestamp - $renderedAt);
    }
}
