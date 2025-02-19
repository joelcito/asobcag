<?php

namespace App\Http\Controllers;

use App\Models\Raza;
use App\Models\User;
use App\Models\Color;
use App\Models\Ejemplar;
use App\Models\Fenotipo;
use App\Utils\Respuesta;
use App\Models\Comunidad;
use App\Models\Criadero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EjemplarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /* public function formulario(Request $request, $ejemplar_id){

        $razas              = Raza::all();
        $ejemplarModel      = new Ejemplar();
        $usuarioModel       = new User();
        $id_rol_propietario = 2;
        $cominidades        = Comunidad::all();
        $ejemplar           = Ejemplar::find($ejemplar_id);


        $propietarios            = $usuarioModel->listaUsuarios($id_rol_propietario);
        $numeroRegistroSiguiente = $ejemplarModel->sacarCorrelativoRegsitro();
        return view('ejemplar.formulario')->with(compact('razas', 'numeroRegistroSiguiente', 'propietarios', 'cominidades', 'ejemplar'));
    }

    public function guardar(Request $request){
        if($request->ajax()){

            $usuario            = Auth::user();
            $ejemplar_id        = $request->input('ejemplar_id');
            $nombre             = $request->input('nombre');
            $sexo               = $request->input('sexo');
            $color              = $request->input('color');
            $raza_id            = $request->input('raza_id');
            $fecha_nacimiento   = $request->input('fecha_nacimiento');
            $color_tradicional  = $request->input('color_tradicional');
            $numero_arete       = $request->input('numero_arete');
            $comunidad_id       = $request->input('comunidad_id');
            $propietario_id     = $request->input('propietario_id');
            $fecha_registro     = $request->input('fecha_registro');
            $padre_id           = $request->input('padre_id');
            $madre_id           = $request->input('madre_id');
            $peso_nacimiento    = $request->input('peso_nacimiento');
            $peso_vivo          = $request->input('peso_vivo');
            $perimetro_toracico = $request->input('perimetro_toracico');
            $altura_cruz        = $request->input('altura_cruz');
            $altura_grupa       = $request->input('altura_grupa');
            $largo_cuerpo       = $request->input('largo_cuerpo');
            $ancho_anca         = $request->input('ancho_anca');
            $largo_cuello       = $request->input('largo_cuello');

            if($ejemplar_id == '0'){
                $ejemplar                     = new Ejemplar();
                $ejemplar->usuario_creador_id = $usuario->id;
                $ejemplar->numero_registro    = $ejemplar->sacarCorrelativoRegsitro();
            }else{
                $ejemplar                         = Ejemplar::find($ejemplar_id);
                $ejemplar->usuario_modificador_id = $usuario->id;
            }

            $ejemplar->nombre             = $nombre;
            $ejemplar->propietario_id     = $propietario_id;
            $ejemplar->raza_id            = $raza_id;
            $ejemplar->padre_id           = $padre_id;
            $ejemplar->madre_id           = $madre_id;
            $ejemplar->comunidad_id       = $comunidad_id;
            $ejemplar->color              = $color;
            $ejemplar->sexo               = $sexo;
            $ejemplar->fecha_nacimiento   = $fecha_nacimiento;
            $ejemplar->fecha_registro     = $fecha_registro;
            $ejemplar->color_tradicional  = $color_tradicional;
            $ejemplar->numero_arete       = $numero_arete;
            $ejemplar->peso_nacimiento    = $peso_nacimiento;
            $ejemplar->peso_vivo          = $peso_vivo;
            $ejemplar->perimetro_toracico = $perimetro_toracico;
            $ejemplar->altura_cruz        = $altura_cruz;
            $ejemplar->altura_grupa       = $altura_grupa;
            $ejemplar->largo_cuerpo       = $largo_cuerpo;
            $ejemplar->ancho_anca         = $ancho_anca;
            $ejemplar->largo_cuello       = $largo_cuello;
            $ejemplar->save();

            $data = Respuesta::success(null, "Se proceso con exito");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function listado(Request $request){
        return view('ejemplar.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $ejemplares = Ejemplar::all();
            $valores = [
                'listado' => view('ejemplar.ajaxListado')->with(compact('ejemplares'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function buscarEjemplar(Request $request){
        if($request->ajax()){

            $numero_registro = $request->input('numero_registro');
            $sexo            = $request->input('sexo');
            $nombre          = $request->input('nombre');

            $query = Ejemplar::query();

            if(!is_null($numero_registro)){
                $query->where('numero_registro', $numero_registro);
            }

            if(!is_null($nombre)){
                $query->where('nombre', 'LIKE',"%$nombre%");
            }

            $query->where('sexo', $sexo);

            if(!is_null($nombre) && !is_null($numero_registro)){
                $ejemplares = $query->limit(5)->get();
            }else{
                $ejemplares = $query->orderBy('id', 'desc')->limit(10)->get();
            }

            $valores = [
                'listado' => view('ejemplar.buscarEjemplar')->with(compact('ejemplares'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function formularioCamada(Request $request){

        $razas              = Raza::all();
        $cominidades        = Comunidad::all();
        $usuarioModel       = new User();
        $id_rol_propietario = 2;
        $propietarios       = $usuarioModel->listaUsuarios($id_rol_propietario);
        $cominidades        = Comunidad::all();

        return view('ejemplar.camada.formularioCamada')->with(compact('razas', 'cominidades', 'propietarios'));
    }

    public function  guardarCamada(Request $request){
        if($request->ajax()){

            dd($request->all());

            $ejemplares = Ejemplar::all();
            $valores = [
                'listado' => view('ejemplar.ajaxListado')->with(compact('ejemplares'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    } */


    public function listado(){
        $colores = Color::all();
        $fenotipos = Fenotipo::all();
        $criaderos = Criadero::all();

        return view('ejemplar2.listado')->with(compact(['colores', 'fenotipos', 'criaderos']));
    }

    public function formulario(){
        $colores = Color::all();
        $fenotipos = Fenotipo::all();
        $criaderos = Criadero::all();

        return view('ejemplar2.formulario')->with(compact(['colores', 'fenotipos', 'criaderos']));
    }

    public function formularioNacimiento(){
        $colores   = Color::all();
        $fenotipos = Fenotipo::all();
        $criaderos = Criadero::all();
        $machos    = Ejemplar::with(['color', 'fenotipo'])->where('sexo', 'Macho')->get();
        $hembras   = Ejemplar::with(['color', 'fenotipo'])->where('sexo', 'Hembra')->get();

        return view('ejemplar2.formularioNacimiento')->with(compact(['colores', 'fenotipos', 'criaderos', 'machos', 'hembras']));
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){

            $ejemplares = Ejemplar::all();
            $valores = [
                'listado' => view('ejemplar2.ajaxListado')->with(compact('ejemplares'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarEjemplar(Request $request){
        //TODO: agregar 'tipo' para LLAMA o ALPACA
        $request->validate([
            'microchip'        => 'required',
            'nombre'           => 'required',
            'arete'            => 'required',
            'fenotipo_id'      => 'required',
            'color_id'         => 'required',
            'sexo'             => 'required',
            //'fecha_nacimiento' => 'required',
            'fecha_registro'   => 'required',
            'criadero_id'      => 'required',
            'padre_id'         => 'required',
            'madre_id'         => 'required',
        ]);

        $car_id           = $request->input('car_id');
        $microchip        = $request->input('microchip');
        $nombre           = $request->input('nombre');
        $arete            = $request->input('arete');
        $fenotipo_id      = $request->input('fenotipo_id');
        $color_id         = $request->input('color_id');
        $sexo             = $request->input('sexo');
        $fecha_nacimiento = $request->input('fecha_nacimiento');
        $fecha_registro   = $request->input('fecha_registro');
        $criadero_id      = $request->input('criadero_id');
        $padre_id         = $request->input('padre_id');
        $madre_id         = $request->input('madre_id');
        $usuarioLoguado   = Auth::user();

        $ejemplar                     = new Ejemplar();
        $ejemplar->usuario_creador_id = $usuarioLoguado->id;
        $ejemplar->microchip        = $microchip;
        $ejemplar->nombre           = $nombre;
        $ejemplar->arete            = $arete;
        $ejemplar->fenotipo_id      = $fenotipo_id;
        $ejemplar->color_id         = $color_id;
        $ejemplar->sexo             = $sexo;
        $ejemplar->fecha_nacimiento = $fecha_nacimiento;
        $ejemplar->fecha_registro   = $fecha_registro;
        $ejemplar->criadero_id      = $criadero_id;
        $ejemplar->padre_id         = $padre_id;
        $ejemplar->madre_id         = $madre_id;
        $ejemplar->save();

        return redirect()->route('ejemplar.listado');

    }

}
