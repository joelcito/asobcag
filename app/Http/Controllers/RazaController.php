<?php

namespace App\Http\Controllers;

use App\Models\Raza;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RazaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listado(Request $request){
        return view('raza.listado');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ajaxListado(Request $request){
        if($request->ajax()){
            $razas = Raza::all();
            $valores = [
                'listado' => view('raza.ajaxListado')->with(compact('razas'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function guardarRaza(Request $request){
        if($request->ajax()){

            $nombre      = $request->input('nombre');
            $descripcion = $request->input('descripcion');
            $usuario     = Auth::user();

            $raza                     = new Raza();
            $raza->usuario_creador_id = $usuario->id;
            $raza->nombre             = $nombre;
            $raza->descripcion        = $descripcion;
            $raza->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

}
