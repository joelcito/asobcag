<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Criadero;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Ejemplar;
use App\Models\EjemplarImagen;
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

            // Si hay imágenes, guardarlas
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $imagen) {
                    $nombreArchivo = time() . '_' . Str::uuid() . '.' . $imagen->getClientOriginalExtension();

                    // $ruta = $imagen->storeAs("public/imagenes/{$ejemplar->tipo}", $nombreArchivo);
                    // // Crear el registro de la imagen en la base de datos
                    // $ejemplar->imagenes()->create([
                    //     'usuario_creador_id' => 1,
                    //     'ruta' => Storage::url("imagenes/{$ejemplar->tipo}/" . $nombreArchivo),
                    //     'estado' => 1,
                    // ]);

                    // Procesar imagen con Intervention
                    $imagenProcesada = Image::make($imagen)
                                            ->resize(1024, 1024, function ($constraint) {
                                                $constraint->aspectRatio();
                                                $constraint->upsize();
                                            })
                                            ->encode('webp', 80); // WebP con calidad 80%

                    // Guardar imagen en storage
                    $ruta = "public/imagenes/{$ejemplar->tipo}/$nombreArchivo";
                    Storage::put($ruta, (string) $imagenProcesada);

                    // Guardar referencia en la base de datos
                    $ejemplar->imagenes()->create([
                        'usuario_creador_id' => $usuario->id,
                        'ruta' => Storage::url("imagenes/{$ejemplar->tipo}/$nombreArchivo"),
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
