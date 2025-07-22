<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equipo;
use App\Utils\Respuesta;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function getEquipos(){

        try {

            $equipos = Equipo::select('id', 'nombre')->get();

            $data = Respuesta::success($equipos, "Datos obtenidos correctamente");

        } catch (\Exception $e) {
            $data = Respuesta::error(null, $e->getMessage());
        }

        return response()->json($data, 200);
    }
}
