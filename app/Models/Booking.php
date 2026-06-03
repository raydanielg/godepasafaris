<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'safari_package_id',
        'tour_id',
        'tour_name',
        'name',
        'email',
        'phone',
        'travel_date',
        'travelers',
        'accommodation',
        'message',
        'status',
    ];

    protected $casts = [
        'travel_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function safariPackage()
    {
        return $this->belongsTo(SafariPackage::class, 'safari_package_id');
    }
}
