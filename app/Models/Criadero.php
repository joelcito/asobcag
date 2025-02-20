<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Criadero extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'criaderos';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'propietario_id',
        'tecnico_id',
        'pastor_id',
        'localidad_id',
        'nombre',
        'nit',
        'estancia',
        'negocio_fibra',
        'negocio_carne',
        'negocio_animal',
        'estado',
        'deleted_at'
    ];

    public function propietario(){
        return $this->belongsTo('App\Models\User', 'propietario_id');
    }

    public function tecnico(){
        return $this->belongsTo('App\Models\User', 'tecnico_id');
    }

    public function pastor(){
        return $this->belongsTo('App\Models\User', 'pastor_id');
    }
}
