<?php

namespace App\Http\Controllers;

use App\Utils\Respuesta;
use Illuminate\Http\Request;
use App\Models\CategoriaFeria;
use Illuminate\Support\Facades\Auth;

class CategoriaFeriaController extends Controller
{
    public function listado(Request $request){
        return view('categoriaFeria.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $categorias = CategoriaFeria::all();
            $valores = [
                'listado' => view('categoriaFeria.ajaxListado')->with(compact('categorias'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarCategoriaFeria(Request $request){
        if($request->ajax()){

            $nombre      = $request->input('nombre');
            $usuario     = Auth::user();

            $color                     = new CategoriaFeria();
            $color->usuario_creador_id = $usuario->id;
            $color->nombre             = $nombre;
            $color->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
