<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use App\Models\Departamento;
use App\Models\Localidad;
use App\Models\Municipio;
use App\Models\Pais;
use App\Models\Provincia;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocalidadController extends Controller
{

    public function listadoPais(Request $request){
        $paises = Localidad::whereNull('superior_id')->get();
        return view('localidad.listadoPais')->with(compact('paises'));
    }

    public function ajaxListadoPais(Request $request){
        if($request->ajax()){
            $paises = Localidad::whereNull('superior_id')->get();
            $valores = [
                'listado' => view('localidad.ajaxListadoPais')->with(compact('paises'))->render()
            ];

            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarPais(Request $request){
        if($request->ajax()){

            $nombre      = $request->input('nombre');
            $usuario     = Auth::user();

            $localidad                     = new Localidad();
            $localidad->usuario_creador_id = $usuario->id;
            $localidad->nombre             = $nombre;
            $localidad->nivel              = 1;
            $localidad->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function ajaxListadoDepartamento(Request $request){
        if($request->ajax()){

            $pais_id           = $request->input('pais');
            $pais = Localidad::find($pais_id);

            if($pais){
                $departamentos     = $pais->localidadesHijo()->get();
                $valores = [
                    'listado' => view('localidad.ajaxListadoDepartamento')->with(compact('departamentos', 'pais_id'))->render()
                ];
                $data = Respuesta::success($valores, "Datos obtenidos correctamente");
            }else{
                $data = Respuesta::error(null, "Pais no encontrado.");
            }
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarDepartamento(Request $request){
        if($request->ajax()){

            $nombre  = $request->input('nombreDepartamento');
            $pais_id = $request->input('pais_id_departamento');
            $usuario = Auth::user();

            $departamento                     = new Departamento();
            $departamento->usuario_creador_id = $usuario->id;
            $departamento->nombre             = $nombre;
            $departamento->pais_id            = $pais_id;
            $departamento->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function ajaxListadoProvincia(Request $request){
        if($request->ajax()){

            $departamento_id   = $request->input('departamento');
            $departamento = Localidad::find($departamento_id);

            if($departamento){
                $provincias     = $departamento->localidadesHijo()->get();
                $valores = [
                    'listado' => view('localidad.ajaxListadoProvincia')->with(compact('provincias', 'departamento_id'))->render()
                ];
                $data = Respuesta::success($valores, "Datos obtenidos correctamente");
            }else{
                $data = Respuesta::error(null, "Departamento no encontrado.");
            }
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarProvincia(Request $request){
        if($request->ajax()){

            $nombre          = $request->input('nombreProvincia');
            $departamento_id = $request->input('departamento_id_provincia');
            $usuario         = Auth::user();

            $provincia                     = new Provincia();
            $provincia->usuario_creador_id = $usuario->id;
            $provincia->nombre             = $nombre;
            $provincia->departamento_id    = $departamento_id;
            $provincia->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function ajaxListadoMunicipio(Request $request){
        if($request->ajax()){

            $provincia_id   = $request->input('provincia');
            $provincia = Localidad::find($provincia_id);

            if($provincia){
                $municipios     = $provincia->localidadesHijo()->get();

                $valores = [
                    'listado' => view('localidad.ajaxListadoMunicipio')->with(compact('municipios', 'provincia_id'))->render()
                ];
                $data = Respuesta::success($valores, "Datos obtenidos correctamente");

            }else{
                $data = Respuesta::error(null, "Provincia no encontrado.");
            }

        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }
    public function  guardarMunicipio(Request $request){
        if($request->ajax()){

            $nombre       = $request->input('nombreMunicipio');
            $provincia_id = $request->input('provincia_id_municipio');
            $usuario      = Auth::user();

            $municipio                     = new Municipio();
            $municipio->usuario_creador_id = $usuario->id;
            $municipio->nombre             = $nombre;
            $municipio->provincia_id       = $provincia_id;
            $municipio->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function ajaxListadoComunidad(Request $request){
        if($request->ajax()){

            $municipio_id   = $request->input('municipio');
            $municipio = Localidad::find($municipio_id);

            if($municipio){
                $comunidades     = $municipio->localidadesHijo()->get();

                $valores = [
                    'listado' => view('localidad.ajaxListadoComunidad')->with(compact('comunidades', 'municipio_id'))->render()
                ];
                $data = Respuesta::success($valores, "Datos obtenidos correctamente");

            }else{
                $data = Respuesta::error(null, "Provincia no encontrado.");
            }
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function  guardarComunidad(Request $request){
        if($request->ajax()){

            $nombre       = $request->input('nombreComunidad');
            $municipio_id = $request->input('municipio_id_comunidad');
            $usuario      = Auth::user();

            $comunidad                     = new Comunidad();
            $comunidad->usuario_creador_id = $usuario->id;
            $comunidad->nombre             = $nombre;
            $comunidad->municipio_id       = $municipio_id;
            $comunidad->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function buscarHijos(Request $request){
        if($request->ajax()){

            $id_padre = $request->input('padre_id');
            $padre = Localidad::find($id_padre);

            if($padre){
                $hijos     = $padre->localidadesHijo()->get();

                $valores = [
                    'listado' => $hijos,
                    'nivel' => $padre->nivel,
                ];
                $data = Respuesta::success($valores, "Datos obtenidos correctamente");

            }else{
                $data = Respuesta::error(null, "No se encontraron resultados.");
            }

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
