<?php

namespace App\Http\Controllers;

use App\Models\Metodo;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetodoController extends Controller
{
    public function listado(Request $request){
        return view('metodo.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $metodos = Metodo::all();
            $valores = [
                'listado' => view('metodo.ajaxListado')->with(compact('metodos'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarMetodo(Request $request){
        if($request->ajax()){

            $nombre      = $request->input('nombre');
            $usuario     = Auth::user();

            $metodo                     = new Metodo();
            $metodo->usuario_creador_id = $usuario->id;
            $metodo->nombre             = $nombre;
            $metodo->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
