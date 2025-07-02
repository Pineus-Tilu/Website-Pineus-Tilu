<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facility';
    
    protected $fillable = [
        'area_id',
        'type',
        'description',
        'galeri',
        'jumlah_maksimum_orang'
    ];

    protected $casts = [
        'jumlah_maksimum_orang' => 'integer',
        'galeri' => 'array',
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
        return $this->units()->with('price')->first()?->price?->high_season;
    }
}