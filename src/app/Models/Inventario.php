<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_explorador',
        'Nome',
        'Valor',
        'Latitude',
        'Longetude',
    ];
    
    public function explorador(){
        return $this->belongsTo(Explorador::class);
    }
}

