<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RazaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FeriaController;
use App\Http\Controllers\MetodoController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\EmpadreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CampaniaController;
use App\Http\Controllers\CriaderoController;
use App\Http\Controllers\EjemplarController;
use App\Http\Controllers\FenotipoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\MedicacionController;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\TipoEmpadreController;
use App\Http\Controllers\CategoriaFeriaController;
use App\Http\Controllers\ProductoVeterinarioController;

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
    Route::prefix('/usuario')->group(function(){
        Route::get('/listado', [UserController::class, 'listado'])->name('usuario.listado');
        Route::post('/ajaxListado', [UserController::class, 'ajaxListado'])->name('usuario.ajaxListado');
        Route::post('/guardarUsuario', [userController::class, 'guardarUsuario'])->name('usuario.guardarUsuario');
    });

    Route::prefix('/criadero')->group(function(){
        Route::get('/listado', [CriaderoController::class, 'listado'])->name('criadero.listado');
        Route::post('/ajaxListado', [CriaderoController::class, 'ajaxListado'])->name('criadero.ajaxListado');
        Route::post('/guardarCriadero', [CriaderoController::class, 'guardarCriadero'])->name('criadero.guardarCriadero');
    });

    Route::prefix('/ejemplar')->group(function(){
        Route::get('/listado', [EjemplarController::class, 'listado'])->name('ejemplar.listado');
        Route::post('/ajaxListado', [EjemplarController::class, 'ajaxListado'])->name('ejemplar.ajaxListado');
        Route::post('/guardarEjemplar', [EjemplarController::class, 'guardarEjemplar'])->name('ejemplar.guardarEjemplar');
        Route::get('/formulario', [EjemplarController::class, 'formulario'])->name('ejemplar.formulario');
        Route::get('/formularioNacimiento', [EjemplarController::class, 'formularioNacimiento'])->name('ejemplar.formularioNacimiento');
    });

    Route::prefix('/empadre')->group(function(){
        Route::get('/listado', [EmpadreController::class, 'listado'])->name('empadre.listado');
        Route::post('/ajaxListado', [EmpadreController::class, 'ajaxListado'])->name('empadre.ajaxListado');
        Route::post('/guardarEmpadre', [EmpadreController::class, 'guardarEmpadre'])->name('empadre.guardarEmpadre');
    });

    Route::prefix('/diagnostico')->group(function(){
        Route::get('/listado', [DiagnosticoController::class, 'listado'])->name('diagnostico.listado');
        Route::post('/ajaxListado', [DiagnosticoController::class, 'ajaxListado'])->name('diagnostico.ajaxListado');
        Route::post('/guardarDiagnostico', [DiagnosticoController::class, 'guardarDiagnostico'])->name('diagnostico.guardarDiagnostico');
    });

    Route::prefix('/medicacion')->group(function(){
        Route::get('/listado', [MedicacionController::class, 'listado'])->name('medicacion.listado');
        Route::post('/ajaxListado', [MedicacionController::class, 'ajaxListado'])->name('medicacion.ajaxListado');
        Route::post('/guardarMedicacion', [MedicacionController::class, 'guardarMedicacion'])->name('medicacion.guardarMedicacion');
    });

    Route::prefix('/raza')->group(function(){
        Route::get('/listado', [RazaController::class, 'listado'])->name('raza.listado');
        Route::post('/ajaxListado', [RazaController::class, 'ajaxListado'])->name('raza.ajaxListado');
        Route::post('/guardarRaza', [RazaController::class, 'guardarRaza'])->name('raza.guardarRaza');
    });

    Route::prefix('/rol')->group(function(){
        Route::get('/listado', [RolController::class, 'listado'])->name('rol.listado');
        Route::post('/ajaxListado', [RolController::class, 'ajaxListado'])->name('rol.ajaxListado');
        Route::post('/guardarRol', [RolController::class, 'guardarRol'])->name('rol.guardarRol');
    });

    Route::prefix('/color')->group(function(){
        Route::get('/listado', [ColorController::class, 'listado'])->name('color.listado');
        Route::post('/ajaxListado', [ColorController::class, 'ajaxListado'])->name('color.ajaxListado');
        Route::post('/guardarColor', [ColorController::class, 'guardarColor'])->name('color.guardarColor');
    });

    Route::prefix('/fenotipo')->group(function(){
        Route::get('/listado', [FenotipoController::class, 'listado'])->name('fenotipo.listado');
        Route::post('/ajaxListado', [FenotipoController::class, 'ajaxListado'])->name('fenotipo.ajaxListado');
        Route::post('/guardarFenotipo', [FenotipoController::class, 'guardarFenotipo'])->name('fenotipo.guardarFenotipo');
    });

    Route::prefix('/categoria')->group(function(){
        Route::get('/listado', [CategoriaController::class, 'listado'])->name('categoria.listado');
        Route::post('/ajaxListado', [CategoriaController::class, 'ajaxListado'])->name('categoria.ajaxListado');
        Route::post('/guardarCategoria', [CategoriaController::class, 'guardarCategoria'])->name('categoria.guardarCategoria');
    });

    Route::prefix('/categoriaFeria')->group(function(){
        Route::get('/listado', [CategoriaFeriaController::class, 'listado'])->name('categoriaFeria.listado');
        Route::post('/ajaxListado', [CategoriaFeriaController::class, 'ajaxListado'])->name('categoriaFeria.ajaxListado');
        Route::post('/guardarCategoriaFeria', [CategoriaFeriaController::class, 'guardarCategoriaFeria'])->name('categoriaFeria.guardarCategoriaFeria');
    });

    Route::prefix('/feria')->group(function(){
        Route::get('/listado', [FeriaController::class, 'listado'])->name('feria.listado');
        Route::post('/ajaxListado', [FeriaController::class, 'ajaxListado'])->name('feria.ajaxListado');
        Route::post('/guardarFeria', [FeriaController::class, 'guardarFeria'])->name('feria.guardarFeria');
    });

    Route::prefix('/premio')->group(function(){
        Route::get('/listado', [PremioController::class, 'listado'])->name('premio.listado');
        Route::post('/ajaxListado', [PremioController::class, 'ajaxListado'])->name('premio.ajaxListado');
        Route::post('/guardarPremio', [PremioController::class, 'guardarPremio'])->name('premio.guardarPremio');
    });
    
    Route::prefix('/productoVeterinario')->group(function(){
        Route::get('/listado', [ProductoVeterinarioController::class, 'listado'])->name('productoVeterinario.listado');
        Route::post('/ajaxListado', [ProductoVeterinarioController::class, 'ajaxListado'])->name('productoVeterinario.ajaxListado');
        Route::post('/guardarProductoVeterinario', [ProductoVeterinarioController::class, 'guardarProductoVeterinario'])->name('productoVeterinario.guardarProductoVeterinario');
    });

    Route::prefix('/metodo')->group(function(){
        Route::get('/listado', [MetodoController::class, 'listado'])->name('metodo.listado');
        Route::post('/ajaxListado', [MetodoController::class, 'ajaxListado'])->name('metodo.ajaxListado');
        Route::post('/guardarMetodo', [MetodoController::class, 'guardarMetodo'])->name('metodo.guardarMetodo');
    });

    Route::prefix('/campania')->group(function(){
        Route::get('/listado', [CampaniaController::class, 'listado'])->name('campania.listado');
        Route::post('/ajaxListado', [CampaniaController::class, 'ajaxListado'])->name('campania.ajaxListado');
        Route::post('/guardarCampania', [CampaniaController::class, 'guardarCampania'])->name('campania.guardarCampania');
    });

    Route::prefix('/tipoEmpadre')->group(function(){
        Route::get('/listado', [TipoEmpadreController::class, 'listado'])->name('tipoEmpadre.listado');
        Route::post('/ajaxListado', [TipoEmpadreController::class, 'ajaxListado'])->name('tipoEmpadre.ajaxListado');
        Route::post('/guardarTipoEmpadre', [TipoEmpadreController::class, 'guardarTipoEmpadre'])->name('tipoEmpadre.guardarTipoEmpadre');
    });

   /*  Route::prefix('/ejemplar')->group(function(){
        Route::get('/formulario/{ejemplar_id}', [EjemplarController::class, 'formulario']);
        Route::post('/guardar', [EjemplarController::class, 'guardar']);
        Route::get('/listado', [EjemplarController::class, 'listado']);
        Route::post('/ajaxListado', [EjemplarController::class, 'ajaxListado']);
        Route::post('/buscarEjemplar', [EjemplarController::class, 'buscarEjemplar']);
        Route::prefix('/camada')->group(function(){
            Route::get('/formularioCamada', [EjemplarController::class, 'formularioCamada']);
            Route::post('/guardarCamada', [EjemplarController::class, 'guardarCamada']);
        });
    }); */    

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

        Route::post('/buscarHijos', [LocalidadController::class, 'buscarHijos']);
    });
});

require __DIR__.'/auth.php';
