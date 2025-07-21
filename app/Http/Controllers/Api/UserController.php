<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Utils\Respuesta;

class UserController extends Controller
{
    public function me()
    {
        return response()->json(Auth::user());
    }

    public function getUsuarios(){
        try {

            $usuarios = User::select('id', 'name')->get();

            $data = Respuesta::success($usuarios, "Datos obtenidos correctamente");

        } catch (\Exception $e) {
            $data = Respuesta::error(null, $e->getMessage());
        }

        return response()->json($data, 200);

    }

}
