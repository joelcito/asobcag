<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Criadero;
use App\Models\Ejemplar;
use App\Utils\Respuesta;
use App\Models\Localidad;
use Illuminate\Http\Request;
use App\Exports\EjemplaresExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CriaderoController extends Controller
{
    public function listado(){
        $localidades = Localidad::all();
        $usuarios    = User::all();
        $paises      = Localidad::whereNull('superior_id')->get();
        return view('criadero.listado')->with(compact(['localidades', 'usuarios', 'paises']));
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){

            $criaderos = Criadero::with(['propietario', 'tecnico', 'pastor'])->get();
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
                'comunidad_id' => 'required',
            ]);

            $id = $request->input('id');

            $nombre = $request->input('nombre');
            $nit    = $request->input('nit');
              /* $direccion      = $request->input('direccion'); */
            $negocio_fibra  = $request->input('negocio_fibra');
            $negocio_carne  = $request->input('negocio_carne');
            $negocio_animal = $request->input('negocio_animal');
            $estancia       = $request->input('estancia');
            $propietario_id = $request->input('propietario_id');
            $tecnico_id     = $request->input('tecnico_id');
            $pastor_id      = $request->input('pastor_id');
            $comunidad_id   = $request->input('comunidad_id');
            $latitud   = $request->input('latitud');
            $longitud   = $request->input('longitud');
            $altitud   = $request->input('altitud');
            $usuarioLoguado = Auth::user();

            if( $id == 0 ){
                $criadero = new Criadero();
                $criadero->usuario_creador_id = $usuarioLoguado->id;
            }else{
                $criadero = Criadero::find($id);
                $criadero->usuario_modificador_id= $usuarioLoguado->id;
            }

            $criadero->nombre = $nombre;
            $criadero->nit    = $nit;
              /* $criadero->direccion          = $direccion; */
            $criadero->negocio_fibra  = $negocio_fibra && $negocio_fibra   == 'on' ? true : false;
            $criadero->negocio_carne  = $negocio_carne && $negocio_carne   == 'on' ? true : false;
            $criadero->negocio_animal = $negocio_animal && $negocio_animal == 'on' ? true : false;
            $criadero->estancia       = $estancia;
            $criadero->propietario_id = $propietario_id;
            $criadero->tecnico_id     = $tecnico_id;
            $criadero->pastor_id      = $pastor_id;
            $criadero->localidad_id   = $comunidad_id;
            $criadero->latitud      = $latitud;
            $criadero->longitud      = $longitud;
            $criadero->altitud      = $altitud;
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

    public function detalle($id){
        $criadero = Criadero::find($id);

        // Contar machos y hembras
        $genero = Ejemplar::selectRaw("sexo, COUNT(*) as cantidad")
                            ->where('criadero_id', $id)
                            ->groupBy('sexo')
                            ->get();

        // Contar ejemplares por color
        $colores = Ejemplar::join('colores', 'ejemplares.color_id', '=', 'colores.id')
                            ->selectRaw("colores.nombre as color, COUNT(*) as cantidad")
                            ->where('ejemplares.criadero_id', $id)
                            ->groupBy('colores.nombre')
                            ->get();

        // Contar ejemplares por rango de edad
        $hoy = Carbon::now();
        $edades = Ejemplar::selectRaw("
                                    CASE 
                                    WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, '$hoy') < 1 THEN 'Menos de 1 año'
                                    WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, '$hoy') BETWEEN 1 AND 3 THEN '1-3 años'
                                    WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, '$hoy') BETWEEN 4 AND 6 THEN '4-6 años'
                                    ELSE 'Más de 6 años' 
                                    END AS rango_edad,
                                    COUNT(*) as cantidad
                                    ")
                                ->where('criadero_id', $id)
                                ->groupBy('rango_edad')
                                ->get();

        //promedio de ejemplares segun su peso
        $pesos = Ejemplar::selectRaw("
                                YEAR(ejemplares.fecha_nacimiento) as anio,
                                AVG((SELECT MAX(b.peso) FROM biometrias b WHERE b.ejemplar_id = ejemplares.id AND ejemplares.fecha_nacimiento is not null)) as peso_max_promedio,
                                AVG((SELECT MIN(b.peso) FROM biometrias b WHERE b.ejemplar_id = ejemplares.id AND ejemplares.fecha_nacimiento is not null)) as peso_min_promedio
                            ")
                            ->where('criadero_id', $id)
                            ->groupBy('anio')
                            ->orderBy('anio', 'ASC')
                            ->get();


        return view('criadero.detalle')->with(compact(['criadero', 'genero', 'colores', 'edades', 'pesos']));
    }

    public function exportEjemplares($criadero_id)
    {
        return Excel::download(new EjemplaresExport($criadero_id), 'ejemplares.xlsx');
    }
}
