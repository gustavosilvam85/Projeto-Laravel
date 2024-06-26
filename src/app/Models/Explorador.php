<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explorador extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nome',
        'Idade',
        'Latitude',
        'Longetude'
    ];
}
