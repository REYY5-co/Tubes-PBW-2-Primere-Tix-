<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Showtime;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * HALAMAN KURSI
     * WAJIB lewat alur pilih lokasi → tanggal → jam
     */
  public function seats($showtimeId)
{
    $showtime = Showtime::with([
        'studio',
        'schedule.cinema'
    ])->find($showtimeId);

    if (!$showtime) {
        abort(404);
    }

    if (!$showtime->studio || !$showtime->schedule) {
        abort(404);
    }

    $date = $showtime->schedule->date;
    $datetime = \Carbon\Carbon::parse(
        $date->format('Y-m-d') . ' ' . $showtime->time
    );

    // ❌ tanggal lewat
    if ($date->isPast() && !$date->isToday()) {
        abort(404);
    }

    // ❌ jam lewat hari ini
    if ($date->isToday() && $datetime->isPast()) {
        abort(404);
    }

    return view('seat', compact('showtime'));
}


    /**
     * AJAX: ambil jam tayang berdasarkan schedule
     * HANYA READ DATA
     */
    public function getShowtimes($scheduleId)
    {
        $schedule = Schedule::with('showtimes.studio')->find($scheduleId);

        if (!$schedule) {
            return response()->json([]);
        }

        $now = now();

        $showtimes = $schedule->showtimes
            ->sortBy('time')
            ->values()
            ->map(function ($showtime) use ($schedule, $now) {

                // ❌ skip showtime rusak
                if (!$showtime->studio) {
                    return null;
                }

                $datetime = Carbon::parse(
                    $schedule->date->format('Y-m-d') . ' ' . $showtime->time
                );

                $showtime->is_locked =
                    $schedule->date->isToday() && $datetime->lt($now);

                return $showtime;
            })
            ->filter() // hapus null
            ->values();

        return response()->json($showtimes);
    }
}
