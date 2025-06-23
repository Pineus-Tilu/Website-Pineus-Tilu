<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';
    protected $guarded = [];

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }

    public function units()
    {
        return $this->hasManyThrough(AreaUnit::class, Facility::class, 'area_id', 'facility_id', 'id', 'id');
    }
}
