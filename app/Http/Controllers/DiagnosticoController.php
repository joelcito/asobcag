<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Metodo;
use App\Models\Empadre;
use App\Models\Criadero;
use App\Utils\Respuesta;
use App\Models\Diagnostico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DiagnosticoController extends Controller
{
    public function listado($tipo){

        if (Gate::allows('admin')) {
            $empadres = Empadre::with(['madre'])
                            ->whereHas('madre', function ($q) use ($tipo) {
                                $q->where('tipo', $tipo);
                            })
                            ->get();
        }else{
            $criaderos = Criadero::where('propietario_id',Auth::user()->id)->get();
            $idsCriadero = $criaderos->pluck('id')->toArray();
            //dd($criaderos, $idsCriadero, count($idsCriadero));
            if( count($idsCriadero) > 0 ){
                $empadres = Empadre::with(['madre'])
                            ->whereHas('madre', function ($q) use ($tipo, $idsCriadero) {
                                $q->whereIn('criadero_id', $idsCriadero)
                                ->where('tipo', $tipo);
                            })
                            ->get();
            }else{
                $empadres = [];
            }

        }
        
        $supervisores = User::all();
        $metodos = Metodo::all();

        return view('diagnostico.listado')->with(compact(['supervisores', 'metodos', 'empadres', 'tipo']));
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){

            $tipo = $request->input('tipo');

            if (Gate::allows('admin')) {
                $diagnosticos = Diagnostico::with(['empadre.madre', 'metodo', 'supervisor'])
                                        ->whereHas('empadre.madre', function ($q) use ($tipo) {
                                            $q->where('tipo', $tipo);
                                        })
                                        ->get();
            }else{
                $criaderos = Criadero::where('propietario_id',Auth::user()->id)->get();
                $idsCriadero = $criaderos->pluck('id')->toArray();
                //dd($criaderos, $idsCriadero, count($idsCriadero));
                if( count($idsCriadero) > 0 ){
                    $diagnosticos = Diagnostico::with(['empadre.madre', 'metodo', 'supervisor'])
                                        ->whereHas('empadre.madre', function ($q) use ($tipo, $idsCriadero) {
                                            $q->whereIn('criadero_id', $idsCriadero)
                                            ->where('tipo', $tipo);
                                        })
                                        ->get();
                }else{
                    $diagnosticos = [];
                }
    
            }

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

            $request->validate([
                'empadre_id'    => 'required',
                'metodo_id'     => 'required',
                'supervisor_id' => 'required',
                'fecha'         => 'required',
                'diagnostico'   => 'required',
            ]);

            $id = $request->input('id');

            $empadre_id    = $request->input('empadre_id');
            $metodo_id     = $request->input('metodo_id');
            $supervisor_id = $request->input('supervisor_id');
            $fecha         = $request->input('fecha');
            $diagnostico_form   = $request->input('diagnostico');
            $usuario       = Auth::user();

            if( $id == 0 ){
                $diagnostico = new Diagnostico();
                $diagnostico->usuario_creador_id = $usuario->id;
            }else{
                $diagnostico = Diagnostico::find($id);
                $diagnostico->usuario_modificador_id = $usuario->id;                
            }

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

    public function buscarEmpadre(Request $request){
        if ($request->ajax()) {
            $query = $request->input('query');
            $tipo = $request->input('tipo');

            if (strlen($query) < 3) {
                return response()->json(['estado' => false, 'mensaje' => 'Ingrese al menos 3 caracteres.']);
            }

            // Buscar empadres junto con la madre (ejemplar relacionado)
            $empadres = Empadre::with('madre') // Cargamos la relación madre
                ->whereHas('madre', function ($q) use ($query) {
                    $q->where('nombre', 'LIKE', "%{$query}%") // Búsqueda en el nombre del ejemplar
                    ->orWhere('arete', 'LIKE', "%{$query}%");
                })
                ->whereHas('madre', function ($q) use ($tipo) {
                    $q->where('tipo', $tipo);
                })
                ->limit(10)
                ->get();

            $html = view('diagnostico.components.listado_empadres', compact('empadres'))->render();

            return response()->json(['estado' => true, 'html' => $html]);
        }

        return response()->json(['estado' => false, 'mensaje' => 'Solicitud no válida.']);
    }

    public function eliminarDiagnostico(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $usuario = Auth::user();

            $diagnostico = Diagnostico::find($id);
            $diagnostico->usuario_eliminador_id = $usuario->id;
            $diagnostico->save();

            Diagnostico::destroy($id);

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }


}
