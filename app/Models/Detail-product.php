<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail-product extends Model
{
    use HasFactory;
    //atribut yang dapat diisi secara massal (mass assignment)
    protected $fillable = ['productname', 'description', 'price', 'photo'];
    
    // Relasi ke Product
    public function products()
    {
        return $this->hasOne(DetailProduct::class, 'product_id');  // 'product_id' adalah foreign key di tabel detail_products
    }

}
