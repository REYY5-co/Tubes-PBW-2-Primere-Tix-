<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;

class FilmSeeder extends Seeder
{
    public function run(): void
    {
        $films = [

            // ================= NOW SHOWING =================
            [
                'title' => 'DILAN 1990',
                'slug' => 'dilan-1990',
                'poster' => 'films/dilan.png',
                'status' => 'now_showing',
                'year' => 2018,
            ],
            [
                'title' => 'SUPERMAN',
                'slug' => 'superman',
                'poster' => 'films/superman.png',
                'status' => 'now_showing',
                'year' => 2025,
            ],
            [
                'title' => 'JUMBO',
                'slug' => 'jumbo',
                'poster' => 'films/jumbo.jpg',
                'status' => 'now_showing',
                'year' => 2025,
            ],

            [
                'title' => 'AVATAR',
                'slug' => 'avatar',
                'poster' => 'films/avatar2.jpg',
                'status' => 'now_showing',
                'year' => 2025,
            ],



            // ================= COMING SOON =================
            [
                'title' => 'ZOOTOPIA 2',
                'slug' => 'zootopia-2',
                'poster' => 'films/zootopia2.jpg',
                'status' => 'coming_soon',
                'year' => 2026,
            ],
            [
                'title' => 'AVENGERS: DOOMSDAY',
                'slug' => 'avengers-doomsday',
                'poster' => 'films/avengers.jpg',
                'status' => 'coming_soon',
                'year' => 2026,
            ],
        ];

        foreach ($films as $film) {
            Film::updateOrCreate(
                ['slug' => $film['slug']], // kunci unik
                $film
            );
        }
    }
}
