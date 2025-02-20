<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicacion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'medicaciones';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'ejemplar_id',
        'producto_veterinario_id',
        'responsable_id',
        'fecha',
        'tipo',
        'dosis',
        'unidades',
        'observacion',
        'estado',
        'deleted_at'
    ];

    public function ejemplar(){
        return $this->belongsTo('App\Models\Ejemplar', 'ejemplar_id');
    }

    public function responsable(){
        return $this->belongsTo('App\Models\User', 'responsable_id');
    }

    public function productoVeterinario(){
        return $this->belongsTo('App\Models\ProductoVeterinario', 'producto_veterinario_id');
    }
}
