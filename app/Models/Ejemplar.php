<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ejemplar extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ejemplares';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'raza_id',
        'fenotipo_id',
        'categoria_id',
        'color_id',
        'criadero_id',
        'nombre',
        'sexo',
        'fecha_nacimiento',
        'numero_registro',
        'microchip',
        'arete',
        'fecha_registro',
        'ejemplarescol',
        'estado',
        'deleted_at'
    ];

    public function color(){
        return $this->belongsTo('App\Models\Color', 'color_id');
    }

    public function fenotipo(){
        return $this->belongsTo('App\Models\Fenotipo', 'fenotipo_id');
    }

}
