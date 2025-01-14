<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comunidad extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'comunidades';

    public function comunidadesPorIdMunicipio($municipio_id)
    {
        return $this->where('municipio_id', $municipio_id)->get();
    }

    public function municipio(){
        return $this->belongsTo('App\Models\Municipio', 'municipio_id');
    }
}
