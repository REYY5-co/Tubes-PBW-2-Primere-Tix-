<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Locale Indonesia
        Carbon::setLocale('id');

        // FIX NGROK + HTTPS (INI PENTING)
        if (app()->environment('local')) {
            URL::forceScheme('https');
        }
    }
}
