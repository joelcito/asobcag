<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laboratorio;
use App\Utils\Respuesta;
use Illuminate\Http\Request;

class LaboratorioController extends Controller
{
    public function getLaboratorios(){

        try {

            $laboratorios = Laboratorio::select('id', 'nombre')->get();

            $data = Respuesta::success($laboratorios, "Datos obtenidos correctamente");

        } catch (\Exception $e) {
            $data = Respuesta::error(null, $e->getMessage());
        }

        return response()->json($data, 200);
    }
}
