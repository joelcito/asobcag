<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /* NUEVAS FUNCIONALIDADES */
    public function listado(){
        $roles = Rol::all();
        return view('user.listado')->with(compact(['roles']));
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){

            $usuarios = User::all();
            $valores = [
                'listado' => view('user.ajaxListado')->with(compact('usuarios'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarUsuario(Request $request){
        if($request->ajax()){

            $nombres        = $request->input('nombres');
            $ap_paterno     = $request->input('ap_paterno');
            $ap_materno     = $request->input('ap_materno');
            $cedula        = $request->input('cedula');
            $direccion         = $request->input('direccion');
            $email    = $request->input('email');
            /* $pais    = $request->input('pais');
            $departamento    = $request->input('departamento');
            $provincia    = $request->input('provincia');
            $distrito    = $request->input('distrito'); */
            $celular    = $request->input('celular');
            $rol_id    = $request->input('rol_id');
            $usuarioLoguado = Auth::user();

            $usuario                     = new User();
            $usuario->usuario_creador_id = $usuarioLoguado->id;
            $usuario->nombres            = $nombres;
            $usuario->ap_paterno         = $ap_paterno;
            $usuario->ap_materno         = $ap_materno;
            $usuario->cedula             = $cedula;
            $usuario->direccion          = $direccion;
            $usuario->email              = $email;
            /* $usuario->pais               = $pais;
            $usuario->departamento       = $departamento;
            $usuario->provincia          = $provincia;
            $usuario->distrito           = $distrito; */
            $usuario->celular            = $celular;
            $usuario->rol_id             = $rol_id;                                         //ROL DE Tecnico
            $usuario->name               = $nombres." ".$ap_paterno." ".$ap_materno;
            $usuario->password           = Hash::make($cedula);
            $usuario->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
