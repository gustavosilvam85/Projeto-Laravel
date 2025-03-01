<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itens extends Model
{
    use HasFactory;

    protected $table="itens";

    protected $fillable = [
        'id_explorador',
        'NomeItem',
        'Valor',
        'Latitude',
        'Longitude'
    ];
}
