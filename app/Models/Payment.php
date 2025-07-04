<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'order_id',
        'transaction_id',
        'payment_type',
        'transaction_status',
        'fraud_status',
        'gross_amount',
        'expired_at',
        'qr_url',
        'qr_string',
        'snap_token',
    ];

    protected $casts = [
        'gross_amount' => 'decimal:2',
        'expired_at' => 'date',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}