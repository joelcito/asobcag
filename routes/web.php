<?php

use App\Http\Controllers\EjemplarController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RazaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/ejemplar')->group(function(){
        Route::get('/formulario/{ejemplar_id}', [EjemplarController::class, 'formulario']);
        Route::post('/guardar', [EjemplarController::class, 'guardar']);
        Route::get('/listado', [EjemplarController::class, 'listado']);
        Route::post('/ajaxListado', [EjemplarController::class, 'ajaxListado']);
        Route::post('/buscarEjemplar', [EjemplarController::class, 'buscarEjemplar']);
        Route::prefix('/camada')->group(function(){
            Route::get('/formularioCamada', [EjemplarController::class, 'formularioCamada']);
        });
    });

    Route::prefix('/raza')->group(function(){
        Route::get('/listado', [RazaController::class, 'listado']);
        Route::post('/ajaxListado', [RazaController::class, 'ajaxListado']);
        Route::post('/guardarRaza', [RazaController::class, 'guardarRaza']);
    });

    Route::prefix('/rol')->group(function(){
        Route::get('/listado', [RolController::class, 'listado']);
        Route::post('/ajaxListado', [RolController::class, 'ajaxListado']);
        Route::post('/guardarRol', [RolController::class, 'guardarRol']);
    });

    Route::prefix('/propietario')->group(function(){
        Route::get('/listadoPropietario', [UserController::class, 'listadoPropietario']);
        Route::post('/ajaxListadoPropietario', [UserController::class, 'ajaxListadoPropietario']);
        Route::post('/guardarPropietario', [UserController::class, 'guardarPropietario']);
    });

    Route::prefix('/localidad')->group(function(){
        Route::get('/listadoPais', [LocalidadController::class, 'listadoPais']);
        Route::post('/ajaxListadoPais', [LocalidadController::class, 'ajaxListadoPais']);
        Route::post('/guardarPais', [LocalidadController::class, 'guardarPais']);

        Route::post('/ajaxListadoDepartamento', [LocalidadController::class, 'ajaxListadoDepartamento']);
        Route::post('/guardarDepartamento', [LocalidadController::class, 'guardarDepartamento']);

        Route::post('/ajaxListadoProvincia', [LocalidadController::class, 'ajaxListadoProvincia']);
        Route::post('/guardarProvincia', [LocalidadController::class, 'guardarProvincia']);

        Route::post('/ajaxListadoMunicipio', [LocalidadController::class, 'ajaxListadoMunicipio']);
        Route::post('/guardarMunicipio', [LocalidadController::class, 'guardarMunicipio']);

        Route::post('/ajaxListadoComunidad', [LocalidadController::class, 'ajaxListadoComunidad']);
        Route::post('/guardarComunidad', [LocalidadController::class, 'guardarComunidad']);
    });
});

require __DIR__.'/auth.php';
