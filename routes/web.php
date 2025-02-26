<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RazaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FeriaController;
use App\Http\Controllers\EquipoController;
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
use App\Http\Controllers\LaboratorioController;
use App\Http\Controllers\TipoEmpadreController;
use App\Http\Controllers\FeriaEjemplarController;
use App\Http\Controllers\CategoriaFeriaController;
use App\Http\Controllers\HomeController;
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
    return redirect('home');
    // return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index']);

    Route::prefix('/usuario')->group(function(){
        Route::get('/listado', [UserController::class, 'listado'])->name('usuario.listado');
        Route::post('/ajaxListado', [UserController::class, 'ajaxListado'])->name('usuario.ajaxListado');
        Route::post('/guardarUsuario', [UserController::class, 'guardarUsuario'])->name('usuario.guardarUsuario');
        Route::post('/eliminarUsuario', [UserController::class, 'eliminarUsuario'])->name('usuario.eliminarUsuario');
        Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('usuario.resetPassword');
    });

    Route::prefix('/criadero')->group(function(){
        Route::get('/listado', [CriaderoController::class, 'listado'])->name('criadero.listado');
        Route::post('/ajaxListado', [CriaderoController::class, 'ajaxListado'])->name('criadero.ajaxListado');
        Route::post('/guardarCriadero', [CriaderoController::class, 'guardarCriadero'])->name('criadero.guardarCriadero');
        Route::post('/eliminarCriadero', [CriaderoController::class, 'eliminarCriadero'])->name('criadero.eliminarCriadero');
        Route::get('/detalle/{criadero_id}', [CriaderoController::class, 'detalle'])->name('criadero.detalle');
        Route::get('/exportEjemplares/{criadero_id}', [CriaderoController::class, 'exportEjemplares'])->name('criadero.exportEjemplares');
    });

    Route::prefix('/ejemplar')->group(function(){
        Route::get('/listado/{tipo}', [EjemplarController::class, 'listado'])->where('tipo', 'LLAMA|ALPACA')->name('ejemplar.listado');
        Route::post('/ajaxListado', [EjemplarController::class, 'ajaxListado'])->name('ejemplar.ajaxListado');
        Route::post('/guardarEjemplar', [EjemplarController::class, 'guardarEjemplar'])->name('ejemplar.guardarEjemplar');
        Route::get('/formulario/{tipo}/{ejemplar_id}', [EjemplarController::class, 'formulario'])->where('tipo', 'LLAMA|ALPACA')->name('ejemplar.formulario');
        Route::get('/detalle/{ejemplar_id}', [EjemplarController::class, 'detalle'])->name('ejemplar.detalle');
        Route::post('/ajaxListadoBiometria', [EjemplarController::class, 'ajaxListadoBiometria'])->name('ejemplar.ajaxListadoBiometria');
        Route::post('/guardarBiometria', [EjemplarController::class, 'guardarBiometria'])->name('ejemplar.guardarBiometria');
        Route::post('/ajaxListadoMorfilogicos', [EjemplarController::class, 'ajaxListadoMorfilogicos'])->name('ejemplar.ajaxListadoMorfilogicos');
        Route::post('/guardarMorfologico', [EjemplarController::class, 'guardarMorfologico'])->name('ejemplar.guardarMorfologico');
        Route::post('/ajaxListadoFibras', [EjemplarController::class, 'ajaxListadoFibras'])->name('ejemplar.ajaxListadoFibras');
        Route::post('/guardarFibra', [EjemplarController::class, 'guardarFibra'])->name('ejemplar.guardarFibra');
        Route::post('/ajaxListadoEsquila', [EjemplarController::class, 'ajaxListadoEsquila'])->name('ejemplar.ajaxListadoEsquila');
        Route::post('/guardarEsquila', [EjemplarController::class, 'guardarEsquila'])->name('ejemplar.guardarEsquila');
        Route::post('/ajaxListadoMedicaciones', [EjemplarController::class, 'ajaxListadoMedicaciones'])->name('ejemplar.ajaxListadoMedicaciones');
        Route::post('/guardarMedicacion', [EjemplarController::class, 'guardarMedicacion'])->name('ejemplar.guardarMedicacion');
        Route::post('/guardarMorfologicoAlpaca', [EjemplarController::class, 'guardarMorfologicoAlpaca'])->name('ejemplar.guardarMorfologicoAlpaca');
        Route::post('/guardarBiometriaAlpaca', [EjemplarController::class, 'guardarBiometriaAlpaca'])->name('ejemplar.guardarBiometriaAlpaca');
        Route::post('/cargarArbolGenealogicoVista', [EjemplarController::class, 'cargarArbolGenealogicoVista'])->name('ejemplar.cargarArbolGenealogicoVista');
    });

    Route::prefix('/empadre')->group(function(){
        Route::get('/listado/{tipo}', [EmpadreController::class, 'listado'])->where('tipo', 'LLAMA|ALPACA')->name('empadre.listado');
        Route::post('/ajaxListado', [EmpadreController::class, 'ajaxListado'])->name('empadre.ajaxListado');
        Route::post('/guardarEmpadre', [EmpadreController::class, 'guardarEmpadre'])->name('empadre.guardarEmpadre');
        Route::post('/eliminarEmpadre', [EmpadreController::class, 'eliminarEmpadre'])->name('empadre.eliminarEmpadre');
    });

    Route::prefix('/diagnostico')->group(function(){
        Route::get('/listado/{tipo}', [DiagnosticoController::class, 'listado'])->where('tipo', 'LLAMA|ALPACA')->name('diagnostico.listado');
        Route::post('/ajaxListado', [DiagnosticoController::class, 'ajaxListado'])->name('diagnostico.ajaxListado');
        Route::post('/guardarDiagnostico', [DiagnosticoController::class, 'guardarDiagnostico'])->name('diagnostico.guardarDiagnostico');
        Route::post('/eliminarDiagnostico', [DiagnosticoController::class, 'eliminarDiagnostico'])->name('diagnostico.eliminarDiagnostico');
        Route::post('/buscarEmpadre', [DiagnosticoController::class, 'buscarEmpadre'])->name('diagnostico.buscarEmpadre');

    });

    Route::prefix('/feriaEjemplar')->group(function(){
        Route::get('/listado/{tipo}', [FeriaEjemplarController::class, 'listado'])->where('tipo', 'LLAMA|ALPACA')->name('feriaEjemplar.listado');
        Route::post('/ajaxListado', [FeriaEjemplarController::class, 'ajaxListado'])->name('feriaEjemplar.ajaxListado');
        Route::post('/guardarFeriaEjemplar', [FeriaEjemplarController::class, 'guardarFeriaEjemplar'])->name('feriaEjemplar.guardarFeriaEjemplar');
        Route::post('/eliminarFeriaEjemplar', [FeriaEjemplarController::class, 'eliminarFeriaEjemplar'])->name('feriaEjemplar.eliminarFeriaEjemplar');
    });

    Route::prefix('/raza')->group(function(){
        Route::get('/listado', [RazaController::class, 'listado'])->name('raza.listado');
        Route::post('/ajaxListado', [RazaController::class, 'ajaxListado'])->name('raza.ajaxListado');
        Route::post('/guardarRaza', [RazaController::class, 'guardarRaza'])->name('raza.guardarRaza');
        Route::post('/eliminarRaza', [RazaController::class, 'eliminarRaza'])->name('raza.eliminarRaza');
    });

    Route::prefix('/rol')->group(function(){
        Route::get('/listado', [RolController::class, 'listado'])->name('rol.listado');
        Route::post('/ajaxListado', [RolController::class, 'ajaxListado'])->name('rol.ajaxListado');
        Route::post('/guardarRol', [RolController::class, 'guardarRol'])->name('rol.guardarRol');
        Route::post('/eliminarRol', [RolController::class, 'eliminarRol'])->name('rol.eliminarRol');
    });

    Route::prefix('/color')->group(function(){
        Route::get('/listado', [ColorController::class, 'listado'])->name('color.listado');
        Route::post('/ajaxListado', [ColorController::class, 'ajaxListado'])->name('color.ajaxListado');
        Route::post('/guardarColor', [ColorController::class, 'guardarColor'])->name('color.guardarColor');
        Route::post('/eliminarColor', [ColorController::class, 'eliminarColor'])->name('color.eliminarColor');
    });

    Route::prefix('/fenotipo')->group(function(){
        Route::get('/listado', [FenotipoController::class, 'listado'])->name('fenotipo.listado');
        Route::post('/ajaxListado', [FenotipoController::class, 'ajaxListado'])->name('fenotipo.ajaxListado');
        Route::post('/guardarFenotipo', [FenotipoController::class, 'guardarFenotipo'])->name('fenotipo.guardarFenotipo');
        Route::post('/eliminarFenotipo', [FenotipoController::class, 'eliminarFenotipo'])->name('fenotipo.eliminarFenotipo');
    });

    Route::prefix('/categoria')->group(function(){
        Route::get('/listado', [CategoriaController::class, 'listado'])->name('categoria.listado');
        Route::post('/ajaxListado', [CategoriaController::class, 'ajaxListado'])->name('categoria.ajaxListado');
        Route::post('/guardarCategoria', [CategoriaController::class, 'guardarCategoria'])->name('categoria.guardarCategoria');
        Route::post('/eliminarCategoria', [CategoriaController::class, 'eliminarCategoria'])->name('categoria.eliminarCategoria');
    });

    Route::prefix('/categoriaFeria')->group(function(){
        Route::get('/listado', [CategoriaFeriaController::class, 'listado'])->name('categoriaFeria.listado');
        Route::post('/ajaxListado', [CategoriaFeriaController::class, 'ajaxListado'])->name('categoriaFeria.ajaxListado');
        Route::post('/guardarCategoriaFeria', [CategoriaFeriaController::class, 'guardarCategoriaFeria'])->name('categoriaFeria.guardarCategoriaFeria');
        Route::post('/eliminarCategoriaFeria', [CategoriaFeriaController::class, 'eliminarCategoriaFeria'])->name('categoriaFeria.eliminarCategoriaFeria');
    });

    Route::prefix('/feria')->group(function(){
        Route::get('/listado', [FeriaController::class, 'listado'])->name('feria.listado');
        Route::post('/ajaxListado', [FeriaController::class, 'ajaxListado'])->name('feria.ajaxListado');
        Route::post('/guardarFeria', [FeriaController::class, 'guardarFeria'])->name('feria.guardarFeria');
        Route::post('/eliminarFeria', [FeriaController::class, 'eliminarFeria'])->name('feria.eliminarFeria');
    });

    Route::prefix('/premio')->group(function(){
        Route::get('/listado', [PremioController::class, 'listado'])->name('premio.listado');
        Route::post('/ajaxListado', [PremioController::class, 'ajaxListado'])->name('premio.ajaxListado');
        Route::post('/guardarPremio', [PremioController::class, 'guardarPremio'])->name('premio.guardarPremio');
        Route::post('/eliminarPremio', [PremioController::class, 'eliminarPremio'])->name('premio.eliminarPremio');
    });

    Route::prefix('/productoVeterinario')->group(function(){
        Route::get('/listado', [ProductoVeterinarioController::class, 'listado'])->name('productoVeterinario.listado');
        Route::post('/ajaxListado', [ProductoVeterinarioController::class, 'ajaxListado'])->name('productoVeterinario.ajaxListado');
        Route::post('/guardarProductoVeterinario', [ProductoVeterinarioController::class, 'guardarProductoVeterinario'])->name('productoVeterinario.guardarProductoVeterinario');
        Route::post('/eliminarProductoVeterinario', [ProductoVeterinarioController::class, 'eliminarProductoVeterinario'])->name('productoVeterinario.eliminarProductoVeterinario');
    });

    Route::prefix('/metodo')->group(function(){
        Route::get('/listado', [MetodoController::class, 'listado'])->name('metodo.listado');
        Route::post('/ajaxListado', [MetodoController::class, 'ajaxListado'])->name('metodo.ajaxListado');
        Route::post('/guardarMetodo', [MetodoController::class, 'guardarMetodo'])->name('metodo.guardarMetodo');
        Route::post('/eliminarMetodo', [MetodoController::class, 'eliminarMetodo'])->name('metodo.eliminarMetodo');
    });

    Route::prefix('/campania')->group(function(){
        Route::get('/listado', [CampaniaController::class, 'listado'])->name('campania.listado');
        Route::post('/ajaxListado', [CampaniaController::class, 'ajaxListado'])->name('campania.ajaxListado');
        Route::post('/guardarCampania', [CampaniaController::class, 'guardarCampania'])->name('campania.guardarCampania');
        Route::post('/eliminarCampania', [CampaniaController::class, 'eliminarCampania'])->name('campania.eliminarCampania');
    });

    Route::prefix('/tipoEmpadre')->group(function(){
        Route::get('/listado', [TipoEmpadreController::class, 'listado'])->name('tipoEmpadre.listado');
        Route::post('/ajaxListado', [TipoEmpadreController::class, 'ajaxListado'])->name('tipoEmpadre.ajaxListado');
        Route::post('/guardarTipoEmpadre', [TipoEmpadreController::class, 'guardarTipoEmpadre'])->name('tipoEmpadre.guardarTipoEmpadre');
        Route::post('/eliminarTipoEmpadre', [TipoEmpadreController::class, 'eliminarTipoEmpadre'])->name('tipoEmpadre.eliminarTipoEmpadre');
    });

    Route::prefix('/equipo')->group(function(){
        Route::get('/listado', [EquipoController::class, 'listado'])->name('equipo.listado');
        Route::post('/ajaxListado', [EquipoController::class, 'ajaxListado'])->name('equipo.ajaxListado');
        Route::post('/guardarEquipo', [EquipoController::class, 'guardarEquipo'])->name('equipo.guardarEquipo');
        Route::post('/eliminarEquipo', [EquipoController::class, 'eliminarEquipo'])->name('equipo.eliminarEquipo');
    });

    Route::prefix('/laboratorio')->group(function(){
        Route::get('/listado', [LaboratorioController::class, 'listado'])->name('laboratorio.listado');
        Route::post('/ajaxListado', [LaboratorioController::class, 'ajaxListado'])->name('laboratorio.ajaxListado');
        Route::post('/guardarLaboratorio', [LaboratorioController::class, 'guardarLaboratorio'])->name('laboratorio.guardarLaboratorio');
        Route::post('/eliminarLaboratorio', [LaboratorioController::class, 'eliminarLaboratorio'])->name('laboratorio.eliminarLaboratorio');
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

        Route::post('/buscarHijos', [LocalidadController::class, 'buscarHijos']);
    });
});

require __DIR__.'/auth.php';
