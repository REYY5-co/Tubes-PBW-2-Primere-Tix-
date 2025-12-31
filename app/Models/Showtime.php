<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    protected $fillable = [
        'schedule_id',
        'studio_id',
        'time'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }


}
