<?php

namespace App\Http\Controllers;

use App\Models\Empadre;
use App\Models\Campania;
use App\Models\Criadero;
use App\Models\Ejemplar;
use App\Utils\Respuesta;
use App\Models\TipoEmpadre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EmpadreController extends Controller
{
    public function listado($tipo){

        if (Gate::allows('admin')) {
            $machos    = Ejemplar::with(['color', 'fenotipo'])->where('sexo', 'Macho')->where('tipo', $tipo)->get();
            $hembras   = Ejemplar::with(['color', 'fenotipo'])->where('sexo', 'Hembra')->where('tipo', $tipo)->get();
        }else{
            $criaderos = Criadero::where('propietario_id',Auth::user()->id)->get();
            $idsCriadero = $criaderos->pluck('id')->toArray();
            if( count($idsCriadero) > 0 ){
                $machos  = Ejemplar::with(['color', 'fenotipo'])->whereIn('criadero_id', $idsCriadero)->where('sexo', 'Macho')->where('tipo', $tipo)->get();
                $hembras = Ejemplar::with(['color', 'fenotipo'])->whereIn('criadero_id', $idsCriadero)->where('sexo', 'Hembra')->where('tipo', $tipo)->get();
            }else{
                $machos = [];
                $hembras = [];
            }
        }
        
        $campanias = Campania::all();
        $tipoEmpadres   = TipoEmpadre::all();

        return view('empadre.listado')->with(compact(['campanias', 'machos', 'hembras', 'tipoEmpadres', 'tipo']));
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){

            $tipo = $request->input('tipo');

            if (Gate::allows('admin')) {
                $empadres = Empadre::with(['madre', 'padre', 'campania', 'tipoEmpadre'])
                                ->whereHas('padre', function ($q) use ($tipo) {
                                    $q->where('tipo', $tipo);
                                })
                                ->whereHas('madre', function ($q) use ($tipo) {
                                    $q->where('tipo', $tipo);
                                })
                                ->get();
            }else{
                $criaderos = Criadero::where('propietario_id',Auth::user()->id)->get();
                $idsCriadero = $criaderos->pluck('id')->toArray();
                //dd($criaderos, $idsCriadero, count($idsCriadero));
                if( count($idsCriadero) > 0 ){
                    $empadres = Empadre::with(['madre', 'padre', 'campania', 'tipoEmpadre'])
                                ->whereHas('padre', function ($q) use ($tipo, $idsCriadero) {
                                    $q->whereIn('criadero_id', $idsCriadero)
                                    ->where('tipo', $tipo);
                                })
                                ->whereHas('madre', function ($q) use ($tipo, $idsCriadero) {
                                    $q->whereIn('criadero_id', $idsCriadero)
                                    ->where('tipo', $tipo);
                                })
                                ->get();
                }else{
                    $empadres = [];
                }
    
            }

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
