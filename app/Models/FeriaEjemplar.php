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
        'clasificacion',
        'detalle',
        'estado',
        'deleted_at'
    ];

    public function ejemplar(){
        return $this->belongsTo('App\Models\Ejemplar', 'ejemplar_id');
    }

    public function feria(){
        return $this->belongsTo('App\Models\Feria', 'feria_id');
    }

}
