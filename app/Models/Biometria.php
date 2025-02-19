<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Biometria extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'biometrias';
    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'ejemplar_id',
        'evaluador_id',
        'motivo',
        'fecha',
        'peso',
        'altura_cruz',
        'altura_grupa',
        'altura_cabeza',
        'ancho_pecho',
        'ancho_isquiones',
        'perimetro_toraxico',
        'perimetro_abdominal',
        'largo_cuello',
        'cuello_perimetro_sup',
        'cuello_perimetro_inf',
        'largo_oreja',
        'largo_cola',
        'largo_cuerpo',
        'diametro_cania_ant',
        'diametro_cania_post',
        'estado',
        'deleted_at'
    ];

    public function evaluador(){
        return $this->belongsTo('App\Models\User', 'evaluador_id');
    }
}
