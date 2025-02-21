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
    public function listado($tipo){
        $ejemplares = Ejemplar::where('tipo', $tipo)->get();
        $ferias     = Feria::all();
        $categorias = CategoriaFeria::all();
        $premios    = Premio::all();
        $usuarios   = User::all();

        return view('feriaEjemplar.listado')->with(compact(['ejemplares', 'ferias', 'categorias', 'premios', 'usuarios', 'tipo']));
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){

            $tipo = $request->input('tipo');

            $ferias = FeriaEjemplar::with(['ejemplar', 'feria', 'categoriaFeria', 'premio', 'juezPrincipal', 'juezAdjunto'])
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
                'categoria_feria_id' => 'required',
                'premio_id' => 'required',
                'juez_principal_id' => 'required',
                //'juez_adjunto_id' => 'required',
            ]);

            $id = $request->input('id');

            $ejemplar_id        = $request->input('ejemplar_id');
            $feria_id           = $request->input('feria_id');
            $categoria_feria_id = $request->input('categoria_feria_id');
            $premio_id          = $request->input('premio_id');
            $juez_principal_id  = $request->input('juez_principal_id');
            $juez_adjunto_id    = $request->input('juez_adjunto_id');
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
            $feriaEjemplar->categoria_feria_id = $categoria_feria_id;
            $feriaEjemplar->premio_id          = $premio_id;
            $feriaEjemplar->juez_principal_id  = $juez_principal_id;
            $feriaEjemplar->juez_adjunto_id    = $juez_adjunto_id;
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
}
