<?php

namespace App\Models\Concerns;

/**
 * Safe rendering of a trip's length.
 *
 * Several production packages have a blank or 0 `days` value, and the views
 * printed it raw. That put "0 Days" in front of customers and Google on the
 * tour listings, and `days - 1` turned it into "0 Days - -1 Nights". Duration
 * also shows in search snippets, so bad data here is directly commercial.
 *
 * The real fix is correct data in the admin, but the display should never be
 * able to produce nonsense. These accessors recover the number from the title
 * when the column is empty ("9-Day Kilimanjaro Lemosho" -> 9) and otherwise
 * report "unknown" so the view can hide the badge instead of inventing one.
 */
trait HasTripDuration
{
    /** Trip length in days, or null when it genuinely cannot be determined. */
    public function getDurationDaysAttribute(): ?int
    {
        $days = (int) ($this->attributes['days'] ?? 0);

        if ($days > 0) {
            return $days;
        }

        // Fall back to a leading count in the title: "9-Day …", "7 Day …",
        // "6 Days …". Only a leading number counts, so "Serengeti 2 Rivers"
        // can't be mistaken for a duration.
        if (preg_match('/^\D*(\d{1,2})\s*[- ]?\s*day/i', (string) ($this->attributes['title'] ?? ''), $m)) {
            $parsed = (int) $m[1];

            if ($parsed > 0 && $parsed <= 60) {
                return $parsed;
            }
        }

        return null;
    }

    /** Nights, never negative. Null when the duration is unknown. */
    public function getDurationNightsAttribute(): ?int
    {
        $days = $this->duration_days;

        return $days === null ? null : max(0, $days - 1);
    }

    /**
     * Ready-to-print label, e.g. "9 Days" — or an empty string when unknown so
     * `{{ $package->duration_label }}` simply renders nothing.
     */
    public function getDurationLabelAttribute(): string
    {
        $days = $this->duration_days;

        if ($days === null) {
            return '';
        }

        return $days . ' ' . __('messages.common.days');
    }

    /** Whether there is a duration worth showing at all. */
    public function getHasDurationAttribute(): bool
    {
        return $this->duration_days !== null;
    }
}
