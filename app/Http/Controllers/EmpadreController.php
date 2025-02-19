<?php

namespace App\Http\Controllers;

use App\Models\Campania;
use App\Models\Empadre;
use App\Models\Ejemplar;
use App\Models\TipoEmpadre;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpadreController extends Controller
{
    public function listado(Request $request){
        $campanias = Campania::all();
        $machos  = Ejemplar::where('sexo', 'Macho')->get();
        $hembras = Ejemplar::where('sexo', 'Hembra')->get();
        $tipos   = TipoEmpadre::all();

        return view('empadre.listado')->with(compact(['campanias', 'machos', 'hembras', 'tipos']));
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $empadres = Empadre::all();
            $valores = [
                'listado' => view('empadre.ajaxListado')->with(compact('empadres'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarEmpadre(Request $request){
        if($request->ajax()){

            $request->validate([
                'campania_id'     => 'required',
                'padre_id'        => 'required',
                'madre_id'        => 'required',
                'tipo_empadre_id' => 'required',
                'fecha'           => 'required',
                'tiempo_copula'   => 'required',
            ]);

            $id = $request->input('id');

            $padre_id        = $request->input('padre_id');
            $madre_id        = $request->input('madre_id');
            $campania_id     = $request->input('campania_id');
            $tipo_empadre_id = $request->input('tipo_empadre_id');
            $fecha           = $request->input('fecha');
            $descripcion     = $request->input('descripcion');
            $tiempo_copula   = $request->input('tiempo_copula');
            $observacion     = $request->input('observacion');
            $usuario         = Auth::user();

            if( $id == 0 ){
                $empadre = new Empadre();
                $empadre->usuario_creador_id = $usuario->id;
            }else{
                $empadre = Empadre::find($id);
                $empadre->usuario_modificador_id = $usuario->id;                
            }

            $empadre->padre_id           = $padre_id;
            $empadre->madre_id           = $madre_id;
            $empadre->campania_id        = $campania_id;
            $empadre->tipo_empadre_id    = $tipo_empadre_id;
            $empadre->fecha              = $fecha;
            $empadre->descripcion        = $descripcion;
            $empadre->tiempo_copula      = $tiempo_copula;
            $empadre->observacion        = $observacion;
            $empadre->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function eliminarEmpadre(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $usuario = Auth::user();

            $empadre = Empadre::find($id);
            $empadre->usuario_eliminador_id = $usuario->id;
            $empadre->save();

            Empadre::destroy($id);

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
