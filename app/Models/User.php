<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',   // Pastikan 'username' ada dalam fillable
        'phone',      // Menambahkan phone
        'address',    // Menambahkan address
        'role',    
        'remember_token' // Menambahkan remember_token jika menggunakan fitur "remember me"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Menentukan kolom yang digunakan untuk login (gunakan 'username' sebagai pengganti 'email').
     *
     * @return string
     */
   // public function username()
    //{
     //   return 'username'; // Menggunakan 'username' untuk login
   // }

    /**
     * Mutator untuk mengenkripsi password.
     */
    // public function setPasswordAttribute($value)
    // {
    //     // Enkripsi password jika ada perubahan
    //     $this->attributes['password'] = bcrypt($value);
    // }
}
