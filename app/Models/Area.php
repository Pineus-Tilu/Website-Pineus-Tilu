<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';
    
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'extra_charge'
    ];

    protected $casts = [
        'extra_charge' => 'decimal:2',
    ];

    // Menambahkan accessor untuk default value jika diperlukan
    protected $attributes = [
        'extra_charge' => 0,
    ];

    public function facilities()
    {
        return $this->hasMany(Facility::class, 'area_id');
    }
}