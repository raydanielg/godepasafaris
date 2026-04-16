<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpactGallery extends Model
{
    use HasFactory;

    protected $table = 'impact_gallery';

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'location',
        'category',
        'column_width',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'column_width' => 'integer',
        'display_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('display_order');
    }
}
