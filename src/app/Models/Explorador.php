<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explorador extends Model
{
    use HasFactory;

    protected $table="explorador";

    protected $fillable = [
        'id_explorador',
        'Nome',
        'Idade',
        'Latitude',
        'Longitude'
    ];

    public function inventario(){
        return $this->hasMany(Itens::class,'id_explorador');
    }
}
