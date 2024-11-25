<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi
    protected $fillable = ['id_favorite'];

    // Mengganti primary key dengan 'id_favorite'
    protected $primaryKey = 'id_favorite';

    // Jika id_favorite bukan tipe auto-increment, tambahkan properti ini:
    public $incrementing = false;

    // Jika id_favorite bukan integer, tambahkan properti ini:
    protected $keyType = 'string';
}
