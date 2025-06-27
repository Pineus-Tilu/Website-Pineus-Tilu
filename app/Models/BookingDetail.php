<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $fillable = [
        'booking_id',
        'number_of_people',
        'extra_charge',
        'notes',
        'total_price',
        'check_in',
        'check_out',
        'nama',
        'email',
        'telepon',
    ];
}
