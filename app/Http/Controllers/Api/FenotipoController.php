<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fenotipo;
use App\Utils\Respuesta;
use Illuminate\Http\Request;

class FenotipoController extends Controller
{

    public function getFenotipos(){

        try {

            $fenotipos = Fenotipo::select('id', 'nombre')->get();

            $data = Respuesta::success($fenotipos, "Datos obtenidos correctamente");

        } catch (\Exception $e) {
            $data = Respuesta::error(null, $e->getMessage());
        }

        return response()->json($data, 200);
    }
}
