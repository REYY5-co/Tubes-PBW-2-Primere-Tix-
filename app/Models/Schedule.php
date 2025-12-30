<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['cinema_id', 'date'];

    protected $casts = [
        'date' => 'date'
    ];

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}
