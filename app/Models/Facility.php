<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facility';
    protected $guarded = [];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function units()
    {
        return $this->hasMany(AreaUnit::class);
    }
}
