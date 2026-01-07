<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Transaction;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Hapus transaksi yang expired tiap hari jam 00:05
        $schedule->call(function () {
            Transaction::where('expired_at', '<', now())->delete();
        })->dailyAt('00:05');

        // Contoh: Auto generate schedule & showtime setiap hari
        $schedule->command('schedule:auto')->dailyAt('00:01');
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];

}
