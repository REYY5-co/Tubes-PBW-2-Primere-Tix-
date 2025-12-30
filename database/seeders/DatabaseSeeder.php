<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;

// Models
use App\Models\User;
use App\Models\Location;
use App\Models\Cinema;
use App\Models\Schedule;
use App\Models\Showtime;
use App\Models\Seat;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* ================= USER ================= */
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        /* ================= FILM ================= */
        $this->call([
            FilmSeeder::class,
        ]);

        /* ================= DATA BIOSKOP ================= */
        $data = [
            'Bandung'   => 'Braga PRIME TIX',
            'Jakarta'   => 'AERON MALL PRIME TIX',
            'Surabaya'  => 'BG JUNCTION PRIME TIX',
        ];

        foreach ($data as $city => $cinemaName) {

            // Lokasi
            $location = Location::create([
                'name' => $city
            ]);

            // Bioskop
            $cinema = Cinema::create([
                'location_id' => $location->id,
                'name' => $cinemaName
            ]);

            // Jadwal 7 hari
            for ($day = 0; $day < 7; $day++) {

                $schedule = Schedule::create([
                    'cinema_id' => $cinema->id,
                    'date' => Carbon::today()->addDays($day)
                ]);

                // Jam tayang
                foreach (['12:00', '16:00'] as $time) {

                    $showtime = Showtime::create([
                        'schedule_id' => $schedule->id,
                        'time' => $time
                    ]);

                    // Kursi (6 kursi)
                    for ($seat = 1; $seat <= 6; $seat++) {
                        Seat::create([
                            'showtime_id' => $showtime->id,
                            'seat_number' => $seat,
                            'is_booked' => false
                        ]);
                    }
                }
            }
        }
    }
}
