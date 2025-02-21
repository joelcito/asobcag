<?php

namespace App\Http\Controllers;

use App\Models\Raza;
use App\Models\User;
use App\Models\Color;
use App\Models\Equipo;
use App\Models\Esquila;
use App\Models\Criadero;
use App\Models\Ejemplar;
use App\Models\Fenotipo;
use App\Utils\Respuesta;
use App\Models\Biometria;
use App\Models\Comunidad;
use App\Models\Laboratorio;
use App\Models\Morfologico;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AnalisisFibra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EjemplarController extends Controller
{

    public function listado($tipo){
        return view('ejemplar2.listado')->with(compact(['tipo']));
    }

    // public function formulario(Request $request, $ejemplar_id){
    //     $colores = Color::all();
    //     $fenotipos = Fenotipo::all();
    //     $criaderos = Criadero::all();
    //     $numeroSiguiente = $this->sacarSiguienteNumeroRegistroEjemplar();

    //     $ejemplar = Ejemplar::find($ejemplar_id);

    //     return view('ejemplar2.formulario')->with(compact(['colores', 'fenotipos', 'criaderos', 'numeroSiguiente', 'ejemplar']));
    // }

    public function formulario($tipo, $ejemplar_id){

        $colores         = Color::all();
        $fenotipos       = Fenotipo::all();
        $criaderos       = Criadero::all();
        $machos          = Ejemplar::with(['color', 'fenotipo'])->where('sexo', 'Macho')->where('tipo', $tipo)->get();
        $hembras         = Ejemplar::with(['color', 'fenotipo'])->where('sexo', 'Hembra')->where('tipo', $tipo)->get();
        $numeroSiguiente = $this->sacarSiguienteNumeroRegistroEjemplar();
        $ejemplar        = $ejemplar_id > 0 ? Ejemplar::find($ejemplar_id) : null;
        $usuarios        = User::all();
        $laboratorios    = Laboratorio::all();
        $equipos         = Equipo::all();

        return view('ejemplar2.formularioNacimiento')->with(compact(['colores', 'fenotipos', 'criaderos', 'machos', 'hembras', 'numeroSiguiente', 'ejemplar', 'usuarios', 'tipo', 'laboratorios', 'equipos']));

    }

    public function ajaxListado(Request $request){
        if($request->ajax()){

            $tipo = $request->input('tipo');

            $ejemplares = Ejemplar::with(['fenotipo', 'color', 'padre', 'madre'])->where('tipo', $tipo)->get();
            $valores = [
                'listado' => view('ejemplar2.ajaxListado')->with(compact(['ejemplares', 'tipo']))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarEjemplar(Request $request){

        if($request->ajax()){
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
                //'padre_id'         => 'required',
                // 'madre_id'         => 'required',
            ]);

            $car_id           = $request->input('car_id');
            $microchip        = $request->input('microchip');
            $nombre           = $request->input('nombre');
            $arete            = $request->input('arete');
            $fenotipo_id      = $request->input('fenotipo_id');
            $color_id         = $request->input('color_id');
            $sexo             = $request->input('sexo');
            $fecha_nacimiento = $request->input('fecha_nacimiento');
            $tipo_parto       = $request->input('tipo_parto');
            $fecha_registro   = $request->input('fecha_registro');
            $criadero_id      = $request->input('criadero_id');
            $padre_id         = $request->input('padre_id');
            $madre_id         = $request->input('madre_id');
            $tipo             = $request->input('tipo');
            $usuarioLoguado   = Auth::user();

            $ejemplar                     = new Ejemplar();
            $ejemplar->usuario_creador_id = $usuarioLoguado->id;
            $ejemplar->microchip          = $microchip;
            $ejemplar->nombre             = $nombre;
            $ejemplar->arete              = $arete;
            $ejemplar->fenotipo_id        = $fenotipo_id;
            $ejemplar->color_id           = $color_id;
            $ejemplar->sexo               = $sexo;
            $ejemplar->fecha_nacimiento   = $fecha_nacimiento;
            $ejemplar->tipo_parto         = $tipo_parto;
            $ejemplar->fecha_registro     = $fecha_registro;
            $ejemplar->criadero_id        = $criadero_id;
            $ejemplar->padre_id           = $padre_id;
            $ejemplar->madre_id           = $madre_id;
            $ejemplar->tipo               = $tipo;
            $ejemplar->numero_registro    = $car_id;
            $ejemplar->save();

            // Guardar imágenes asociadas al ejemplar
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $imagen) {
                    $nombreArchivo = time() . '_' . Str::random(10) . '_' . $imagen->getClientOriginalName();
                    $ruta = $imagen->storeAs("public/imagenes/{$tipo}", $nombreArchivo);

                    $ejemplar->imagenes()->create([
                        'usuario_creador_id' => $usuarioLoguado->id,
                        'ruta' => Storage::url("imagenes/{$tipo}/" . $nombreArchivo),
                        'estado' => 1,
                    ]);
                }
            }

            //return view('ejemplar2.listado');
            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;

    }

    public function detalle(Request $request, $ejemplar_id){

        // dd($ejemplar_id);

        $ejemplar = Ejemplar::find($ejemplar_id);

        return view('ejemplar2.detalle')->with(compact('ejemplar'));

    }

    public function ajaxListadoBiometria(Request $request){
        if($request->ajax()){

            $ejemplar_id = $request->input('ejemplar_id');
            $biometrias  = Biometria::where('ejemplar_id', $ejemplar_id)->orderBy('id', 'desc')->get();

            $valores = [
                'listado' => view('ejemplar2.ajaxListadoBiometria')->with(compact('biometrias'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function guardarBiometria(Request $request){
        if($request->ajax()){

            $request->validate([
                'motivo'               => 'required',
                'fecha'                => 'required',
                'evaluador_id'         => 'required',
                'peso'                 => 'required',
                'altura_cruz'          => 'required',
                'altura_grupa'         => 'required',
                'altura_cabeza'        => 'required',
                'ancho_pecho'          => 'required',
                'ancho_esquiones'      => 'required',
                'perimetro_toraxico'   => 'required',
                'perimetro_abdominal'  => 'required',
                'largo_cuello'         => 'required',
                'cuello_perimetro_sup' => 'required',
                'cuello_perimetro_inf' => 'required',
                'largo_oreja'          => 'required',
                'largo_cola'           => 'required',
                'diametro_ant'         => 'required',
                'diametro_post'        => 'required',
            ]);

            $motivo               = $request->input('motivo');
            $fecha                = $request->input('fecha');
            $evaluador_id         = $request->input('evaluador_id');
            $ejemplar_id          = $request->input('ejemplar_id');
            $peso                 = $request->input('peso');
            $altura_cruz          = $request->input('altura_cruz');
            $altura_grupa         = $request->input('altura_grupa');
            $altura_cabeza        = $request->input('altura_cabeza');
            $ancho_pecho          = $request->input('ancho_pecho');
            $ancho_esquiones      = $request->input('ancho_esquiones');
            $perimetro_toraxico   = $request->input('perimetro_toraxico');
            $perimetro_abdominal  = $request->input('perimetro_abdominal');
            $largo_cuello         = $request->input('largo_cuello');
            $cuello_perimetro_sup = $request->input('cuello_perimetro_sup');
            $cuello_perimetro_inf = $request->input('cuello_perimetro_inf');
            $largo_oreja          = $request->input('largo_oreja');
            $largo_cola           = $request->input('largo_cola');
            $diametro_ant         = $request->input('diametro_ant');
            $diametro_post        = $request->input('diametro_post');
            $usuarioLoguado       = Auth::user();

            $biometria                       = new Biometria();
            $biometria->usuario_creador_id   = $usuarioLoguado->id;
            $biometria->ejemplar_id          = $ejemplar_id;
            $biometria->motivo               = $motivo;
            $biometria->fecha                = $fecha;
            $biometria->evaluador_id         = $evaluador_id;
            $biometria->peso                 = $peso;
            $biometria->altura_cruz          = $altura_cruz;
            $biometria->altura_grupa         = $altura_grupa;
            $biometria->altura_cabeza        = $altura_cabeza;
            $biometria->ancho_pecho          = $ancho_pecho;
            $biometria->ancho_isquiones      = $ancho_esquiones;
            $biometria->perimetro_toraxico   = $perimetro_toraxico;
            $biometria->perimetro_abdominal  = $perimetro_abdominal;
            $biometria->largo_cuello         = $largo_cuello;
            $biometria->cuello_perimetro_sup = $cuello_perimetro_sup;
            $biometria->cuello_perimetro_inf = $cuello_perimetro_inf;
            $biometria->largo_oreja          = $largo_oreja;
            $biometria->largo_cola           = $largo_cola;
            $biometria->diametro_cania_ant   = $diametro_ant;
            $biometria->diametro_cania_post  = $diametro_post;
            $biometria->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }

        return $data;
    }

    public function ajaxListadoMorfilogicos(Request $request){
        if($request->ajax()){

            $ejemplar_id  = $request->input('ejemplar_id');
            $morfologicos = Morfologico::where('ejemplar_id', $ejemplar_id)->orderBy('id', 'desc')->get();

            $valores = [
                'listado' => view('ejemplar2.ajaxListadoMorfilogicos')->with(compact('morfologicos'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function guardarMorfologico(Request $request){
        if($request->ajax()){

            $request->validate([
                'motivo_morfologico'         => 'required',
                'fecha_morfologico'          => 'required',
                'ejemplar_id'                => 'required',
                'evaluador_id_morfologico'   => 'required',
                'oreja_morfologico'          => 'required',
                'cuello_morfologico'         => 'required',
                'cabeza_morfologico'         => 'required',
                'alzada_morfologico'         => 'required',
                'largo_cuerpo_morfologico'   => 'required',
                'amplitud_pecho_morfologico' => 'required',
                'fortaleza_morfologico'      => 'required',
                'balance_morfologico'        => 'required',
                'canias_morfologico'         => 'required',
                'copete_morfologico'         => 'required',
                'linea_superior_morfologico' => 'required',
                'grupa_morfologico'          => 'required',
            ]);

            $motivo_morfologico         = $request->input('motivo_morfologico');
            $ejemplar_id                = $request->input('ejemplar_id');
            $fecha_morfologico          = $request->input('fecha_morfologico');
            $evaluador_id_morfologico   = $request->input('evaluador_id_morfologico');
            $oreja_morfologico          = $request->input('oreja_morfologico');
            $cuello_morfologico         = $request->input('cuello_morfologico');
            $cabeza_morfologico         = $request->input('cabeza_morfologico');
            $alzada_morfologico         = $request->input('alzada_morfologico');
            $largo_cuerpo_morfologico   = $request->input('largo_cuerpo_morfologico');
            $amplitud_pecho_morfologico = $request->input('amplitud_pecho_morfologico');
            $fortaleza_morfologico      = $request->input('fortaleza_morfologico');
            $balance_morfologico        = $request->input('balance_morfologico');
            $canias_morfologico         = $request->input('canias_morfologico');
            $copete_morfologico         = $request->input('copete_morfologico');
            $linea_superior_morfologico = $request->input('linea_superior_morfologico');
            $grupa_morfologico          = $request->input('grupa_morfologico');
            $usuarioLoguado             = Auth::user();

            $morfologico                     = new Morfologico();
            $morfologico->usuario_creador_id = $usuarioLoguado->id;
            $morfologico->ejemplar_id        = $ejemplar_id;
            $morfologico->evaluador_id       = $evaluador_id_morfologico;
            $morfologico->motivo             = $motivo_morfologico;
            $morfologico->fecha_evaluacion   = $fecha_morfologico;
            $morfologico->oreja              = $oreja_morfologico;
            $morfologico->cuello             = $cuello_morfologico;
            $morfologico->cabeza             = $cabeza_morfologico;
            $morfologico->alzada             = $alzada_morfologico;
            $morfologico->largo_cuerpo       = $largo_cuerpo_morfologico;
            $morfologico->amplitud_pecho     = $amplitud_pecho_morfologico;
            $morfologico->fortaleza          = $fortaleza_morfologico;
            $morfologico->balance            = $balance_morfologico;
            $morfologico->canias             = $canias_morfologico;
            $morfologico->copete             = $copete_morfologico;
            $morfologico->linea_superior     = $linea_superior_morfologico;
            $morfologico->grupa              = $grupa_morfologico;
            $morfologico->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }

        return $data;
    }

    public function ajaxListadoFibras(Request $request){
        if($request->ajax()){

            $ejemplar_id  = $request->input('ejemplar_id');
            // $analisisFibras = AnalisisFibra::where('ejemplar_id', $ejemplar_id)->orderBy('id', 'desc')->get();
            $analisisFibras = AnalisisFibra::where('ejemplar_id', $ejemplar_id)->orderBy('id', 'desc')->get();

            $valores = [
                'listado' => view('ejemplar2.ajaxListadoFibras')->with(compact('analisisFibras'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function guardarFibra(Request $request){
        if($request->ajax()){

            $request->validate([
                'laboratorio_id' => 'required',
                'ejemplar_id'    => 'required',
                'equipo_id'      => 'required',
                'fecha_muestreo' => 'required',
                'fecha_analisis' => 'required',
                'zona_corporal'  => 'required',
                'fd'             => 'required',
                'sd'             => 'required',
                'cv'             => 'required',
                'fc'             => 'required',
                'pm'             => 'required',
                'mfd'            => 'required',
            ]);

            $laboratorio_id = $request->input('laboratorio_id');
            $ejemplar_id    = $request->input('ejemplar_id');
            $equipo_id      = $request->input('equipo_id');
            $fecha_muestreo = $request->input('fecha_muestreo');
            $fecha_analisis = $request->input('fecha_analisis');
            $zona_corporal  = $request->input('zona_corporal');
            $fd             = $request->input('fd');
            $sd             = $request->input('sd');
            $cv             = $request->input('cv');
            $fc             = $request->input('fc');
            $pm             = $request->input('pm');
            $mfd            = $request->input('mfd');
            $usuarioLoguado = Auth::user();

            $anilisis                     = new AnalisisFibra();
            $anilisis->usuario_creador_id = $usuarioLoguado->id;
            $anilisis->ejemplar_id        = $ejemplar_id;
            $anilisis->laboratorio_id     = $laboratorio_id;
            $anilisis->equipo_id          = $equipo_id;
            $anilisis->fecha_muestreo     = $fecha_muestreo;
            $anilisis->fecha_analisis     = $fecha_analisis;
            $anilisis->zona_corporal      = $zona_corporal;
            $anilisis->fd                 = $fd;
            $anilisis->sd                 = $sd;
            $anilisis->cv                 = $cv;
            $anilisis->fc                 = $fc;
            $anilisis->pm                 = $pm;
            $anilisis->mfd                = $mfd;
            $anilisis->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }



    public function ajaxListadoEsquila(Request $request){
        if($request->ajax()){

            $ejemplar_id  = $request->input('ejemplar_id');
            $esquilas = Esquila::where('ejemplar_id', $ejemplar_id)->orderBy('id', 'desc')->get();

            $valores = [
                'listado' => view('ejemplar2.ajaxListadoEsquila')->with(compact('esquilas'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function guardarEsquila(Request $request){
        if($request->ajax()){

            $request->validate([
                'esquilador_id' => 'required',
                'fecha_esquila' => 'required',
                'tipo_esquila'  => 'required',
                'inca_esquila'  => 'required',
                'peso_manto'    => 'required',
                'peso_cuello'   => 'required',
                'peso_braga'    => 'required',
                'peso_total'    => 'required',
                'longitud'      => 'required',
                'observacion'   => 'required',
                'ejemplar_id'   => 'required',
            ]);

            $esquilador_id = $request->input('esquilador_id');
            $fecha_esquila = $request->input('fecha_esquila');
            $ejemplar_id   = $request->input('ejemplar_id');
            $tipo_esquila  = $request->input('tipo_esquila');
              // $inca_esquila   = $request->input('inca_esquila');
            $inca_esquila   = $request->has('inca_esquila')? 1 : 0;
            $peso_manto     = $request->input('peso_manto');
            $peso_cuello    = $request->input('peso_cuello');
            $peso_braga     = $request->input('peso_braga');
            $peso_total     = $request->input('peso_total');
            $longitud       = $request->input('longitud');
            $observacion    = $request->input('observacion');
            $usuarioLoguado = Auth::user();

            $esquila                     = new Esquila();
            $esquila->usuario_creador_id = $usuarioLoguado->id;
            $esquila->ejemplar_id        = $ejemplar_id;
            $esquila->esquilador_id      = $esquilador_id;
            $esquila->fecha              = $fecha_esquila;
            $esquila->tipo_esquila       = $tipo_esquila;
            $esquila->inca_esquila       = $inca_esquila;
            $esquila->peso_manto         = $peso_manto;
            $esquila->peso_cuello        = $peso_cuello;
            $esquila->peso_braga         = $peso_braga;
            $esquila->peso_total         = $peso_total;
            $esquila->longitud           = $longitud;
            $esquila->observacion        = $observacion;
            $esquila->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }


    // FUNCIONES PRIVADAS
    private function sacarSiguienteNumeroRegistroEjemplar(){
        $numero = 0;
        $registro = Ejemplar::latest()->first();
        $numero = $registro ? $registro->numero_registro + 1 : $numero + 1;
        return $numero;

    }
    // FUNCIONES PRIVADAS



}
