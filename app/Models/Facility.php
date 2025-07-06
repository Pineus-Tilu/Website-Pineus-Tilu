<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model
{
    protected $table = 'facility';
    
    protected $fillable = [
        'area_id',
        'description',
        'image_path',
        'type'
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function units(): HasMany
    {
        return $this->hasMany(AreaUnit::class, 'facility_id');
    }

    // Relasi dasar tanpa scope
    public function galeri(): HasMany
    {
        return $this->hasMany(Galeri::class);
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
        return $this->units()->with('price')->first()?->price?->highseason;
    }

    // Accessor untuk gambar URL
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return null;
    }
}