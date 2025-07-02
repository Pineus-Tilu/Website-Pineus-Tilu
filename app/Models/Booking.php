<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $fillable = ['user_id', 'unit_id', 'booking_for_date'];

    protected $casts = [
        'booking_for_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(AreaUnit::class, 'unit_id');
    }

    public function bookingDetail(): HasOne
    {
        return $this->hasOne(BookingDetail::class);
    }
}