<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaUnit extends Model
{
    protected $table = 'area_units';
    
    protected $fillable = [
        'area_id',
        'unit_name',
        'default_people',
        'max_people'
    ];

    protected $casts = [
        'area_id' => 'integer',
        'default_people' => 'integer',
        'max_people' => 'integer',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function price()
    {
        return $this->hasOne(Price::class, 'unit_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'unit_id');
    }
}