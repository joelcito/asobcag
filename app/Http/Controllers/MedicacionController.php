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
