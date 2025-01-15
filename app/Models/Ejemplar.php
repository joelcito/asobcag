<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ejemplar extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ejemplares';

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
