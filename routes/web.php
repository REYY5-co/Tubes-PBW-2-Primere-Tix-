<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AdminFilmController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/jadwal', [MovieController::class, 'schedule'])->name('jadwal');

/* DETAIL FILM (PAKAI CONTROLLER, JANGAN CLOSURE) */
Route::get('/film/{slug}', [MovieController::class, 'show'])
    ->name('film.detail');

/*
|--------------------------------------------------------------------------
| SESSION BIOSKOP
|--------------------------------------------------------------------------
*/
Route::get('/set-lokasi/{lokasi}', function ($lokasi) {
    session(['lokasi' => $lokasi]);
    return back();
})->name('set.lokasi');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost']);

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/captcha', [AuthController::class, 'captcha']);

/*
|--------------------------------------------------------------------------
| BOOKING
|--------------------------------------------------------------------------
*/
Route::get('/ajax/showtimes/{schedule}', [BookingController::class, 'getShowtimes'])
    ->name('ajax.showtimes');

Route::get('/seats/{showtime}', [BookingController::class, 'seats'])
    ->name('seats');

Route::post('/book-seat', [BookingController::class, 'bookSeat'])
    ->name('book.seat');

/*
|--------------------------------------------------------------------------
| PAYMENT
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/payment', [PaymentController::class, 'showPaymentPage'])
        ->name('payment');

    Route::post('/payment/process', [PaymentController::class, 'processPayment'])
        ->name('payment.process');

    Route::get('/payment/status', [PaymentController::class, 'paymentFinish'])
        ->name('payment.status');
});

/*
|--------------------------------------------------------------------------
| USER ACCOUNT
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/akun', [ProfileController::class, 'index'])->name('akun');
    Route::get('/akun/edit', [ProfileController::class, 'edit'])->name('akun.edit');
    Route::post('/akun/update', [ProfileController::class, 'update'])->name('akun.update');
    Route::post('/akun/password', [ProfileController::class, 'changePassword'])->name('akun.password');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('films', AdminFilmController::class);
    });


Route::get('/captcha', [AuthController::class, 'captcha']);