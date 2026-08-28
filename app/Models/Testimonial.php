<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * A real customer testimonial, entered by staff from consent-given feedback.
 *
 * Replaces the hardcoded array of invented reviewers that used to live in
 * WelcomeController. Nothing here is generated or defaulted into existence —
 * if there are no rows, the site shows no testimonials.
 */
class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'content',
        'rating',
        'image',
        'trip',
        'travelled_on',
        'is_featured',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'rating'        => 'integer',
        'is_featured'   => 'boolean',
        'is_active'     => 'boolean',
        'display_order' => 'integer',
        'travelled_on'  => 'date',
    ];

    /** Visible testimonials, in the order staff arranged them. */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('display_order')
            ->orderByDesc('id');
    }

    /**
     * Visible testimonials, guaranteed not to throw.
     *
     * Public pages must call this rather than active()->get(). The site is
     * deployed by pulling code and running migrations as two separate manual
     * steps, so there is always a window where the code is live but the table
     * is not — and on 2026-08-28 that window took the whole homepage down with
     * a 500. Testimonials are decorative; they are never worth an outage.
     * Mirrors the defensive style already used by SiteSetting::get() and the
     * cultural-experiences guard in SitemapController.
     */
    public static function published(): Collection
    {
        try {
            if (! Schema::hasTable('testimonials')) {
                return collect();
            }

            return static::active()->get();
        } catch (\Throwable $e) {
            report($e);

            return collect();
        }
    }

    /**
     * Photo URL, or null when none was supplied. The views fall back to a
     * lettered initial rather than inventing a stock face for the person.
     */
    public function getImageUrlAttribute(): ?string
    {
        $value = trim((string) $this->image);

        if ($value === '') {
            return null;
        }

        if (Str::startsWith($value, ['http://', 'https://', '//', 'data:'])) {
            return $value;
        }

        return asset(ltrim($value, '/'));
    }

    /** First letter of the name, for the no-photo avatar. */
    public function getInitialAttribute(): string
    {
        return Str::upper(Str::substr(trim((string) $this->name), 0, 1)) ?: '?';
    }

    /** Clamp to 1–5 so a bad value can never render a broken star row. */
    public function getStarsAttribute(): int
    {
        return max(1, min(5, (int) $this->rating));
    }
}
