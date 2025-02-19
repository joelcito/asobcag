<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empadre extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'empadres';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'padre_id',
        'madre_id',
        'campania_id',
        'tipo_empadre_id',
        'fecha',
        'descripcion',
        'tiempo_copula',
        'observacion',
        'estado',
        'deleted_at'
    ];

    public function madre(){
        return $this->belongsTo('App\Models\Ejemplar', 'madre_id');
    }
}
