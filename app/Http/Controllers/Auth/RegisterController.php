<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Menampilkan form registrasi.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Menangani proses registrasi pengguna baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // dd(trim($request->all()['password']));
        // Validasi input yang diterima dari pengguna
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email', // Pastikan email unik
            'phone' => 'required|string|max:15', // Nomor telepon
            'address' => 'required|string|max:255', // Alamat
            'username' => 'required|string|max:255|unique:users,username', // Pastikan username unik
            'password' => 'required|string|min:8|confirmed', // Password minimal 8 karakter dan cocok dengan konfirmasi password
        ]);

        // Membuat pengguna baru di database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'username' => $request->username,
            'role' => 1,
            'password' => Hash::make($request->password), // Menggunakan hashing untuk password
        ]);

        // Setelah berhasil, redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }
}