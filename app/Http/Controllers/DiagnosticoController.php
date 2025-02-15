<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Metodo;
use App\Models\Empadre;
use App\Utils\Respuesta;
use App\Models\Diagnostico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosticoController extends Controller
{
    public function listado(Request $request){
        $supervisores = User::all();
        $metodos = Metodo::all();
        $empadres = Empadre::all();

        return view('diagnostico.listado')->with(compact(['supervisores', 'metodos', 'empadres']));
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $diagnosticos = Diagnostico::all();
            $valores = [
                'listado' => view('diagnostico.ajaxListado')->with(compact('diagnosticos'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarDiagnostico(Request $request){
        if($request->ajax()){

            $empadre_id    = $request->input('empadre_id');
            $metodo_id     = $request->input('metodo_id');
            $supervisor_id = $request->input('supervisor_id');
            $fecha         = $request->input('fecha');
            $diagnostico_form   = $request->input('diagnostico');
            $usuario       = Auth::user();

            $diagnostico                     = new Diagnostico();
            $diagnostico->usuario_creador_id = $usuario->id;
            $diagnostico->empadre_id         = $empadre_id;
            $diagnostico->metodo_id          = $metodo_id;
            $diagnostico->supervisor_id      = $supervisor_id;
            $diagnostico->fecha              = $fecha;
            $diagnostico->diagnostico        = $diagnostico_form;
            $diagnostico->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
