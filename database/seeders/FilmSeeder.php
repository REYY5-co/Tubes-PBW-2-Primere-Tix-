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
                'title' => 'AVATAR: FIRE AND ASH',
                'slug' => 'avatar',
                'poster' => 'films/avatar2.jpg',
                'status' => 'now_showing',
                'year' => 2025,
            ],

            [
                'title' => 'ZOOTOPIA 2',
                'slug' => 'zootopia',
                'poster' => 'films/image 55.jpeg',
                'status' => 'now_showing',
                'year' => 2025,
            ],

            // ================= NEXT WEEK =================

            [
                'title' => 'AGAK LAEN 2: MENYALA PANTIKU!',
                'slug' => 'agakLaen',
                'poster' => 'films/agaklaen.jpg',
                'status' => 'next_week',
                'year' => 2025,
            ],

            [
                'title' => 'JUJUTSU KAISEN: SHIBUYA INCIDENT X THE CULLING GAME',
                'slug' => 'jujutsuKaisen',
                'poster' => 'films/images 98.jpg',
                'status' => 'next_week',
                'year' => 2025,
            ],

            [
                'title' => 'THE MEDIUM',
                'slug' => 'theMedium',
                'poster' => 'films/images 12.jpg',
                'status' => 'next_week',
                'year' => 2025,
            ],

            [
                'title' => 'PATAH HATI YANG KUPILIH',
                'slug' => 'patahHAti',
                'poster' => 'films/image 77.jpg',
                'status' => 'next_week',
                'year' => 2025,
            ],

            [
                'title' => 'REMINDERS OF HIM',
                'slug' => 'reminder',
                'poster' => 'films/remindersofhim.jpg',
                'status' => 'next_week',
                'year' => 2025,
            ],

            [
                'title' => 'QORIN',
                'slug' => 'qorin',
                'poster' => 'films/qorin.jpg',
                'status' => 'next_week',
                'year' => 2025,
            ],

            [
                'title' => "LEE CRONIN'S THE MUMMY",
                'slug' => 'mummy',
                'poster' => 'films/mummy.jpg',
                'status' => 'next_week',
                'year' => 2025,
            ],




            // ================= COMING SOON =================
            [
                'title' => '20TH CENTURY GIRL',
                'slug' => 'century',
                'poster' => 'films/centurygirl.jpg',
                'status' => 'coming_soon',
                'year' => 2026,
            ],
            [
                'title' => 'AVENGERS: DOOMSDAY',
                'slug' => 'avengers-doomsday',
                'poster' => 'films/avenger.webp',
                'status' => 'coming_soon',
                'year' => 2026,
            ],

            [
                'title' => 'MINIONS 3',
                'slug' => 'minions3',
                'poster' => 'films/minions3.jpg',
                'status' => 'coming_soon',
                'year' => 2026,
            ],

            [
                'title' => '18x2 Beyond Youthful DAYS',
                'slug' => '18x2',
                'poster' => 'films/jimmy.jpg',
                'status' => 'coming_soon',
                'year' => 2026,
            ],

            [
                'title' => 'AVATAR: THE LAST AIRBENDER',
                'slug' => 'avatarthelast',
                'poster' => 'films/avatar.webp',
                'status' => 'coming_soon',
                'year' => 2026,
            ],

        ];

        foreach ($films as $film) {
            Film::updateOrCreate(
                ['slug' => $film['slug']],
                $film
            );
        }
    }
}
