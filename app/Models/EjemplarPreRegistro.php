<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EjemplarPreRegistro extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ejemplar_pre_registros';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',

        'ejemplar_id',
        'fenotipo_id',
        'color_id',
        'criadero_id',
        'padre_id',
        'madre_id',

        'tipo',
        'numero_registro',
        'microchip',
        'nombre',
        'arete',
        'sexo',
        'fecha_nacimiento',
        'fecha_registro',
        'tipo_parto',
        'texto_reconocido',

        'estado',
        'deleted_at'
    ];
}
