<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Esquila extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'esquilas';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'ejemplar_id',
        'esquilador_id',
        'fecha',
        'tipo_esquila',
        'inca_esquila',
        'peso_manto',
        'peso_cuello',
        'peso_braga',
        'peso_total',
        'longitud',
        'observacion',
        'estado',
        'deleted_at'
    ];

    public function esquilador(){
        return $this->belongsTo('App\Models\User', 'esquilador_id');
    }

}
