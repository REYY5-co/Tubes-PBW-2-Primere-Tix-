<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'poster',
        'status',
        'year',
        'rating',
        'director',
        'writer',
        'cast',
        'trailer_url',
        'synopsis',
    ];


}

