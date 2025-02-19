<?php

namespace App\Http\Controllers;

use App\Models\Fenotipo;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FenotipoController extends Controller
{
    public function listado(Request $request){
        return view('fenotipo.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $fenotipos = Fenotipo::all();
            $valores = [
                'listado' => view('fenotipo.ajaxListado')->with(compact('fenotipos'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarFenotipo(Request $request){
        if($request->ajax()){

            $request->validate([
                'nombre' => 'required',
            ]);

            $id = $request->input('id');

            $nombre      = $request->input('nombre');
            $usuario     = Auth::user();

            if( $id == 0 ){
                $fenotipo                     = new Fenotipo();
                $fenotipo->usuario_creador_id = $usuario->id;
            }else{
                $fenotipo = Fenotipo::find($id);
                $fenotipo->usuario_modificador_id = $usuario->id;
            }

            $fenotipo->nombre             = $nombre;
            $fenotipo->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function eliminarFenotipo(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $usuario = Auth::user();

            $fenotipo = Fenotipo::find($id);
            $fenotipo->usuario_eliminador_id = $usuario->id;
            $fenotipo->save();

            Fenotipo::destroy($id);

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

}
