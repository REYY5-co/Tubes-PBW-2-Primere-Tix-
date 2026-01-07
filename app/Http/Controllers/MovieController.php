<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Schedule;
use App\Models\Film;
use App\Models\Showtime;
use Carbon\Carbon;

class MovieController extends Controller
{
    // ======================
    // DETAIL FILM
    // ======================
    public function show($slug)
    {
        $film = Film::where('slug', $slug)->firstOrFail();
        return view('detail', compact('film'));
    }

    // ======================
    // JADWAL SEMUA FILM
    // ======================
    public function schedule()
    {
        $lokasi = session('lokasi', 'Bandung');

        $cinema = Cinema::whereHas('location', function ($q) use ($lokasi) {
            $q->where('name', $lokasi);
        })->firstOrFail();

        $today = Carbon::today();
        $dates = collect();

        for ($i = 0; $i < 7; $i++) {
            $date = $today->copy()->addDays($i);

            $schedule = Schedule::firstOrCreate([
                'cinema_id' => $cinema->id,
                'date' => $date->toDateString(),
            ]);

            $dates->push($schedule);
        }

        return view('schedule', compact('cinema', 'dates'));
    }

    // ======================
    // JADWAL PER FILM
    // ======================
    public function jadwalFilm($slug)
    {
        $film = Film::where('slug', $slug)->firstOrFail();

        return view('jadwal', compact('film'));
    }
}
