<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'prices';
    
    protected $fillable = [
        'unit_id',
        'weekday',
        'weekend', 
        'high_season'
    ];

    protected $casts = [
        'weekday' => 'decimal:2',
        'weekend' => 'decimal:2',
        'high_season' => 'decimal:2',
    ];

    public function unit()
    {
        return $this->belongsTo(AreaUnit::class, 'unit_id');
    }
}