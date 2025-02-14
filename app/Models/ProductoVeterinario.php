<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductoVeterinario extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'producto_veterinarios';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'nombre',
        'ingrediente_activo',
        'presentacion',
        'estado',
        'deleted_at'
    ];
}
