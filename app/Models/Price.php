<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
     protected $table = 'prices';
     protected $guarded = [];

    public function unit()
    {
        return $this->belongsTo(AreaUnit::class, 'unit_id');
    }
}
