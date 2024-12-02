<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(user::class);
    }

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
