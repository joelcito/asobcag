<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    public function listado(Request $request){
        return view('color.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $colores = Color::all();
            $valores = [
                'listado' => view('color.ajaxListado')->with(compact('colores'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarColor(Request $request){
        if($request->ajax()){

            $request->validate([
                'nombre' => 'required',
            ]);

            $id = $request->input('id');

            $nombre      = $request->input('nombre');
            $usuario     = Auth::user();

            if( $id == 0 ){
                $color                     = new Color();
                $color->usuario_creador_id = $usuario->id;
            }else{
                $color = Color::find($id);
                $color->usuario_modificador_id = $usuario->id;
            }

            $color->nombre = $nombre;
            $color->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function eliminarColor(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $usuario = Auth::user();

            $color = Color::find($id);
            $color->usuario_eliminador_id = $usuario->id;
            $color->save();

            Color::destroy($id);

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
