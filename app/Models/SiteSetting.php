<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    /** In-request cache of key => value so a page doesn't hit the DB repeatedly. */
    protected static ?array $cache = null;

    /**
     * Read a setting value. Falls back to $default when the key is missing/blank
     * or the table doesn't exist yet (fresh deploy) — never throws.
     */
    public static function get(string $key, $default = null)
    {
        if (static::$cache === null) {
            static::$cache = [];
            try {
                if (Schema::hasTable('site_settings')) {
                    static::$cache = static::query()->pluck('value', 'key')->all();
                }
            } catch (\Throwable $e) {
                // leave cache empty; callers get their defaults
            }
        }

        $value = static::$cache[$key] ?? null;

        return ($value === null || $value === '') ? $default : $value;
    }

    /** Persist a setting and keep the in-request cache in sync. */
    public static function set(string $key, ?string $value, string $group = 'general'): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);

        if (static::$cache !== null) {
            static::$cache[$key] = $value;
        }
    }

    /**
     * Resolve a background/image setting to a usable URL. Stored value may be a
     * local upload path (uploads/…) or a full external URL; $default is used when
     * nothing is set. Returns null only when both are empty.
     */
    public static function image(string $key, ?string $default = null): ?string
    {
        $value = static::get($key, $default);

        return $value ? static::resolveUrl($value) : null;
    }

    private static function resolveUrl(string $path): string
    {
        if (Str::startsWith($path, ['http://', 'https://', '//', 'data:'])) {
            return $path;
        }

        return asset(ltrim($path, '/'));
    }
}
