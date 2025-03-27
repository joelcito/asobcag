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
        'localidad_id',
        'categoria_feria_id',
        'premio_id',
        'juez_principal_id',
        'juez_adjunto_id',
        'nombre',
        'fecha',
        'nacional',
        'departamental',
        'municipal',
        'tipo',
        'estado',
        'deleted_at'
    ];

    public function categoriaFeria(){
        return $this->belongsTo('App\Models\CategoriaFeria', 'categoria_feria_id');
    }

    public function premio(){
        return $this->belongsTo('App\Models\Premio', 'premio_id');
    }

    public function juezPrincipal(){
        return $this->belongsTo('App\Models\User', 'juez_principal_id');
    }

    public function juezAdjunto(){
        return $this->belongsTo('App\Models\User', 'juez_adjunto_id');
    }

    public function feriaEjemplar(){
        return $this->hasMany(FeriaEjemplar::class);
    }
}
