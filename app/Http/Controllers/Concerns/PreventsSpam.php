<?php

namespace App\Http\Controllers\Concerns;

use App\Services\TurnstileVerifier;
use App\Support\FormTiming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

trait PreventsSpam
{
    /**
     * Detect automated (bot) form submissions via a hidden "honeypot" field.
     *
     * The public booking/inquiry forms include a hidden text input named
     * "website" that real visitors never see or fill. Spam bots fill in every
     * field they find, so a non-empty value here is a reliable bot signal.
     */
    protected function isSpamSubmission(Request $request): bool
    {
        return filled($request->input('website'));
    }

    /**
     * A real visitor needs at least a couple of seconds to see and fill the
     * form. Bots that fetch the page and immediately POST do not. Missing or
     * tampered timing tokens are treated as suspicious too.
     */
    protected function isSubmittedTooFast(Request $request, int $minSeconds = 3): bool
    {
        $elapsed = FormTiming::elapsedSeconds($request->input('form_ts'));

        return $elapsed === null || $elapsed < $minSeconds;
    }

    protected function passesTurnstile(Request $request): bool
    {
        return app(TurnstileVerifier::class)->passes(
            $request->input('cf-turnstile-response'),
            $request->ip()
        );
    }

    /**
     * IP + user agent captured on every booking so the admin panel and the
     * `bookings:clean` command have something to work with when telling
     * genuine inquiries apart from bot/spam noise after the fact.
     */
    protected function requestMeta(Request $request): array
    {
        return [
            'ip_address' => (string) $request->ip(),
            'user_agent' => (string) substr((string) $request->userAgent(), 0, 255),
        ];
    }

    /**
     * Logs a blocked attempt and gives its IP a strike. Enough strikes within
     * the window earns the IP a temporary block, enforced by the
     * BlockSuspiciousIps middleware on the next request.
     */
    protected function logSpamAttempt(Request $request, string $reason): void
    {
        Log::channel('bookings')->warning('Blocked suspicious booking submission', [
            'reason' => $reason,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'path' => $request->path(),
        ]);

        $this->recordSpamStrike($request);
    }

    private function recordSpamStrike(Request $request): void
    {
        $strikesKey = 'booking_spam_strikes:'.$request->ip();
        $strikes = (int) Cache::get($strikesKey, 0) + 1;
        Cache::put($strikesKey, $strikes, now()->addHour());

        if ($strikes >= 5) {
            Cache::put('booking_ip_blocked:'.$request->ip(), true, now()->addDay());
            Log::channel('bookings')->warning('IP temporarily blocked after repeated suspicious booking attempts', [
                'ip' => $request->ip(),
                'strikes' => $strikes,
            ]);
        }
    }
}
