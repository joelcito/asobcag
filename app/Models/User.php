<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
        'rol_id',
        'localidad_id',
        'nombres',
        'ap_paterno',
        'ap_materno',
        'cedula',
        'direccion',
        'celular',
        'estado',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function listaUsuarios($tipo){
        return $this->where('rol_id',$tipo)->get();
    }

    /**
     * Devuelve el identificador que se almacenará en el JWT.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Devuelve una lista de claims personalizados agregados al JWT.
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function rol(){
        return $this->belongsTo('App\Models\Rol', 'rol_id');
    }
}
