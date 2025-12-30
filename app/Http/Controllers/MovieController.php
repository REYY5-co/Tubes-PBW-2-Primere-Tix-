<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Schedule;
use Carbon\Carbon;
use App\Models\Film;

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

        $schedule = Schedule::where('cinema_id', $cinema->id)
            ->whereDate('date', $date)
            ->first();

        if ($schedule) {
            $dates->push($schedule);
        } else {
            // fallback dummy object
            $dates->push((object) [
                'id' => null,
                'date' => $date
            ]);
        }
    }

    return view('schedule', compact('cinema', 'dates'));
}
}