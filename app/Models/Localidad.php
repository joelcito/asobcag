<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localidad extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'localidades';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'superior_id',
        'nombre',
        'estado',
        'deleted_at'
    ];

    public function localidadesHijo(){
        return $this->hasMany(Localidad::class, 'superior_id');
    }

}
