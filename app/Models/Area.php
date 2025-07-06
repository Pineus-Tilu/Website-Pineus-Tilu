<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'area';

    protected $fillable = [
        'name',
        'description',
        'image_url',
        'extra_charge',
        'slug'
    ];

    // Relasi ke facilities
    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }

    // Relasi ke units
    public function units()
    {
        return $this->hasMany(AreaUnit::class);
    }

    // Relasi ke galeri facility
    public function galeriFacility()
    {
        return $this->hasMany(Galeri::class, 'area_id')
                    ->where('type', 'facility')
                    ->orderBy('sort_order')
                    ->orderBy('created_at');
    }

    // Relasi ke galeri dashboard
    public function galeriDashboard()
    {
        return $this->hasMany(Galeri::class, 'area_id')
                    ->where('type', 'dashboard')
                    ->orderBy('sort_order')
                    ->orderBy('created_at');
    }

    // Relasi ke featured galeri (galeri utama untuk dashboard)
    public function featuredGaleri()
    {
        return $this->hasOne(Galeri::class, 'area_id')
                    ->where('type', 'dashboard')
                    ->where('is_featured', true)
                    ->orderBy('sort_order')
                    ->orderBy('created_at');
    }

    // Relasi ke semua galeri
    public function galeri()
    {
        return $this->hasMany(Galeri::class, 'area_id');
    }

    // Accessor untuk slug
    public function getSlugAttribute()
    {
        return strtolower(str_replace(' ', '-', $this->name));
    }
}