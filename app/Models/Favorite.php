<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi
    protected $fillable = ['user_id', 'product_id'];

    // Jika tabel menggunakan hanya `created_at` tanpa `updated_at`
    public $timestamps = false;

    // Konfigurasi nama kolom timestamp (opsional)
    const CREATED_AT = 'created_at';

    // Relasi ke model Products
    public function product()
    {
        // Menghubungkan Favorite ke Products
        return $this->belongsTo(Product::class, 'product_id'); 
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
