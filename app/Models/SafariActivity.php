<?php

namespace App\Models;

use App\Models\Concerns\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SafariActivity extends Model
{
    use Translatable;

    /** User-facing fields translated by the auto-translation pipeline. */
    public static array $translatable = [
        'name', 'description',
    ];

    protected $fillable = [
        'safari_destination_id',
        'name',
        'icon',
        'description',
        'display_order',
    ];

    public function safariDestination(): BelongsTo
    {
        return $this->belongsTo(SafariDestination::class);
    }
}
