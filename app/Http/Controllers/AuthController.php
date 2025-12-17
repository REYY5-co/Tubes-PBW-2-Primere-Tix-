<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        // 1️⃣ Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha_input' => 'required'
        ]);

        // 2️⃣ Validasi CAPTCHA
        if ($request->captcha_input != session('captcha')) {
            return back()->withErrors([
                'captcha' => 'Captcha salah'
            ])->withInput();
        }

        // 3️⃣ Coba login
        $credentials = $request->only('email', 'password');

        // ✅ BAGIAN INI DIGANTI
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('homepage');
        }

        // 4️⃣ Gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah'
        ])->withInput();
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user'
        ]);

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
