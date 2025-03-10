<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Ejemplar;

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
