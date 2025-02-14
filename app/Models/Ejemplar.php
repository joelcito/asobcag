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

    public function sacarCorrelativoRegsitro(){
        $datos = $this->orderBy('numero_registro', 'desc')->first();
        return $datos ? $datos->numero_registro + 1 : 1;
    }

    public function propietario(){
        return $this->belongsTo('App\Models\User', 'propietario_id');
    }

    public function raza(){
        return $this->belongsTo('App\Models\Raza', 'raza_id');
    }

    public function comunidad(){
        return $this->belongsTo('App\Models\Comunidad', 'comunidad_id');
    }
    public function padre(){
        return $this->belongsTo('App\Models\Ejemplar', 'padre_id');
    }
    public function madre(){
        return $this->belongsTo('App\Models\Ejemplar', 'madre_id');
    }
}
