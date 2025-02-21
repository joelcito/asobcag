<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CriaderoEjemplarImagen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'criaderos_ejemplares_imagenes';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'criadero_ejemplar_id',
        'ruta',
        'estado',
        'deleted_at'
    ];
}
