<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TblUsuariosController;
use App\Http\Controllers\TblFuncionariosController;
use App\Http\Controllers\TblInventariosController;

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

Route::get('/funcionario', function () {
    return view('funcionario.formulario');
});

Route::get('/probar', function () {
    return view('funcionario.prueba');
});


Route::get('/login/create', [App\Http\Controllers\TblUsuariosController::class, 'show']);
Route::get('/salir', [App\Http\Controllers\TblUsuariosController::class, 'cerrarsession']);
Route::get('/usuario', [App\Http\Controllers\TblUsuariosController::class, 'index']);


Route::controller(TblUsuariosController::class)->group(function(){
    Route::get('/usuario', 'index');
    Route::post('/usuario/create', 'store');
    Route::post('/usuario/update', 'update');
    Route::post('/usuario/clave', 'update2');
});

Route::controller(TblFuncionariosController::class)->group(function(){
    Route::post('/funcionario/create', 'store');
    Route::get('/funcionario/listar', 'show');
    Route::get('/funcionario/edit', 'edit');
    Route::get('/funcionario/update', 'update');
    Route::get('/funcionario/delete', 'destroy');
    Route::get('/funcionario/buscar', 'buscar');
});



Route::controller(TblInventariosController::class)->group(function(){
    Route::get('/inventario', 'index');
    Route::get('/inventario/listar', 'edit');
    Route::post('/inventario/create', 'store');
    Route::get('/inventario/buscarmdlo', 'buscar_modelo');
    Route::get('/inventario/buscarmrca', 'buscar_marca');
    Route::post('/inventario/createcpu', 'storecpu');
    Route::post('/inventario/createhdidk', 'storehdisk');

});