<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;

/* PUBLIC */
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/jadwal', [MovieController::class, 'schedule'])->name('jadwal');

Route::get('/film/{slug}', function ($slug) {
    return view('detail', compact('slug'));
})->name('film.detail');

/* SESSION BIOSKOP */
Route::get('/set-lokasi/{lokasi}', function ($lokasi) {
    session(['lokasi' => $lokasi]);
    return redirect()->back();
})->name('set.lokasi');

/* AUTH */
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* BOOKING FLOW */
Route::get('/ajax/showtimes/{schedule}', [BookingController::class, 'getShowtimes'])
    ->name('ajax.showtimes');

Route::get('/seats/{showtime}', [BookingController::class, 'seats'])
    ->name('seats');

Route::post('/book-seat', [BookingController::class, 'bookSeat'])
    ->name('book.seat');

/* SEATS */
Route::get('/seats/{showtime}', [BookingController::class, 'seats'])
    ->name('seats');

/* PAYMENT */
Route::get('/payment', [PaymentController::class, 'showPaymentPage'])
    ->name('payment');

Route::post('/payment/process', [PaymentController::class, 'processPayment'])
    ->name('payment.process')
    ->middleware('auth');

Route::get('/payment/status', [PaymentController::class, 'paymentFinish'])
    ->name('payment.status')
    ->middleware('auth');

/* USER ACCOUNT */
Route::middleware('auth')->group(function () {
    Route::get('/akun', [ProfileController::class, 'index'])->name('akun');
    Route::get('/akun/edit', [ProfileController::class, 'edit'])->name('akun.edit');
    Route::post('/akun/update', [ProfileController::class, 'update'])->name('akun.update');
    Route::post('/akun/password', [ProfileController::class, 'changePassword'])->name('akun.password');
});

/* ADMIN */
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::get('/captcha', [AuthController::class, 'captcha']);
