<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'unit_id',
        'booking_for_date',
        'status_id',
        'invoice_number',
        'total_amount',
        'customer_name',
        'customer_email',
        'customer_phone'
    ];

    protected $casts = [
        'booking_for_date' => 'date',
        'total_amount' => 'decimal:2',
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

    public function bookingDetails(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(BookingStatus::class, 'status_id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    // Generate invoice number if not exists
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($booking) {
            if (!$booking->invoice_number) {
                $booking->invoice_number = 'INV-' . date('Ymd') . '-' . str_pad((static::whereDate('created_at', date('Y-m-d'))->count() + 1), 4, '0', STR_PAD_LEFT);
            }
        });
    }
}