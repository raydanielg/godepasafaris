<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A cached machine translation of a single source string for one locale.
 *
 * @property string $locale
 * @property string $source_hash
 * @property string $source_text
 * @property string $translated_text
 */
class TranslationCache extends Model
{
    protected $table = 'translations';

    protected $fillable = [
        'locale',
        'source_hash',
        'source_text',
        'translated_text',
    ];
}
