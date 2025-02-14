<?php

namespace App\Http\Controllers;

use App\Models\Campania;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaniaController extends Controller
{
    public function listado(Request $request){
        return view('campania.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $campanias = Campania::all();
            $valores = [
                'listado' => view('campania.ajaxListado')->with(compact('campanias'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarCampania(Request $request){
        if($request->ajax()){

            $nombre      = $request->input('nombre');
            $fecha_ini   = $request->input('fecha_ini');
            $fecha_fin   = $request->input('fecha_fin');
            $actual      = $request->input('actual');
            $usuario     = Auth::user();

            $campania                     = new Campania();
            $campania->usuario_creador_id = $usuario->id;
            $campania->nombre             = $nombre;
            $campania->fecha_ini          = $fecha_ini;
            $campania->fecha_fin          = $fecha_fin;
            $campania->actual             = $actual;
            $campania->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
