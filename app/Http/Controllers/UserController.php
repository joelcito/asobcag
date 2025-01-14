<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function listadoPropietario(Request $request){
        return view('user.listadoPropietario');
    }

    public function ajaxListadoPropietario(Request $request){
        if($request->ajax()){

            $id_propietario = 2;
            $usuario        = new User();

            $propietarios = $usuario->listaUsuarios($id_propietario);
            $valores = [
                'listado' => view('user.ajaxListadoPropietario')->with(compact('propietarios'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarPropietario(Request $request){
        if($request->ajax()){

            $nombres        = $request->input('nombres');
            $ap_paterno     = $request->input('ap_paterno');
            $ap_materno     = $request->input('ap_materno');
            $celular        = $request->input('celular');
            $correo         = $request->input('correo');
            $contrasenia    = $request->input('contrasenia');
            $usuarioLoguado = Auth::user();

            $usuario                     = new User();
            $usuario->usuario_creador_id = $usuarioLoguado->id;
            $usuario->nombres            = $nombres;
            $usuario->ap_paterno         = $ap_paterno;
            $usuario->ap_materno         = $ap_materno;
            $usuario->numero_celular     = $celular;
            $usuario->email              = $correo;
            $usuario->password           = $contrasenia;
            $usuario->rol_id             = 2;                                         //ROL DE PROPIETARIO
            $usuario->name               = $nombres." ".$ap_paterno." ".$ap_materno;
            $usuario->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
