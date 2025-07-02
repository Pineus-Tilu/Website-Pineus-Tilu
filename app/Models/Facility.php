<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facility';
    
    protected $fillable = [
        'area_id',
        'description',
        'image_path',
        'type'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function units()
    {
        return $this->hasMany(AreaUnit::class, 'facility_id');
    }

    // Accessor untuk harga
    public function getWeekdayPriceAttribute()
    {
        return $this->units()->with('price')->first()?->price?->weekday;
    }

    public function getWeekendPriceAttribute()
    {
        return $this->units()->with('price')->first()?->price?->weekend;
    }

    public function getHighSeasonPriceAttribute()
    {
        return $this->units()->with('price')->first()?->price?->highseason;  // Ubah ke highseason
    }
}