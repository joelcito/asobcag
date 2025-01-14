<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolController extends Controller
{

    public function listado(Request $request){
        return view('rol.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $roles = Rol::all();
            $valores = [
                'listado' => view('rol.ajaxListado')->with(compact('roles'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarRol(Request $request){
        if($request->ajax()){

            $nombre      = $request->input('nombre');
            $usuario     = Auth::user();

            $rol                     = new Rol();
            $rol->usuario_creador_id = $usuario->id;
            $rol->nombre             = $nombre;
            $rol->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

}
