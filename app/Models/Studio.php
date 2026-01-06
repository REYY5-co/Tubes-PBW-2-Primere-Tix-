<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $table = 'studios'; // 🔥 WAJIB
    protected $fillable = ['cinema_id', 'name'];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }
}
