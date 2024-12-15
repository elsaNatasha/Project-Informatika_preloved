<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional jika nama tabel bukan jamak dari model)
    protected $table = 'favorites';

    // Kolom yang dapat diisi secara massal
    protected $fillable = ['id_favorite', 'user_id', 'product_id'];

    // Menonaktifkan auto-increment karena id_favorite tidak menggunakan integer
    public $incrementing = false;

    // Menentukan tipe primary key sebagai string
    protected $keyType = 'string';

    // Kolom primary key
    protected $primaryKey = 'id_favorite';

    // Jika tabel menggunakan hanya `created_at` tanpa `updated_at`
    public $timestamps = false;

    // Konfigurasi nama kolom timestamp (opsional)
    const CREATED_AT = 'created_at';

    // Relasi ke model Products
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); 
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
