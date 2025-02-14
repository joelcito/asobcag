<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RazaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CriaderoController;
use App\Http\Controllers\EjemplarController;
use App\Http\Controllers\LocalidadController;

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
    Route::prefix('/ingreso')->group(function(){
        Route::get('/usuario', [UserController::class, 'usuario'])->name('usuario');
        Route::post('/ajaxListadoUsuario', [UserController::class, 'ajaxListadoUsuario'])->name('ajaxListadoUsuario');
        Route::post('/guardarUsuario', [userController::class, 'guardarUsuario'])->name('guardarUsuario');
        
        Route::get('/clienteProvedor', [CriaderoController::class, 'clienteProvedor'])->name('clienteProvedor');
        Route::post('/ajaxListadoClienteProvedor', [CriaderoController::class, 'ajaxListadoClienteProvedor'])->name('ajaxListadoClienteProvedor');
        Route::post('/guardarClienteProvedor', [CriaderoController::class, 'guardarClienteProvedor'])->name('guardarClienteProvedor');

        Route::get('/fundador', [EjemplarController::class, 'fundador'])->name('fundador');
        Route::post('/ajaxListadoFundador', [EjemplarController::class, 'ajaxListadoFundador'])->name('ajaxListadoFundador');
        Route::post('/guardarFundador', [EjemplarController::class, 'guardarFundador'])->name('guardarFundador');

    });

    Route::prefix('/ejemplar')->group(function(){
        Route::get('/formulario/{ejemplar_id}', [EjemplarController::class, 'formulario']);
        Route::post('/guardar', [EjemplarController::class, 'guardar']);
        Route::get('/listado', [EjemplarController::class, 'listado']);
        Route::post('/ajaxListado', [EjemplarController::class, 'ajaxListado']);
        Route::post('/buscarEjemplar', [EjemplarController::class, 'buscarEjemplar']);
        Route::prefix('/camada')->group(function(){
            Route::get('/formularioCamada', [EjemplarController::class, 'formularioCamada']);
            Route::post('/guardarCamada', [EjemplarController::class, 'guardarCamada']);
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
