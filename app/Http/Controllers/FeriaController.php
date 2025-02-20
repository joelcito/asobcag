<?php

namespace App\Http\Controllers;

use App\Models\Feria;
use App\Models\Localidad;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeriaController extends Controller
{
    public function listado(Request $request){
        $paises = Localidad::whereNull('superior_id')->get();
        return view('feria.listado')->with(compact('paises'));
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

            $request->validate([
                'nombre' => 'required',
                'fecha' => 'required',
                'comunidad_id' => 'required',
            ]);

            $id = $request->input('id');

            $nombre       = $request->input('nombre');
            $fecha        = $request->input('fecha');
            $comunidad_id = $request->input('comunidad_id');
            $tipo_feria   = $request->input('tipo_feria');
            $usuario      = Auth::user();

            if( $id == 0 ){
                $feria = new Feria();
                $feria->usuario_creador_id = $usuario->id;
            }else{
                $feria = Feria::find($id);
                $feria->usuario_modificador_id = $usuario->id;
            }

            $feria->nombre             = $nombre;
            $feria->fecha              = $fecha;
            $feria->localidad_id       = $comunidad_id;
            if($tipo_feria == "nacional"){
                $feria->nacional      = 1;
                $feria->departamental = null;
                $feria->municipal     = null;
            }else if($tipo_feria == "departamental"){
                $feria->departamental = 1;
                $feria->nacional      = null;
                $feria->municipal     = null;
            }else if($tipo_feria == "municipal"){
                $feria->municipal = 1;
                $feria->departamental = null;
                $feria->nacional      = null;
            }
            $feria->save();
            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function eliminarFeria(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $usuario = Auth::user();

            $feria = Feria::find($id);
            $feria->usuario_eliminador_id = $usuario->id;
            $feria->save();

            Feria::destroy($id);

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
