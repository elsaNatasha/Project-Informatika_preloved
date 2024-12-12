<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'productname',
        'cat_id',
        'description',
        'price',
        'photo'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'cat_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}