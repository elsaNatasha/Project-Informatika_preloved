<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    
    // Menentukan nama tabel yang digunakan (opsional jika mengikuti konvensi Laravel)
    protected $table = 'products';
    
    // Menentukan primary key (opsional jika mengikuti konvensi Laravel)
    protected $primaryKey = 'id';
    
    // Menentukan kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'productname',
        'cat_id',
        'description',
        'price',
        'photo',
    ];

    // Relasi ke Category (sudah ada)
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    // Relasi ke Favorite
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'product_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}
