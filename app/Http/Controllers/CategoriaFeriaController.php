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

            $request->validate([
                'nombre' => 'required',
            ]);

            $id = $request->input('id');

            $nombre      = $request->input('nombre');
            $usuario     = Auth::user();

            if( $id == 0 ){
                $color                     = new CategoriaFeria();
                $color->usuario_creador_id = $usuario->id;
            }else{
                $color = CategoriaFeria::find($id);
                $color->usuario_modificador_id = $usuario->id;
            }

            $color->nombre             = $nombre;
            $color->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function eliminarCategoriaFeria(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $usuario = Auth::user();

            $categoriaFeria = CategoriaFeria::find($id);
            $categoriaFeria->usuario_eliminador_id = $usuario->id;
            $categoriaFeria->save();

            CategoriaFeria::destroy($id);

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

}
