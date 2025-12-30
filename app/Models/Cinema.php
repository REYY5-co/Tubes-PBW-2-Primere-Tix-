<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    protected $fillable = ['location_id', 'name'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
