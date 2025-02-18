<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeriaEjemplar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'feria_ejemplares';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'ejemplar_id',
        'feria_id',
        'categoria_feria_id',
        'premio_id',
        'juez_principal_id',
        'juez_adjunto_id',
        'estado',
        'deleted_at'
    ];
}
