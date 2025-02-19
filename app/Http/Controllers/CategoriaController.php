<?php

namespace App\Http\Controllers;

use App\Utils\Respuesta;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    public function listado(Request $request){
        return view('categoria.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $categorias = Categoria::all();
            $valores = [
                'listado' => view('categoria.ajaxListado')->with(compact('categorias'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarCategoria(Request $request){
        if($request->ajax()){

            $request->validate([
                'nombre' => 'required',
                'sigla'  => 'required',
                'desde'  => 'required',
                'hasta'  => 'required',
            ]);

            $id = $request->input('id');

            $nombre      = $request->input('nombre');
            $sigla      = $request->input('sigla');
            $desde      = $request->input('desde');
            $hasta      = $request->input('hasta');
            $usuario     = Auth::user();

            if( $id == 0 ){
                $categoria                     = new Categoria();
                $categoria->usuario_creador_id = $usuario->id;
            }else{
                $categoria = Categoria::find($id);
                $categoria->usuario_modificador_id = $usuario->id;                
            }

            $categoria->nombre             = $nombre;
            $categoria->sigla              = $sigla;
            $categoria->desde              = $desde;
            $categoria->hasta              = $hasta;
            $categoria->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function eliminarCategoria(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $usuario = Auth::user();

            $categoria = Categoria::find($id);
            $categoria->usuario_eliminador_id = $usuario->id;
            $categoria->save();

            Categoria::destroy($id);

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
