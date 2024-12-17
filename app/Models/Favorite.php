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
    protected $fillable = ['user_id', 'product_id'];

    // Menonaktifkan auto-increment jika Anda menggunakan UUID atau ID selain integer
    // Jika tidak menggunakan UUID, Anda bisa menghapus bagian ini
    public $incrementing = true;

    // Menentukan tipe primary key jika menggunakan UUID atau selain integer
    protected $keyType = 'int';  // Jika menggunakan integer, ubah ini ke 'int'

    // Kolom primary key (menggunakan 'id' jika tidak pakai UUID)
    protected $primaryKey = 'id'; // Gunakan 'id' jika menggunakan ID integer

    // Jika tabel menggunakan hanya `created_at` tanpa `updated_at`
    public $timestamps = true;

    // Relasi ke model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

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
