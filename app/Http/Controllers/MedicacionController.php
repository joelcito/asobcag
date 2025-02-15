<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ejemplar;
use App\Utils\Respuesta;
use App\Models\Medicacion;
use Illuminate\Http\Request;
use App\Models\ProductoVeterinario;
use Illuminate\Support\Facades\Auth;

class MedicacionController extends Controller
{
    public function listado(Request $request){
        $ejemplares = Ejemplar::all();
        $productos = ProductoVeterinario::all();
        $responsables = User::all();

        return view('medicacion.listado')->with(compact(['ejemplares', 'productos', 'responsables']));
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $medicaciones = Medicacion::all();
            $valores = [
                'listado' => view('medicacion.ajaxListado')->with(compact('medicaciones'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarMedicacion(Request $request){
        if($request->ajax()){

            $ejemplar_id             = $request->input('ejemplar_id');
            $producto_veterinario_id = $request->input('producto_veterinario_id');
            $responsable_id          = $request->input('responsable_id');
            $fecha                   = $request->input('fecha');
            $tipo                    = $request->input('tipo');
            $dosis                   = $request->input('dosis');
            $unidades                = $request->input('unidades');
            $observacion             = $request->input('observacion');
            $usuario                 = Auth::user();

            $medicacion                     = new Medicacion();
            $medicacion->usuario_creador_id = $usuario->id;
            $medicacion->ejemplar_id             = $ejemplar_id;
            $medicacion->producto_veterinario_id = $producto_veterinario_id;
            $medicacion->responsable_id          = $responsable_id;
            $medicacion->fecha                   = $fecha;
            $medicacion->tipo                    = $tipo;
            $medicacion->dosis                   = $dosis;
            $medicacion->unidades                = $unidades;
            $medicacion->observacion             = $observacion;
            $medicacion->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
