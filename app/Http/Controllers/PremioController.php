<?php

namespace App\Http\Controllers;

use App\Models\Premio;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PremioController extends Controller
{
    public function listado(Request $request){
        return view('premio.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $premios = Premio::all();
            $valores = [
                'listado' => view('premio.ajaxListado')->with(compact('premios'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarPremio(Request $request){
        if($request->ajax()){

            $request->validate([
                'nombre' => 'required',
            ]);

            $nombre      = $request->input('nombre');
            $usuario     = Auth::user();

            $premio                     = new Premio();
            $premio->usuario_creador_id = $usuario->id;
            $premio->nombre             = $nombre;
            $premio->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
