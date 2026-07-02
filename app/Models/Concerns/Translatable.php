<?php

namespace App\Models\Concerns;

/**
 * Marks a model's user-facing text fields as translatable and knows how to
 * flatten them (including JSON/array fields like itinerary or inclusions)
 * into a flat list of source strings that the translation cache can warm.
 *
 * A model opts in by using this trait and declaring:
 *
 *   public static array $translatable = ['title', 'summary', 'itinerary'];
 */
trait Translatable
{
    /** Field/array keys that are never translated (paths, codes, numbers…). */
    protected static array $translatableKeyBlacklist = [
        'image', 'icon', 'slug', 'url', 'day', 'id', 'price', 'currency', 'days', 'color', 'badge_color',
    ];

    /**
     * All distinct, non-empty source strings on this record that should be
     * translated — scalar fields plus any nested strings inside array/JSON
     * fields. De-duplicated so a repeated phrase is only warmed once.
     *
     * @return string[]
     */
    public function translatableStrings(): array
    {
        $fields = static::$translatable ?? [];
        $strings = [];

        foreach ($fields as $field) {
            $this->collectStrings($this->getAttribute($field), $strings);
        }

        return array_values(array_unique(array_filter($strings, fn ($s) => trim((string) $s) !== '')));
    }

    /** The record's primary label (first non-empty scalar field) — used for fast "already warmed" checks. */
    public function primaryTranslatableString(): ?string
    {
        foreach (static::$translatable ?? [] as $field) {
            $value = $this->getAttribute($field);
            if (is_string($value) && trim($value) !== '') {
                return $value;
            }
        }

        return null;
    }

    /** Recursively pull translatable string leaves out of scalars/arrays. */
    protected function collectStrings($value, array &$out): void
    {
        if (is_string($value)) {
            $out[] = $value;
            return;
        }

        if (is_array($value)) {
            foreach ($value as $key => $item) {
                if (is_string($key) && in_array(strtolower($key), static::$translatableKeyBlacklist, true)) {
                    continue;
                }
                $this->collectStrings($item, $out);
            }
        }
    }
}
