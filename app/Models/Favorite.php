<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Favorite extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi
    protected $fillable = ['user_id', 'product_id'];

    // Relasi ke model Products
    public function product()
    {
        // Menghubungkan Favorite ke Products
        return $this->belongsTo(Products::class, 'product_id'); // Pastikan ini mengarah ke model Products
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
