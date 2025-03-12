<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        // Obtener el usuario autenticado
        $user = auth()->user();

        // Generar un nuevo token con claims personalizados
        $customClaims = [
            'user_id' => $user->id // Asegúrate de que la columna `rol` exista en tu BD
        ];

        $token = JWTAuth::customClaims($customClaims)->fromUser($user);

        // Refresh Token (Dura 10 años, se guarda en la BD)
        $refreshToken = bin2hex(random_bytes(50)); // Genera un token seguro
        $user->refresh_token = $refreshToken;
        $user->save();

        // Devolver datos adicionales junto con el token
        return response()->json([
            'token' => $token,
            'refresh_token' => $refreshToken,
            'usuario' => [
                'id'         => $user->id,
                'nombres'    => $user->nombres,
                'ap_paterno' => $user->ap_paterno,
                'ap_materno' => $user->ap_materno,
                'email'      => $user->email,
                'role'       => $user->rol,          // Asegúrate de que la columna `role` exista en tu BD
                // 'created_at' => $user->created_at,
            ],
            'expires_in' => config('jwt.ttl') * 60
        ]);

    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Cierre de sesión exitoso']);
    }

    public function refreshToken(Request $request){

        $request->validate(['refresh_token' => 'required']);

        $user = User::where('refresh_token', $request->refresh_token)->first();

        if (!$user) {
            return response()->json(['error' => 'Refresh Token inválido'], 401);
        }

        // Claims personalizados
        $customClaims = [
            'user_id' => $user->id
        ];

        // Generar un nuevo Access Token con Claims
        $newAccessToken = JWTAuth::claims($customClaims)->fromUser($user);

        return response()->json([
            'access_token' => $newAccessToken,
            'expires_in' => config('jwt.ttl') * 60
        ]);
    }
}
