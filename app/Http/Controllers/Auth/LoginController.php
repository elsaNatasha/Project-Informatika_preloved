<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login'); // Sesuaikan nama file view Anda
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string', // Validasi untuk kolom username
            'password' => 'required|string', // Validasi untuk password
        ]);

        // Autentikasi user berdasarkan kolom username dan password
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Redirect ke dashboard jika login berhasil
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors(['loginError' => 'Username atau password salah!']);
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
