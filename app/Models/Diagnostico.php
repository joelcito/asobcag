<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diagnostico extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'diagnosticos';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'empadre_id',
        'metodo_id',
        'supervisor_id',
        'fecha',
        'diagnostico',
        'estado',
        'deleted_at'
    ];

    public function empadre(){
        return $this->belongsTo('App\Models\Empadre', 'empadre_id');
    }
}
