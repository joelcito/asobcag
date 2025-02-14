<?php

namespace App\Http\Controllers;

use App\Utils\Respuesta;
use Illuminate\Http\Request;
use App\Models\ProductoVeterinario;
use Illuminate\Support\Facades\Auth;

class ProductoVeterinarioController extends Controller
{
    public function listado(Request $request){
        return view('productoVeterinario.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $productos = ProductoVeterinario::all();
            $valores = [
                'listado' => view('productoVeterinario.ajaxListado')->with(compact('productos'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    public function guardarProductoVeterinario(Request $request){
        if($request->ajax()){

            $nombre      = $request->input('nombre');
            $ingrediente_activo      = $request->input('ingrediente_activo');
            $presentacion      = $request->input('presentacion');
            $usuario     = Auth::user();

            $producto                     = new ProductoVeterinario();
            $producto->usuario_creador_id = $usuario->id;
            $producto->nombre             = $nombre;
            $producto->ingrediente_activo = $ingrediente_activo;
            $producto->presentacion       = $presentacion;
            $producto->save();

            $data = Respuesta::success(null, "Datos obtenidos correctamente");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }
}
