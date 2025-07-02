<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaUnit extends Model
{
    protected $table = 'area_units';
    protected $guarded = [];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

    public function price()
    {
        // Pastikan foreign key dan local key benar
        return $this->hasOne(Price::class, 'unit_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'unit_id');
    }
}