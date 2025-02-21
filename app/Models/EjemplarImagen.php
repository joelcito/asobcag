<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EjemplarImagen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ejemplar_imagenes';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'ejemplar_id',
        'ruta',
        'estado',
        'deleted_at'
    ];
}
