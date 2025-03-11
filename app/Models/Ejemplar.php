<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ejemplar extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ejemplares';

    protected $fillable = [
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'raza_id',
        'fenotipo_id',
        'categoria_id',
        'color_id',
        'criadero_id',
        'nombre',
        'sexo',
        'fecha_nacimiento',
        'tipo_parto',
        'numero_registro',
        'microchip',
        'arete',
        'fecha_registro',
        'tipo',
        'estado',
        'deleted_at'
    ];

    public function color(){
        return $this->belongsTo('App\Models\Color', 'color_id');
    }

    public function fenotipo(){
        return $this->belongsTo('App\Models\Fenotipo', 'fenotipo_id');
    }

    public function raza(){
        return $this->belongsTo('App\Models\Raza', 'raza_id');
    }

    public function criadero(){
        return $this->belongsTo('App\Models\Criadero', 'criadero_id');
    }

    public function padre(){
        return $this->belongsTo('App\Models\Ejemplar', 'padre_id');
    }

    public function madre(){
        return $this->belongsTo('App\Models\Ejemplar', 'madre_id');
    }

    public function imagenes(){
        return $this->hasMany(EjemplarImagen::class);
    }

    public function biometrias(){
        return $this->hasMany(Biometria::class);
    }

    public function morfologicos(){
        return $this->hasMany(Morfologico::class);
    }

    public function esquilas(){
        return $this->hasMany(Esquila::class);
    }

    public function medicaciones(){
        return $this->hasMany(Medicacion::class);
    }

    public static function visualizarEjemplar($ejmplar_id){
        $ejemplar = null;
        if($ejmplar_id){
            $ejemplar = Ejemplar::find($ejmplar_id);
            echo $ejemplar->nombre."<br>";
            echo $ejemplar->arete;
        }

        return $ejemplar;
    }
}
