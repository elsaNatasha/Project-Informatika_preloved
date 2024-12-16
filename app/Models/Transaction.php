<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Hanya menerima 'order_id' dan 'payment_proof'
    protected $fillable = ['order_id', 'payment_proof'];

    // Relasi ke model Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}