<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provincia extends Model
{
    use HasFactory, SoftDeletes;

    public function provinciasPorIdDepartamento($departamento_id){
        return $this->where('departamento_id', $departamento_id)->get();
    }

    public function departamento(){
        return $this->belongsTo('App\Models\Departamento', 'departamento_id');
    }
}
