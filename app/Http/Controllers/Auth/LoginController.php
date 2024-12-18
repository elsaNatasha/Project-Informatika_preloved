<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        // dd(Auth::user());
        return view('auth.login'); // Sesuaikan nama file view Anda

    }

    // Menampilkan halaman login
    // public function showLoginForm()
    // {
    //     return view('auth.login'); // Sesuaikan nama file view Anda
    // }

    // Proses login
    public function login(Request $request)
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
            // Log::info('Login berhasil: ' . Auth::user()->email);
            // Log::info('Apakah user terautentikasi? ' . (Auth::check() ? 'Ya' : 'Tidak'));
            if(Auth::user()->role == 1) {
                return redirect()->route('buyer.products');
            }
            return redirect()->route('admin.products');
        }

        // Jika login gagal
        return back()->withErrors([
            'login' => 'Invalid email or password.',
        ])->withInput();

        // // Validasi input
        // $request->validate([
        //     'username' => 'required|string', // Validasi untuk kolom username
        //     'password' => 'required|string', // Validasi untuk password
        // ]);

        // // Autentikasi user berdasarkan kolom username dan password
        // if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        //     // Redirect ke dashboard jika login berhasil
        //     return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        // }

        // // Jika login gagal, kembali ke halaman login dengan pesan error
        // return back()->withErrors(['loginError' => 'Username atau password salah!']);
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
