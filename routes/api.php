<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EjemplarController;
use App\Http\Controllers\Api\EquipoController;
use App\Http\Controllers\Api\FenotipoController;
use App\Http\Controllers\Api\LaboratorioController;
use App\Http\Controllers\Api\ProductoVeterrinarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']); // Login con JWT
Route::post('/refresh-token', [AuthController::class, 'refreshToken']);

// Rutas protegidas con JWT
Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/me', [UserController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/getUsuarios', [UserController::class, 'getUsuarios']);

    // EJEMPLARES
    Route::post('/ejemplaresUsuario', [EjemplarController::class, 'ejemplaresUsuario']);
    Route::post('/ejemplaresAlpacasUsuario', [EjemplarController::class, 'ejemplaresAlpacasUsuario']);
    Route::post('/registroEjemplar', [EjemplarController::class, 'registroEjemplar']);

    // FENOTIPOS
    Route::get('/getFenotipos', [FenotipoController::class, 'getFenotipos']);

    // COLORES
    Route::get('/getColores', [ColorController::class, 'getColores']);

    // LABORATORIOS
    Route::get('/getLaboratorios', [LaboratorioController::class, 'getLaboratorios']);

    // EQUIPOS
    Route::get('/getEquipos', [EquipoController::class, 'getEquipos']);

    // PRODUCTO VETERRINARIO
    Route::get('/getProductoVeterrinarios', [ProductoVeterrinarioController::class, 'getProductoVeterrinarios']);
});


