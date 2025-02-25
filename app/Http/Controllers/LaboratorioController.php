<?php

namespace App\Http\Controllers;

use App\Utils\Respuesta;
use App\Models\Laboratorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaboratorioController extends Controller
{
    public function listado(){
        return view('laboratorio.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $laboratorios = Laboratorio::all();
            $valores = [
                'listado' => view('laboratorio.ajaxListado')->with(compact('laboratorios'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarLaboratorio(Request $request){
        if($request->ajax()){

            $request->validate([
                'nombre' => 'required',
            ]);

            $id = $request->input('id');

            $nombre      = $request->input('nombre');
            $usuario     = Auth::user();

            if( $id == 0 ){
                $laboratorio                     = new Laboratorio();
                $laboratorio->usuario_creador_id = $usuario->id;
            }else{
                $laboratorio = Laboratorio::find($id);
                $laboratorio->usuario_modificador_id = $usuario->id;
            }

            $laboratorio->nombre = $nombre;
            $laboratorio->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function eliminarLaboratorio(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $usuario = Auth::user();

            $laboratorio = Laboratorio::find($id);
            $laboratorio->usuario_eliminador_id = $usuario->id;
            $laboratorio->save();

            Laboratorio::destroy($id);

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
