<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('homepage');
})->name('homepage'); // ✅ FIX UTAMA

Route::get('/detail-film', function () {
    return view('detail');
})->name('detail-film');

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

Route::get('/film/{slug}', function ($slug) {
    return view('detail', compact('slug'));
})->name('film.detail');

