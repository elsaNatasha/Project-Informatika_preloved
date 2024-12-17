<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{
    use HasFactory;

    protected $table = 'detail-products';

    protected $fillable = [
        'productname',
        'description',
        'specifications',
        'price',
        'photo',
    ];
}
