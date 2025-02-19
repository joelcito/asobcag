<?php

namespace App\Http\Controllers;

use App\Models\TipoEmpadre;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipoEmpadreController extends Controller
{
    public function listado(Request $request){
        return view('tipoEmpadre.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $tipos = TipoEmpadre::all();
            $valores = [
                'listado' => view('tipoEmpadre.ajaxListado')->with(compact('tipos'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarTipoEmpadre(Request $request){
        if($request->ajax()){

            $request->validate([
                'nombre' => 'required',
            ]);

            $id = $request->input('id');

            $nombre      = $request->input('nombre');
            $usuario     = Auth::user();

            if( $id == 0 ){
                $tipo = new TipoEmpadre();
                $tipo->usuario_creador_id = $usuario->id;
            }else{
                $tipo = TipoEmpadre::find($id);
                $tipo->usuario_modificador_id = $usuario->id;                
            }

            $tipo->nombre             = $nombre;
            $tipo->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function eliminarTipoEmpadre(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $usuario = Auth::user();

            $tipoEmpadre = TipoEmpadre::find($id);
            $tipoEmpadre->usuario_eliminador_id = $usuario->id;
            $tipoEmpadre->save();

            TipoEmpadre::destroy($id);

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

}
