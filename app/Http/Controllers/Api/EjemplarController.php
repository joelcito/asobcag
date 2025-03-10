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

            // $ejemplares = Ejemplar::select(
            //                                 'ejemplares.id',
            //                                 'ejemplares.padre_id',
            //                                 'ejemplares.madre_id',
            //                                 'ejemplares.madre_id',
            //                                 'ejemplares.fenotipo_id',
            //                                 'ejemplares.color_id',
            //                                 'ejemplares.nombre',
            //                                 'ejemplares.sexo',
            //                                 'ejemplares.fecha_nacimiento',
            //                                 'ejemplares.numero_registro',
            //                                 'ejemplares.microchip',
            //                                 'ejemplares.arete',
            //                                 'ejemplares.tipo'
            //                                 )
            //                         ->join('criaderos', 'ejemplares.criadero_id', '=', 'criaderos.id')
            //                         ->where('criaderos.propietario_id', $usuario->id)->get();

            // $ejemplares = Ejemplar::select(
            //     'ejemplares.id',
            //     'ejemplares.padre_id',
            //     'ejemplares.madre_id',
            //     'ejemplares.fenotipo_id',
            //     'ejemplares.color_id',
            //     'ejemplares.nombre',
            //     'ejemplares.sexo',
            //     'ejemplares.fecha_nacimiento',
            //     'ejemplares.numero_registro',
            //     'ejemplares.microchip',
            //     'ejemplares.arete',
            //     'ejemplares.tipo'
            // )
            // ->join('criaderos', 'ejemplares.criadero_id', '=', 'criaderos.id')
            // ->leftJoin('ejemplar_imagenes', 'ejemplares.id', '=', 'ejemplar_imagenes.ejemplar_id') // Unir las imágenes
            // ->where('criaderos.propietario_id', $usuario->id)
            // ->get()
            // ->map(function ($ejemplar) {
            //     $ejemplar->imagenes = EjemplarImagen::where('ejemplar_id', $ejemplar->id)
            //         ->pluck('ruta');
            //     return asset().$ejemplar;
            // });

            $ejemplares = Ejemplar::select(
                'ejemplares.id',
                'ejemplares.padre_id',
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
            ->leftJoin('ejemplar_imagenes', 'ejemplares.id', '=', 'ejemplar_imagenes.ejemplar_id') // Unir las imágenes
            ->where('criaderos.propietario_id', $usuario->id)
            ->get()
            ->map(function ($ejemplar) {
                // Obtener las imágenes y devolver la URL completa con asset()
                $ejemplar->imagenes = EjemplarImagen::where('ejemplar_id', $ejemplar->id)
                    ->pluck('ruta') // Obtener solo el campo 'ruta'
                    ->map(function ($ruta) {
                        return asset($ruta); // Concatenar el dominio y la ruta de la imagen
                    });
                return $ejemplar;
            });



            return response()->json([
                'usuario_id' => $usuario->id,
                'ejemplares' => $ejemplares
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
}
