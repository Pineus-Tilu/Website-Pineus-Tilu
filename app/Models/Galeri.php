<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Galeri extends Model
{
    protected $table = 'galeri';
    
    protected $fillable = [
        'area_id',
        'facility_id',
        'image_path',
        'title',
        'description',
        'type',
        'is_featured',
        'sort_order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    // Accessor untuk mendapatkan URL gambar lengkap
    public function getImageUrlAttribute(): string
    {
        $imagePath = $this->image_path;
        
        // Handle path dengan atau tanpa prefix galeri/
        if (strpos($imagePath, 'galeri/') === 0) {
            $publicPath = asset('storage/' . $imagePath);
            $storagePath = storage_path('app/public/' . $imagePath);
        } else {
            $publicPath = asset('storage/galeri/' . $imagePath);
            $storagePath = storage_path('app/public/galeri/' . $imagePath);
        }
        
        if (file_exists($storagePath)) {
            return $publicPath;
        }
        
        return asset('images/logo.png');
    }

    // Scope methods
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('created_at');
    }

    public function scopeForDashboard(Builder $query): Builder
    {
        return $query->where('type', 'dashboard');
    }

    public function scopeForFacility(Builder $query): Builder
    {
        return $query->where('type', 'facility');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }
}