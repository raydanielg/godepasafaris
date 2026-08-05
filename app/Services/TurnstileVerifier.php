<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TurnstileVerifier
{
    private const VERIFY_URL = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

    /**
     * Verifies the "cf-turnstile-response" token against Cloudflare.
     *
     * If no secret key is configured (local/staging without Turnstile set
     * up yet), verification is skipped and this returns true so the form
     * keeps working — see config/services.php and .env.example.
     */
    public function passes(?string $token, ?string $ip): bool
    {
        $secret = config('services.turnstile.secret_key');

        if (!$secret) {
            return true;
        }

        if (!$token) {
            return false;
        }

        try {
            $response = Http::asForm()->post(self::VERIFY_URL, [
                'secret' => $secret,
                'response' => $token,
                'remoteip' => $ip,
            ]);

            return (bool) $response->json('success', false);
        } catch (\Throwable $e) {
            Log::channel('bookings')->error('Turnstile verification request failed: '.$e->getMessage());

            // Fail closed: if we can't reach Cloudflare, treat it as a failed
            // check rather than silently letting every submission through.
            return false;
        }
    }
}
