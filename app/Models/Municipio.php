<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipio extends Model
{
    use HasFactory, SoftDeletes;

    public function municipiosPorIdProvincia($provincia_id){
        return $this->where('provincia_id', $provincia_id)->get();
    }

    public function provincia(){
        return $this->belongsTo('App\Models\Provincia', 'provincia_id');
    }

}
