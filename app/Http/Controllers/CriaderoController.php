<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Criadero;
use App\Utils\Respuesta;
use App\Models\Localidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CriaderoController extends Controller
{
    public function listado(){
        $localidades = Localidad::all();
        $usuarios = User::all();
        return view('criadero.listado')->with(compact(['localidades', 'usuarios']));
    }


    public function ajaxListado(Request $request){
        if($request->ajax()){

            $criaderos = Criadero::all();
            $valores = [
                'listado' => view('criadero.ajaxListado')->with(compact('criaderos'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarCriadero(Request $request){
        if($request->ajax()){

            $request->validate([
                'nombre'         => 'required',
                'estancia'       => 'required',
                'propietario_id' => 'required',
            ]);

            $id = $request->input('id');

            $nombre         = $request->input('nombre');
            $nit            = $request->input('nit');
            /* $direccion      = $request->input('direccion'); */
            $negocio_fibra  = $request->input('negocio_fibra');
            $negocio_carne  = $request->input('negocio_carne');
            $negocio_animal = $request->input('negocio_animal');
            $estancia       = $request->input('estancia');
            $propietario_id = $request->input('propietario_id');
            $tecnico_id     = $request->input('tecnico_id');
            $pastor_id      = $request->input('pastor_id');
            $usuarioLoguado = Auth::user();

            if( $id == 0 ){
                $criadero = new Criadero();
                $criadero->usuario_creador_id = $usuarioLoguado->id;
            }else{
                $criadero = Criadero::find($id);
                $criadero->usuario_modificador_id= $usuarioLoguado->id;
            }

            $criadero->nombre             = $nombre;
            $criadero->nit                = $nit;
            /* $criadero->direccion          = $direccion; */
            $criadero->negocio_fibra      = $negocio_fibra && $negocio_fibra == 'on' ? true : false;
            $criadero->negocio_carne      = $negocio_carne && $negocio_carne == 'on' ? true : false;
            $criadero->negocio_animal     = $negocio_animal && $negocio_animal == 'on' ? true : false;
            $criadero->estancia           = $estancia;
            $criadero->propietario_id     = $propietario_id;
            $criadero->tecnico_id         = $tecnico_id;
            $criadero->pastor_id          = $pastor_id;
            $criadero->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function eliminarCriadero(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $usuario = Auth::user();

            $criadero = Criadero::find($id);
            $criadero->usuario_eliminador_id = $usuario->id;
            $criadero->save();

            Criadero::destroy($id);

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
