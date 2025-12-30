<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/
Route::get('/homepage', [HomeController::class, 'index'])->name('homepage');

/* Jadwal Film */
Route::get('/jadwal', [MovieController::class, 'schedule'])->name('jadwal');

/* Detail Film */


Route::get('/film/{slug}', function ($slug) {
    return view('detail', compact('slug'));
})->name('film.detail');

/*
|--------------------------------------------------------------------------
| LOKASI BIOSKOP (SESSION)
|--------------------------------------------------------------------------
*/
Route::get('/set-lokasi/{lokasi}', function ($lokasi) {
    session(['lokasi' => $lokasi]);
    return redirect()->back();
})->name('set.lokasi');

/*
|--------------------------------------------------------------------------
| CAPTCHA
|--------------------------------------------------------------------------
*/
Route::get('/captcha', function () {
    $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    $captcha = '';

    for ($i = 0; $i < 5; $i++) {
        $captcha .= $characters[rand(0, strlen($characters) - 1)];
    }

    session(['captcha' => $captcha]);

    return response()->json([
        'captcha' => $captcha
    ]);
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| BOOKING FLOW
|--------------------------------------------------------------------------
*/
/* AJAX */
Route::get('/ajax/showtimes/{schedule}', [BookingController::class, 'getShowtimes'])
    ->name('ajax.showtimes');

/* Seats & Booking */
Route::get('/seats/{showtime}', [BookingController::class, 'seats'])
    ->name('seats');

Route::post('/book-seat', [BookingController::class, 'bookSeat'])
    ->name('book.seat');

/*
|--------------------------------------------------------------------------
| USER ACCOUNT
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/akun', [ProfileController::class, 'index'])->name('akun');
    Route::get('/akun/edit', [ProfileController::class, 'edit'])->name('akun.edit');
    Route::post('/akun/update', [ProfileController::class, 'update'])->name('akun.update');
    Route::post('/akun/password', [ProfileController::class, 'changePassword'])
        ->name('akun.password');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::get('/jadwal/{slug}', [FilmController::class, 'jadwal'])
    ->name('film.jadwal');
