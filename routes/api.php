<?php

use App\Http\Controllers\DescuentosController;
use App\Http\Controllers\JuegosController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

// ROLES CREADOS // admin // cliente // usuarios // soporte // moderador // gestor de inventario // verificador de contenido

Route::get('/users', function () {
    return \App\Models\User::all();
});

Route::get('/', function(){
    return response()->json([
        "Intente ingresar a las rutas:",
        "api/registros",
        "api/iniciar",
        "api/prueba",
        "etc..."
    ]);
});


Route::group(['middleware' => ['role:cliente']], function () {
    //rutas accesibles solo para clientes
});

Route::group(['middleware' => ['role:cliente']], function () {
    //rutas accesibles solo para clientes
});

Route::get("pruebass", [DescuentosController::class, 'pruebas']);

Route::get('carrusel', [JuegosController::class, 'getCarruselJuegos']);
Route::get('info_Juego/{id}', [JuegosController::class, 'getJuegoCompleto']);
Route::get('galeria/{id}', [JuegosController::class, 'getGaleria']);
Route::get('carruselNormal', [JuegosController::class, 'getNormal']);
Route::post('registrarse', [userController::class, 'registro']);
Route::post('loguearse', [userController::class, 'login']);
Route::get('usuario/{id}', [userController::class, 'getUsuario']);
Route::post('cesta', [JuegosController::class, 'addCesta']);
Route::get('miCesta/{id}',[JuegosController::class,'getCesta']);