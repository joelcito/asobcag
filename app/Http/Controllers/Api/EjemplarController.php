<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Ejemplar;
use App\Models\EjemplarImagen;

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
                                            'ejemplares.tipo'
                                            )
                                    ->join('criaderos', 'ejemplares.criadero_id', '=', 'criaderos.id')
                                    ->where('criaderos.propietario_id', $usuario->id)->get();

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

        $ejemplar         = new Ejemplar();
        $ejemplar->nombre = $request->input('nombre');
        $ejemplar->save();

        return response()->json([
            'ejemplare' => $ejemplar
        ], 200);

    }
}
