<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campania extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'campanias';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'nombre',
        'fecha_ini',
        'fecha_fin',
        'actual',
        'estado',
        'deleted_at'
    ];
}
