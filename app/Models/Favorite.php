<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Favorite extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'id_favorite',
        'id_user',
        'id_produk',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

<<<<<<< HEAD
    // Relasi ke model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}
=======
    // Jika id_favorite bukan tipe auto-increment, tambahkan properti ini:
    public $incrementing = false;

    // Jika id_favorite bukan integer, tambahkan properti ini:
    protected $keyType = 'string';
}
>>>>>>> 48e3fe536c935bc5684eaa36caa0ead0263a5f01
