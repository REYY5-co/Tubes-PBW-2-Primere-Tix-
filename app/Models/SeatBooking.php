<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatBooking extends Model
{
    protected $fillable = [
        'showtime_id',
        'seat_id'
    ];

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }
}
