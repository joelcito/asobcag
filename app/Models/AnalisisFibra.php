<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnalisisFibra extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'analisis_fibras';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'ejemplar_id',
        'laboratorio_id',
        'equipo_id',
        'fecha_muestreo',
        'fecha_analisis',
        'zona_corporal',
        'fd',
        'sd',
        'cv',
        'fc',
        'pm',
        'mfd',
        'laboratorio',
        'estado',
        'deleted_at'
    ];
}
