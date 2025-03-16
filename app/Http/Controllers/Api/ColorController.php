<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Utils\Respuesta;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function getColores(){

        try {

            $colores = Color::select('id', 'nombre')->get();

            $data = Respuesta::success($colores, "Datos obtenidos correctamente");

        } catch (\Exception $e) {
            $data = Respuesta::error(null, $e->getMessage());
        }

        return response()->json($data, 200);
    }
}
