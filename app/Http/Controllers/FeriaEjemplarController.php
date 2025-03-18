<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feria;
use App\Models\Premio;
use App\Models\Ejemplar;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use App\Models\FeriaEjemplar;
use App\Models\CategoriaFeria;
use Illuminate\Support\Facades\Auth;

class FeriaEjemplarController extends Controller
{
    public function listado($tipo, $feria_id){
        $ejemplares = Ejemplar::where('tipo', $tipo)->get();
        $feria = Feria::with(['categoriaFeria', 'premio', 'juezPrincipal', 'juezAdjunto'])
                        ->find($feria_id);

        return view('feriaEjemplar.listado')->with(compact(['ejemplares', 'feria', 'tipo']));
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){

            $tipo = $request->input('tipo');

            $ferias = FeriaEjemplar::with(['ejemplar'])
                                    ->whereHas('ejemplar', function ($q) use ($tipo) {
                                        $q->where('tipo', $tipo);
                                    })
                                    ->get();
            $valores = [
                'listado' => view('feriaEjemplar.ajaxListado')->with(compact('ferias'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarFeriaEjemplar(Request $request){
        if($request->ajax()){

            $request->validate([
                'ejemplar_id' => 'required',
                'feria_id' => 'required',
            ]);

            $id = $request->input('id');

            $ejemplar_id        = $request->input('ejemplar_id');
            $feria_id           = $request->input('feria_id');
            $usuario            = Auth::user();

            if( $id == 0 ){
                $feriaEjemplar = new FeriaEjemplar();
                $feriaEjemplar->usuario_creador_id = $usuario->id;
            }else{
                $feriaEjemplar = FeriaEjemplar::find($id);
                $feriaEjemplar->usuario_modificador_id = $usuario->id;                
            }

            $feriaEjemplar->ejemplar_id        = $ejemplar_id;
            $feriaEjemplar->feria_id           = $feria_id;

            $feriaEjemplar->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function eliminarFeriaEjemplar(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $usuario = Auth::user();

            $feriaEjemplar = FeriaEjemplar::find($id);
            $feriaEjemplar->usuario_eliminador_id = $usuario->id;
            $feriaEjemplar->save();

            FeriaEjemplar::destroy($id);

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function guardarCalificacion(Request $request){
        if($request->ajax()){

            $request->validate([
                'clasificacion' => 'required',
            ]);

            $id = $request->input('feria_ejemplar_id');
            $clasificacion = $request->input('clasificacion');
            $detalle = $request->input('detalle');
            $usuario            = Auth::user();

            $feriaEjemplar = FeriaEjemplar::find($id);
            $feriaEjemplar->usuario_modificador_id = $usuario->id;                

            $feriaEjemplar->clasificacion = $clasificacion;
            $feriaEjemplar->detalle       = $detalle;

            $feriaEjemplar->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
