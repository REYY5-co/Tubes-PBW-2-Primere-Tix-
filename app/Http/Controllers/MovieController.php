<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Schedule;
use Carbon\Carbon;
use App\Models\Film;
use App\Models\Showtime;

class MovieController extends Controller
{
    public function jadwal($slug)
{
    $film = Film::where('slug', $slug)->firstOrFail();

    return view('jadwal', compact('film'));
}
    public function schedule()
{
    $lokasi = session('lokasi', 'Bandung');

    $cinema = Cinema::whereHas('location', function ($q) use ($lokasi) {
        $q->where('name', $lokasi);
    })->firstOrFail();

    $today = Carbon::today();
    $dates = collect();

    // ✅ SELALU 7 HARI
    for ($i = 0; $i < 7; $i++) {
    $date = $today->copy()->addDays($i);

    $schedule = Schedule::firstOrCreate(
        [
            'cinema_id' => $cinema->id,
            'date' => $date->toDateString(),
        ]
    );

    // auto generate jam tayang kalau belum ada
    if ($schedule->showtimes()->count() === 0) {
        $times = ['12:00:00', '18:00:00'];

        foreach ($times as $time) {
            Showtime::create([
                'schedule_id' => $schedule->id,
                'time'        => $time,
                'film_id'     => 3, // ⚠️ ganti sesuai film aktif
                'studio_id'   => 1
            ]);
        }
    }

    $dates->push($schedule);
}

    return view('schedule', compact('cinema', 'dates'));
}
}