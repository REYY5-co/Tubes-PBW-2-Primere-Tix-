<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cinema;
use App\Models\Studio;
use App\Models\Schedule;
use App\Models\Showtime;
use Carbon\Carbon;

class AutoGenerateSchedules extends Command
{
    protected $signature = 'schedule:auto';
    protected $description = 'Auto generate schedules & showtimes (FINAL FIX)';

    public function handle()
    {
        $cinemas = Cinema::all();

        foreach ($cinemas as $cinema) {

            // 🔥 hapus schedule yang sudah lewat (beserta showtime via FK / cascade)
            Schedule::where('cinema_id', $cinema->id)
                ->where('date', '<', Carbon::today())
                ->delete();

            // ambil studio milik cinema (urut)
            $studios = Studio::where('cinema_id', $cinema->id)
                ->orderBy('id')
                ->get();

            // wajib minimal 2 studio
            if ($studios->count() < 2) {
                $this->warn("Cinema {$cinema->id} skipped (studio < 2)");
                continue;
            }

            // mapping jam → studio
            $mapping = [
                '12:00:00' => $studios[0]->id, // studio 1
                '18:00:00' => $studios[1]->id, // studio 2
            ];

            // generate 7 hari ke depan
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::today()->addDays($i);

                $schedule = Schedule::firstOrCreate([
                    'cinema_id' => $cinema->id,
                    'date'      => $date,
                ]);

                foreach ($mapping as $time => $studioId) {

                    // ✅ UPDATE-OR-CREATE (BUKAN firstOrCreate)
                    Showtime::updateOrCreate(
                        [
                            'schedule_id' => $schedule->id,
                            'time'        => $time,
                        ],
                        [
                            'studio_id'   => $studioId,
                        ]
                    );
                }
            }
        }

        $this->info('Schedules & showtimes GENERATED CORRECTLY (FINAL).');
    }
}
