<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnalisisFibra;
use App\Models\Biometria;
use App\Models\Criadero;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Ejemplar;
use App\Models\EjemplarImagen;
use App\Models\Esquila;
use App\Models\Medicacion;
use App\Models\Morfologico;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class EjemplarController extends Controller
{
    public function ejemplaresUsuario(){
        try {
            $usuario = JWTAuth::parseToken()->authenticate();

            if (!$usuario)
                return response()->json(['error' => 'Usuario no encontrado'], 404);

            $ejemplares = Ejemplar::select(
                                            'ejemplares.id',
                                            'ejemplares.padre_id',
                                            'ejemplares.madre_id',
                                            'ejemplares.madre_id',
                                            'ejemplares.fenotipo_id',
                                            'ejemplares.color_id',
                                            'ejemplares.nombre',
                                            'ejemplares.sexo',
                                            'ejemplares.fecha_nacimiento',
                                            'ejemplares.numero_registro',
                                            'ejemplares.microchip',
                                            'ejemplares.arete',
                                            'ejemplares.tipo',
                                            'fenotipos.nombre as nombreFenotipo',
                                            'colores.nombre as nombreColor',
                                            'padre.nombre as nombrePadre',
                                            'madre.nombre as nombreMadre'
                                            )
                                    ->join('criaderos', 'ejemplares.criadero_id', '=', 'criaderos.id')
                                    ->join('fenotipos', 'fenotipos.id', '=', 'ejemplares.fenotipo_id')
                                    ->join('colores', 'colores.id', '=', 'ejemplares.color_id')
                                    ->leftJoin('ejemplares as padre', 'padre.id', '=', 'ejemplares.padre_id')
                                    ->leftJoin('ejemplares as madre', 'madre.id', '=', 'ejemplares.madre_id')
                                    ->where('criaderos.propietario_id', $usuario->id)
                                    ->where('ejemplares.tipo', 'LLAMA')
                                    ->get();

            $ejemplaresArray = array();

            foreach ($ejemplares as $key => $eje) {

                $imagenes = EjemplarImagen::where('ejemplar_id', $eje->id)
                                            ->get()
                                            ->pluck('ruta')
                                            ->map(function ($ruta) {
                                                return asset($ruta);
                                            });

                $ejemplar = [
                    "id"               => $eje->id,
                    "padre_id"         => $eje->padre_id,
                    "madre_id"         => $eje->madre_id,
                    "madre_id"         => $eje->madre_id,
                    "fenotipo_id"      => $eje->fenotipo_id,
                    "color_id"         => $eje->color_id,
                    "nombre"           => $eje->nombre,
                    "sexo"             => $eje->sexo,
                    "fecha_nacimiento" => $eje->fecha_nacimiento,
                    "numero_registro"  => $eje->numero_registro,
                    "microchip"        => $eje->microchip,
                    "arete"            => $eje->arete,
                    "tipo"             => $eje->tipo,
                    "nombreFenotipo"   => $eje->nombreFenotipo,
                    "nombreColor"      => $eje->nombreColor,
                    "nombrePadre"      => $eje->nombrePadre,
                    "nombreMadre"      => $eje->nombreMadre,
                    "imagenes"         => $imagenes,

                ];

                array_push($ejemplaresArray, $ejemplar);

            }
            return response()->json([
                'usuario_id' => $usuario->id,
                // 'ejemplares' => $ejemplares
                'ejemplares' => $ejemplaresArray
            ], 200);

        } catch (\Exception  $e) {
            return response()->json(
                [
                    'error' => 'Token inválido o expirado',
                    'message' => $e->getMessage()
                ]
                , 401);
        }
    }

    public function registroEjemplar(Request $request){

        try {

            // Obtener el usuario autenticado desde el token
            $usuario = auth()->user();

            if (!$usuario) {
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }

            // Decodificar el JSON enviado en el campo 'ejemplar'
            $ejemplarData = json_decode($request->input('ejemplar'), true);
            if (!$ejemplarData) {
                return response()->json(['error' => 'Datos inválidos'], 400);
            }

            // SACAMOS EL CRIADERO
            $criadero = Criadero::where('propietario_id', $usuario->id)->first();

            // Crear un nuevo ejemplar con los datos recibidos
            $ejemplar                     = new Ejemplar();
            $ejemplar->nombre             = $ejemplarData['nombre'];
            $ejemplar->usuario_creador_id = $usuario->id;
            $ejemplar->color_id           = $ejemplarData['color_id'];
            $ejemplar->fenotipo_id        = $ejemplarData['fenotipo_id'];
            $ejemplar->tipo               = $ejemplarData['tipo'];
            $ejemplar->tipo_parto         = $ejemplarData['tipo_parto'];
            $ejemplar->sexo               = $ejemplarData['sexo'];
            $ejemplar->fecha_nacimiento   = $ejemplarData['fecha_nacimiento'];
            $ejemplar->microchip          = $ejemplarData['microchip'];
            $ejemplar->arete              = $ejemplarData['arete'];
            $ejemplar->criadero_id        = $criadero ? $criadero->id : null;
            $ejemplar->fecha_registro     = date('Y-m-d H:i:s');
            $ejemplar->numero_registro    = $this->sacarSiguienteNumeroRegistroEjemplar();
            $ejemplar->save();

            // VERIFICAMOS LAS BIOMETRICAS
            if(
                !empty($ejemplarData['reg_biometrico_motivo']) ||
                !empty($ejemplarData['reg_biometrico_fecha']) ||
                !empty($ejemplarData['reg_biometrico_evaluador_id']) ||
                !empty($ejemplarData['reg_biometrico_peso']) ||
                !empty($ejemplarData['reg_biometrico_altura_cruz']) ||
                !empty($ejemplarData['reg_biometrico_altura_grupa']) ||
                !empty($ejemplarData['reg_biometrico_altura_cabeza']) ||
                !empty($ejemplarData['reg_biometrico_ancho_pecho']) ||
                !empty($ejemplarData['reg_biometrico_ancho_isquiones']) ||
                !empty($ejemplarData['reg_biometrico_perimetro_toracico']) ||
                !empty($ejemplarData['reg_biometrico_perimetro_abdominal']) ||
                !empty($ejemplarData['reg_biometrico_largo_cuello']) ||
                !empty($ejemplarData['reg_biometrico_cuello_perimetro_sup']) ||
                !empty($ejemplarData['reg_biometrico_cuello_perimetro_inf']) ||
                !empty($ejemplarData['reg_biometrico_largo_oreja']) ||
                !empty($ejemplarData['reg_biometrico_largo_cola']) ||
                !empty($ejemplarData['reg_biometrico_diametro_cania_ant']) ||
                !empty($ejemplarData['reg_biometrico_diametro_cania_post'])
            ){
                $biometria                       = new Biometria();
                $biometria->usuario_creador_id   = $usuario->id;
                $biometria->ejemplar_id          = $ejemplar->id;
                $biometria->motivo               = $ejemplarData['reg_biometrico_motivo'];
                $biometria->fecha                = $ejemplarData['reg_biometrico_fecha'];
                $biometria->evaluador_id         = $ejemplarData['reg_biometrico_evaluador_id'];
                $biometria->peso                 = $ejemplarData['reg_biometrico_peso'];
                $biometria->altura_cruz          = $ejemplarData['reg_biometrico_altura_cruz'];
                $biometria->altura_grupa         = $ejemplarData['reg_biometrico_altura_grupa'];
                $biometria->altura_cabeza        = $ejemplarData['reg_biometrico_altura_cabeza'];
                $biometria->ancho_pecho          = $ejemplarData['reg_biometrico_ancho_pecho'];
                $biometria->ancho_isquiones      = $ejemplarData['reg_biometrico_ancho_isquiones'];
                $biometria->perimetro_toraxico   = $ejemplarData['reg_biometrico_perimetro_toracico'];
                $biometria->perimetro_abdominal  = $ejemplarData['reg_biometrico_perimetro_abdominal'];
                $biometria->largo_cuello         = $ejemplarData['reg_biometrico_largo_cuello'];
                $biometria->cuello_perimetro_sup = $ejemplarData['reg_biometrico_cuello_perimetro_sup'];
                $biometria->cuello_perimetro_inf = $ejemplarData['reg_biometrico_cuello_perimetro_inf'];
                $biometria->largo_oreja          = $ejemplarData['reg_biometrico_largo_oreja'];
                $biometria->largo_cola           = $ejemplarData['reg_biometrico_largo_cola'];
                $biometria->diametro_cania_ant   = $ejemplarData['reg_biometrico_diametro_cania_ant'];
                $biometria->diametro_cania_post  = $ejemplarData['reg_biometrico_diametro_cania_post'];
                $biometria->save();
            }

            // PARA MORFOLOGICOS
            if(
                !empty($ejemplarData['reg_morfologico_evaluador_id']) ||
                !empty($ejemplarData['reg_morfologico_motivo']) ||
                !empty($ejemplarData['reg_morfologico_fecha']) ||
                !empty($ejemplarData['reg_morfologico_oreja']) ||
                !empty($ejemplarData['reg_morfologico_cuello']) ||
                !empty($ejemplarData['reg_morfologico_cabeza']) ||
                !empty($ejemplarData['reg_morfologico_alzada']) ||
                !empty($ejemplarData['reg_morfologico_largo_cuerpo']) ||
                !empty($ejemplarData['reg_morfologico_amplitud_pecho']) ||
                !empty($ejemplarData['reg_morfologico_fortaleza']) ||
                !empty($ejemplarData['reg_morfologico_balance']) ||
                !empty($ejemplarData['reg_morfologico_canias']) ||
                !empty($ejemplarData['reg_morfologico_copete']) ||
                !empty($ejemplarData['reg_morfologico_linea_superior']) ||
                !empty($ejemplarData['reg_morfologico_grupa'])
            ){

                $morfologico                     = new Morfologico();
                $morfologico->usuario_creador_id = $usuario->id;
                $morfologico->ejemplar_id        = $ejemplar->id;
                $morfologico->evaluador_id       = $ejemplarData['reg_morfologico_evaluador_id'];
                $morfologico->motivo             = $ejemplarData['reg_morfologico_motivo'];
                $morfologico->fecha_evaluacion   = $ejemplarData['reg_morfologico_fecha'];
                $morfologico->oreja              = $ejemplarData['reg_morfologico_oreja'];
                $morfologico->cuello             = $ejemplarData['reg_morfologico_cuello'];
                $morfologico->cabeza             = $ejemplarData['reg_morfologico_cabeza'];
                $morfologico->alzada             = $ejemplarData['reg_morfologico_alzada'];
                $morfologico->largo_cuerpo       = $ejemplarData['reg_morfologico_largo_cuerpo'];
                $morfologico->amplitud_pecho     = $ejemplarData['reg_morfologico_amplitud_pecho'];
                $morfologico->fortaleza          = $ejemplarData['reg_morfologico_fortaleza'];
                $morfologico->balance            = $ejemplarData['reg_morfologico_balance'];
                $morfologico->canias             = $ejemplarData['reg_morfologico_canias'];
                $morfologico->copete             = $ejemplarData['reg_morfologico_copete'];
                $morfologico->linea_superior     = $ejemplarData['reg_morfologico_linea_superior'];
                $morfologico->grupa              = $ejemplarData['reg_morfologico_grupa'];
                $morfologico->save();

            }

            // PARA FIBRAS
            if(
                !empty($ejemplarData['reg_fibra_laboratorio_id']) ||
                !empty($ejemplarData['reg_fibra_equipo_id']) ||
                !empty($ejemplarData['reg_fibra_fecha_muestreo']) ||
                !empty($ejemplarData['reg_fibra_fecha_analisis']) ||
                !empty($ejemplarData['reg_fibra_zona_corporal']) ||
                !empty($ejemplarData['reg_fibra_fd']) ||
                !empty($ejemplarData['reg_fibra_sd']) ||
                !empty($ejemplarData['reg_fibra_cv']) ||
                !empty($ejemplarData['reg_fibra_fc']) ||
                !empty($ejemplarData['reg_fibra_pm']) ||
                !empty($ejemplarData['reg_fibra_mfd'])
            ){

                $anilisis                     = new AnalisisFibra();
                $anilisis->usuario_creador_id = $usuario->id;
                $anilisis->ejemplar_id        = $ejemplar->id;
                $anilisis->laboratorio_id     = $ejemplarData['reg_fibra_laboratorio_id'];
                $anilisis->equipo_id          = $ejemplarData['reg_fibra_equipo_id'];
                $anilisis->fecha_muestreo     = $ejemplarData['reg_fibra_fecha_muestreo'];
                $anilisis->fecha_analisis     = $ejemplarData['reg_fibra_fecha_analisis'];
                $anilisis->zona_corporal      = $ejemplarData['reg_fibra_zona_corporal'];
                $anilisis->fd                 = $ejemplarData['reg_fibra_fd'];
                $anilisis->sd                 = $ejemplarData['reg_fibra_sd'];
                $anilisis->cv                 = $ejemplarData['reg_fibra_cv'];
                $anilisis->fc                 = $ejemplarData['reg_fibra_fc'];
                $anilisis->pm                 = $ejemplarData['reg_fibra_pm'];
                $anilisis->mfd                = $ejemplarData['reg_fibra_mfd'];
                $anilisis->save();

            }

            // PARA ESQUILAS
            if(
                !empty($ejemplarData['reg_esquila_esquilador_id']) ||
                !empty($ejemplarData['reg_esquila_fecha']) ||
                !empty($ejemplarData['reg_esquila_tipo_esquila']) ||
                !empty($ejemplarData['reg_esquila_inca_esquila']) ||
                !empty($ejemplarData['reg_esquila_peso_manto']) ||
                !empty($ejemplarData['reg_esquila_peso_cuello']) ||
                !empty($ejemplarData['reg_esquila_peso_braga']) ||
                !empty($ejemplarData['reg_esquila_peso_total']) ||
                !empty($ejemplarData['reg_esquila_longitud']) ||
                !empty($ejemplarData['reg_esquila_observacion'])
            ){

                $esquila                     = new Esquila();
                $esquila->usuario_creador_id = $usuario->id;
                $esquila->ejemplar_id        = $ejemplar->id;
                $esquila->esquilador_id      = $ejemplarData['reg_esquila_esquilador_id'];
                $esquila->fecha              = $ejemplarData['reg_esquila_fecha'];
                $esquila->tipo_esquila       = $ejemplarData['reg_esquila_tipo_esquila'];
                $esquila->inca_esquila       = $ejemplarData['reg_esquila_inca_esquila'];
                $esquila->peso_manto         = $ejemplarData['reg_esquila_peso_manto'];
                $esquila->peso_cuello        = $ejemplarData['reg_esquila_peso_cuello'];
                $esquila->peso_braga         = $ejemplarData['reg_esquila_peso_braga'];
                $esquila->peso_total         = $ejemplarData['reg_esquila_peso_total'];
                $esquila->longitud           = $ejemplarData['reg_esquila_longitud'];
                $esquila->observacion        = $ejemplarData['reg_esquila_observacion'];
                $esquila->save();

            }

            // MEIDCAIONES
            if(
                !empty($ejemplarData['reg_medicacion_producto_veterrinario_id']) ||
                !empty($ejemplarData['reg_medicacion_responsable_id']) ||
                !empty($ejemplarData['reg_medicacion_fecha']) ||
                !empty($ejemplarData['reg_medicacion_tipo']) ||
                !empty($ejemplarData['reg_medicacion_docis']) ||
                !empty($ejemplarData['reg_medicacion_unidades']) ||
                !empty($ejemplarData['reg_medicacion_observacion'])
            ){

                $medicacion                          = new Medicacion();
                $medicacion->usuario_creador_id      = $usuario->id;
                $medicacion->ejemplar_id             = $ejemplar->id;
                $medicacion->producto_veterinario_id = $ejemplarData['reg_medicacion_producto_veterrinario_id'];
                $medicacion->responsable_id          = $ejemplarData['reg_medicacion_responsable_id'];
                $medicacion->fecha                   = $ejemplarData['reg_medicacion_fecha'];
                $medicacion->tipo                    = $ejemplarData['reg_medicacion_tipo'];
                $medicacion->dosis                   = $ejemplarData['reg_medicacion_docis'];
                $medicacion->unidades                = $ejemplarData['reg_medicacion_unidades'];
                $medicacion->observacion             = $ejemplarData['reg_medicacion_observacion'];
                $medicacion->save();

            }

            // Si hay imágenes, guardarlas
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $imagen) {

                    // Obtener las dimensiones originales de la imagen
                    list($anchoOriginal, $altoOriginal) = getimagesize($imagen);

                    // Establecer un ancho máximo para la imagen (por ejemplo, 800px)
                    $anchoMaximo = 800;
                    $altoMaximo = ($altoOriginal / $anchoOriginal) * $anchoMaximo;

                    // Crear una nueva imagen redimensionada
                    $image = imagecreatefromstring(file_get_contents($imagen));

                    // Redimensionar la imagen manteniendo la relación de aspecto
                    $imagenRedimensionada = imagescale($image, $anchoMaximo, $altoMaximo);

                    // Crear un nombre único para la imagen
                    $nombreArchivo = time() . '_' . Str::uuid() . '.' . $imagen->getClientOriginalExtension();

                    // Guardar la imagen redimensionada
                    $ruta = storage_path("app/public/imagenes/{$ejemplar->tipo}/" . $nombreArchivo);
                    imagejpeg($imagenRedimensionada, $ruta, 10); // 75 es la calidad de la imagen

                    // Liberar memoria
                    imagedestroy($image);
                    imagedestroy($imagenRedimensionada);

                    // Crear el registro de la imagen en la base de datos
                    $ejemplar->imagenes()->create([
                        'usuario_creador_id' => 1,
                        'ruta' => Storage::url("imagenes/{$ejemplar->tipo}/" . $nombreArchivo),
                        'estado' => 1,
                    ]);

                }
            }

            return response()->json([
                'mensaje' => 'Ejemplar registrado con éxito',
                'ejemplar' => $ejemplar
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al registrar el ejemplar',
                'detalle' => $e->getMessage()
            ], 500);
        }

    }

    // ************************* ALPACAS *************************
    public function ejemplaresAlpacasUsuario(){
        try {
            $usuario = JWTAuth::parseToken()->authenticate();

            if (!$usuario)
                return response()->json(['error' => 'Usuario no encontrado'], 404);

            $ejemplares = Ejemplar::select(
                                            'ejemplares.id',
                                            'ejemplares.padre_id',
                                            'ejemplares.madre_id',
                                            'ejemplares.madre_id',
                                            'ejemplares.fenotipo_id',
                                            'ejemplares.color_id',
                                            'ejemplares.nombre',
                                            'ejemplares.sexo',
                                            'ejemplares.fecha_nacimiento',
                                            'ejemplares.numero_registro',
                                            'ejemplares.microchip',
                                            'ejemplares.arete',
                                            'ejemplares.tipo',
                                            'fenotipos.nombre as nombreFenotipo',
                                            'colores.nombre as nombreColor',
                                            'padre.nombre as nombrePadre',
                                            'madre.nombre as nombreMadre'
                                            )
                                    ->join('criaderos', 'ejemplares.criadero_id', '=', 'criaderos.id')
                                    ->join('fenotipos', 'fenotipos.id', '=', 'ejemplares.fenotipo_id')
                                    ->join('colores', 'colores.id', '=', 'ejemplares.color_id')
                                    ->leftJoin('ejemplares as padre', 'padre.id', '=', 'ejemplares.padre_id')
                                    ->leftJoin('ejemplares as madre', 'madre.id', '=', 'ejemplares.madre_id')
                                    ->where('criaderos.propietario_id', $usuario->id)
                                    ->where('ejemplares.tipo', 'ALPACA')
                                    ->get();

            $ejemplaresArray = array();

            foreach ($ejemplares as $key => $eje) {

                $imagenes = EjemplarImagen::where('ejemplar_id', $eje->id)
                                            ->get()
                                            ->pluck('ruta')
                                            ->map(function ($ruta) {
                                                return asset($ruta);
                                            });

                $ejemplar = [
                    "id"               => $eje->id,
                    "padre_id"         => $eje->padre_id,
                    "madre_id"         => $eje->madre_id,
                    "madre_id"         => $eje->madre_id,
                    "fenotipo_id"      => $eje->fenotipo_id,
                    "color_id"         => $eje->color_id,
                    "nombre"           => $eje->nombre,
                    "sexo"             => $eje->sexo,
                    "fecha_nacimiento" => $eje->fecha_nacimiento,
                    "numero_registro"  => $eje->numero_registro,
                    "microchip"        => $eje->microchip,
                    "arete"            => $eje->arete,
                    "tipo"             => $eje->tipo,
                    "nombreFenotipo"   => $eje->nombreFenotipo,
                    "nombreColor"      => $eje->nombreColor,
                    "nombrePadre"      => $eje->nombrePadre,
                    "nombreMadre"      => $eje->nombreMadre,
                    "imagenes"         => $imagenes,

                ];

                array_push($ejemplaresArray, $ejemplar);

            }
            return response()->json([
                'usuario_id' => $usuario->id,
                // 'ejemplares' => $ejemplares
                'ejemplares' => $ejemplaresArray
            ], 200);

        } catch (\Exception  $e) {
            return response()->json(
                [
                    'error' => 'Token inválido o expirado',
                    'message' => $e->getMessage()
                ]
                , 401);
        }
    }


    // **************************** FUNCIONES PRIVADAS *****************************
    private function sacarSiguienteNumeroRegistroEjemplar(){
        $numero = 0;
        $registro = Ejemplar::latest()->first();
        $numero = $registro ? $registro->numero_registro + 1 : $numero + 1;
        return $numero;
    }
}
