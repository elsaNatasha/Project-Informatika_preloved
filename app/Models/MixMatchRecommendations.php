<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MixMatchRecommendations extends Model
{
    use HasFactory;

    protected $fillable = [
        'top_id',
        'bottom_id',
    ];
}
