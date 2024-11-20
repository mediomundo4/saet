<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TblUsuariosController;
use App\Http\Controllers\TblFuncionariosController;
use App\Http\Controllers\TblInventariosController;
use App\Http\Controllers\TblAsignacionesController;
use App\Http\Controllers\ReportesController;


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
    return view('login');
});

Route::get('/principal', function () {
    return view('principal/index');
});



Route::get('/probar', function () {
    return view('funcionario.prueba');
});


Route::get('/login/create', [App\Http\Controllers\TblUsuariosController::class, 'show']);
Route::get('/salir', [App\Http\Controllers\TblUsuariosController::class, 'cerrarsession']);
Route::get('/usuario', [App\Http\Controllers\TblUsuariosController::class, 'index']);


Route::controller(TblUsuariosController::class)->group(function(){
    Route::get('/usuario', 'index');
    Route::get('/usuario/listar', 'edit');
    Route::post('/usuario/create', 'store');
    Route::post('/usuario/update', 'update');
    Route::post('/usuario/clave', 'update2');
});

Route::controller(TblFuncionariosController::class)->group(function(){
    Route::get('/funcionario', 'index');
    Route::post('/funcionario/create', 'store');
    Route::post('/funcionario/newdpto', 'storedpto');
    Route::get('/funcionario/buscarpiso', 'buscar_piso');
    Route::get('/funcionario/buscardpdnc', 'buscar_dependencia');
    Route::post('/funcionario/newddpdnc', 'storedpdnc');
    Route::get('/funcionario/listar', 'show');
    Route::get('/funcionario/edit', 'edit');
    Route::get('/funcionario/update', 'update');
    Route::get('/funcionario/delete', 'destroy');
    Route::get('/funcionario/buscar', 'buscar');
});



Route::controller(TblInventariosController::class)->group(function(){
    Route::get('/inventario', 'index');
    Route::get('/inventario/portipo', 'indexptipo');
    Route::get('/inventario/listar', 'edit');
    Route::get('/inventario/listarptipo', 'editptipo');

    Route::post('/inventario/create', 'store');
    Route::get('/inventario/buscarmdlo', 'buscar_modelo');
    Route::get('/inventario/buscarmrca', 'buscar_marca');
    Route::post('/inventario/createcpu', 'storecpu');
    Route::post('/inventario/createhdidk', 'storehdisk');
    Route::post('/inventario/createmodelo', 'storemodel');
});

Route::controller(TblAsignacionesController::class)->group(function(){
    Route::get('/asignacion', 'index');
    Route::get('/asignacion/buscarfun', 'buscarfun');
    Route::get('/asignacion/buscarequipo', 'buscarinvequipo');
    Route::post('/asignacion/create', 'store');
    Route::get('/asignacion/listar', 'edit');
    Route::get('/asignacion/buscarstock', 'buscarstock');
    Route::post('/asignacion/modificarstatu', 'actualizarstatu');
});

Route::controller(ReportesController::class)->group(function(){
    Route::get('/reporte/pordpto', 'reporte_por_dependencia');
    Route::get('/reporte/pordpndnc', 'reporte_por_departamento');    
    Route::get('/reporte/porrngfecha', function () { return view('reportes.form_prangof'); });
    Route::post('/reporte/generar_rpordpto', 'generar_reprte_pordepartamento');
    Route::post('/reporte/generar_rpordpdnc', 'generar_reprte_pordependencia');
    Route::post('/reporte/generar_rporrangofecha', 'generar_reprte_por_rango_fecha');
    Route::get('/reporte/graficoprostatu', 'grafico_por_estatus');
});