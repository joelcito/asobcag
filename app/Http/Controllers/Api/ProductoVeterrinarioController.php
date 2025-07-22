<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductoVeterinario;
use App\Utils\Respuesta;
use Illuminate\Http\Request;

class ProductoVeterrinarioController extends Controller
{
    public function getProductoVeterrinarios(){

        try {

            $productoVeterrinarios = ProductoVeterinario::select('id', 'nombre')->get();

            $data = Respuesta::success($productoVeterrinarios, "Datos obtenidos correctamente");

        } catch (\Exception $e) {
            $data = Respuesta::error(null, $e->getMessage());
        }

        return response()->json($data, 200);
    }
}
