<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feria;
use App\Models\Premio;
use App\Utils\Respuesta;
use App\Models\Localidad;
use Illuminate\Http\Request;
use App\Models\CategoriaFeria;
use Illuminate\Support\Facades\Auth;

class FeriaController extends Controller
{
    public function listado($tipo){
        $paises = Localidad::whereNull('superior_id')->get();
        $categorias = CategoriaFeria::all();
        $premios    = Premio::all();
        $usuarios   = User::all();
        
        return view('feria.listado')->with(compact(['paises', 'categorias', 'premios', 'usuarios', 'tipo']));
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $tipo = $request->input('tipo');
            $ferias = Feria::with(['categoriaFeria', 'premio', 'juezPrincipal', 'juezAdjunto'])
                            ->where('tipo', $tipo)->get();
            $valores = [
                'listado' => view('feria.ajaxListado')->with(compact(['ferias', 'tipo']))->render()
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
                'categoria_feria_id' => 'required',
                'premio_id' => 'required',
                'juez_principal_id' => 'required',
                //'juez_adjunto_id' => 'required',
            ]);

            $id = $request->input('id');

            $nombre       = $request->input('nombre');
            $fecha        = $request->input('fecha');
            $comunidad_id = $request->input('comunidad_id');
            $tipo_feria   = $request->input('tipo_feria');
            $categoria_feria_id = $request->input('categoria_feria_id');
            $premio_id          = $request->input('premio_id');
            $juez_principal_id  = $request->input('juez_principal_id');
            $juez_adjunto_id    = $request->input('juez_adjunto_id');
            $tipo    = $request->input('tipo');
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
            $feria->categoria_feria_id = $categoria_feria_id;
            $feria->premio_id          = $premio_id;
            $feria->juez_principal_id  = $juez_principal_id;
            $feria->juez_adjunto_id    = $juez_adjunto_id;
            $feria->tipo    = $tipo;
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
