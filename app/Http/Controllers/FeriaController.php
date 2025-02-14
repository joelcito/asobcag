<?php

namespace App\Http\Controllers;

use App\Models\Feria;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeriaController extends Controller
{
    public function listado(Request $request){
        return view('feria.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $ferias = Feria::all();
            $valores = [
                'listado' => view('feria.ajaxListado')->with(compact('ferias'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarFeria(Request $request){
        if($request->ajax()){

            $nombre     = $request->input('nombre');
            $fecha      = $request->input('fecha');
            $feriascol  = $request->input('feriascol');
            $usuario    = Auth::user();

            $feria                     = new Feria();
            $feria->usuario_creador_id = $usuario->id;
            $feria->nombre             = $nombre;
            $feria->fecha              = $fecha;
            $feria->feriascol          = $feriascol;
            $feria->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
