<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SafariActivity extends Model
{
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
