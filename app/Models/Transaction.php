<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'showtime_id',
        'order_id',
        'total_price',
        'selected_seats',
        'status',
        'paid_at',
        'expired_at',
    ];

    protected $casts = [
        'selected_seats' => 'array',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
