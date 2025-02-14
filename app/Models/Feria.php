<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feria extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ferias';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'nombre',
        'fecha',
        'feriascol',
        'estado',
        'deleted_at'
    ];
}
