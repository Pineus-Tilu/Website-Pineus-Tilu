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
        return $this->hasOne(Price::class, 'unit_id');
    }
}
