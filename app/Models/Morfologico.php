<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Morfologico extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'morfologicos';
    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'ejemplar_id',
        'evaluador_id',
        'motivo',
        'fecha_evaluacion',
        'oreja',
        'cuello',
        'cabeza',
        'alzada',
        'largo_cuerpo',
        'amplitud_pecho',
        'fortaleza',
        'balance',
        'canias',
        'copete',
        'linea_superior',
        'grupa',
        'densidad',
        'rizo',
        'calce',
        'estado',
        'deleted_at'
    ];

    public function evaluador(){
        return $this->belongsTo('App\Models\User', 'evaluador_id');
    }

    public function ejemplar(){
        return $this->belongsTo('App\Models\Ejemplar', 'ejemplar_id');
    }
}
