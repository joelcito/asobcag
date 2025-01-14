<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'departamentos';

    public function departamentosPorIdPais($pais_id)
    {
        return $this->where('pais_id', $pais_id)->get();
    }
}
