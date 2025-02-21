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
    public function listado($tipo){
        $ejemplares = Ejemplar::where('tipo', $tipo)->get();
        $productos = ProductoVeterinario::all();
        $responsables = User::all();

        return view('medicacion.listado')->with(compact(['ejemplares', 'productos', 'responsables', 'tipo']));
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){

            $tipo = $request->input('tipo');

            $medicaciones = Medicacion::with(['ejemplar', 'responsable', 'productoVeterinario'])
                                    ->whereHas('ejemplar', function ($q) use ($tipo) {
                                        $q->where('tipo', $tipo);
                                    })
                                    ->get();
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

            $request->validate([
                'ejemplar_id' => 'required',
                'producto_veterinario_id' => 'required',
                'responsable_id' => 'required',
                'fecha' => 'required',
                'tipo' => 'required',
                'dosis' => 'required',
                'unidades' => 'required',
            ]);

            $id = $request->input('id');

            $ejemplar_id             = $request->input('ejemplar_id');
            $producto_veterinario_id = $request->input('producto_veterinario_id');
            $responsable_id          = $request->input('responsable_id');
            $fecha                   = $request->input('fecha');
            $tipo                    = $request->input('tipo');
            $dosis                   = $request->input('dosis');
            $unidades                = $request->input('unidades');
            $observacion             = $request->input('observacion');
            $usuario                 = Auth::user();

            if( $id == 0 ){
                $medicacion = new Medicacion();
                $medicacion->usuario_creador_id = $usuario->id;
            }else{
                $medicacion = Medicacion::find($id);
                $medicacion->usuario_modificador_id = $usuario->id;                
            }

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

    public function eliminarMedicacion(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $usuario = Auth::user();

            $medicacion = Medicacion::find($id);
            $medicacion->usuario_eliminador_id = $usuario->id;
            $medicacion->save();

            Medicacion::destroy($id);

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
