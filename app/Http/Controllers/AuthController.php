<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50'
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            if(Auth::user()->role == 'murid') return redirect('/lab');
            return redirect('/dashboard');
        }

        return back()->with('failed', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // keluar dari sesi user
        $request->session()->invalidate(); // hapus session
        $request->session()->regenerateToken(); // buat token baru (biar aman dari CSRF)
        
        return redirect('/login')->with('success', 'Berhasil logout');
    }
}
