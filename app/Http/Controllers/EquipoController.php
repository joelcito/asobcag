<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller
{
    public function listado(){
        return view('equipo.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $equipos = Equipo::all();
            $valores = [
                'listado' => view('equipo.ajaxListado')->with(compact('equipos'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarEquipo(Request $request){
        if($request->ajax()){

            $request->validate([
                'nombre' => 'required',
            ]);

            $id = $request->input('id');

            $nombre      = $request->input('nombre');
            $usuario     = Auth::user();

            if( $id == 0 ){
                $equipo                     = new Equipo();
                $equipo->usuario_creador_id = $usuario->id;
            }else{
                $equipo = Equipo::find($id);
                $equipo->usuario_modificador_id = $usuario->id;
            }

            $equipo->nombre = $nombre;
            $equipo->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function eliminarEquipo(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $usuario = Auth::user();

            $equipo = Equipo::find($id);
            $equipo->usuario_eliminador_id = $usuario->id;
            $equipo->save();

            Equipo::destroy($id);

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
