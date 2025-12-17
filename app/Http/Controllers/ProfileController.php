<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('akun.index', [
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('akun.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Jika upload avatar baru
        if ($request->hasFile('avatar')) {

            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Simpan avatar baru
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // Update data profil
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success_profile', 'Profil berhasil diperbarui');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password'     => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors([
                'old_password' => 'Password lama salah'
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success_password', 'Password berhasil diubah');
    }
}
