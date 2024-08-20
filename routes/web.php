<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TblUsuariosController;
use App\Http\Controllers\TblFuncionariosController;

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
    Route::post('/usuario/create', 'store');
});

Route::controller(TblUsuariosController::class)->group(function(){
    Route::post('/usuario/update', 'update');
});

Route::controller(TblUsuariosController::class)->group(function(){
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



