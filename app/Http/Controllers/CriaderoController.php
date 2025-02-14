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
    public function clienteProvedor(){
        $localidades = Localidad::all();
        $usuarios = User::all();
        return view('ingresos.clienteProvedor.listado')->with(compact(['localidades', 'usuarios']));
    }


    public function ajaxListadoClienteProvedor(Request $request){
        if($request->ajax()){

            $criaderos = Criadero::all();
            $valores = [
                'listado' => view('ingresos.clienteProvedor.ajaxListado')->with(compact('criaderos'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarClienteProvedor(Request $request){
        if($request->ajax()){

            $nombre         = $request->input('nombre');
            /* $dni            = $request->input('dni');
            $direccion      = $request->input('direccion');
            $pais           = $request->input('pais');
            $departamento   = $request->input('departamento');
            $provincia      = $request->input('provincia');
            $distrito       = $request->input('distrito');
            $celular        = $request->input('celular'); */
            $negocio_fibra  = $request->input('negocio_fibra');
            $negocio_carne  = $request->input('negocio_carne');
            $negocio_animal = $request->input('negocio_animal');
            $propietario_id = $request->input('propietario_id');
            $usuarioLoguado = Auth::user();

            $criadero                     = new Criadero();
            $criadero->usuario_creador_id = $usuarioLoguado->id;
            $criadero->nombre             = $nombre;
            /* $criadero->dni                = $dni;
            $criadero->direccion          = $direccion;
            $criadero->pais               = $pais;
            $criadero->departamento       = $departamento;
            $criadero->provincia          = $provincia;
            $criadero->distrito           = $distrito;
            $criadero->celular            = $celular; */
            $criadero->negocio_fibra      = $negocio_fibra;
            $criadero->negocio_carne      = $negocio_carne;
            $criadero->negocio_animal     = $negocio_animal;
            $criadero->propietario_id     = $propietario_id;
            $criadero->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
