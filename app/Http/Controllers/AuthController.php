<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLoginForm()
    {
        // dd(Auth::user());
        return view('auth.login'); // Sesuaikan dengan lokasi file view Anda
    }

    /**
     * Tangani proses login
     */
    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // dd(Hash::check($credentials['password'], '$2y$12$RFOknqUAaEcnV/I/f1GG3uVu9zYtYWrwqFLwwpMyq7KpbmCH/9i72'));
        // dd($credentials);
        // Gunakan Auth::attempt() untuk memverifikasi kredensial
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Log::info('Login berhasil: ' . Auth::user()->email);
            Log::info('Apakah user terautentikasi? ' . (Auth::check() ? 'Ya' : 'Tidak'));
            return redirect()->route('products.buyers');
        } else {
            Log::error('Login gagal untuk email: ' . $request->input('email'));
        }

        // Jika login gagal
        return back()->withErrors([
            'login' => 'Invalid email or password.',
        ])->withInput();
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        // dd($request->all());
        Auth::logout();

        $request->session()->invalidate();
        
        return redirect()->route('login')->with('success', 'You have been logged out.');
        // return redirect()->route('/');
    }
}

