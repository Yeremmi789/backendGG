<?php

use App\Http\Controllers\DescuentosController;
use App\Http\Controllers\JuegosController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

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


Route::get("pruebass", [DescuentosController::class, 'pruebas']);
Route::get('carrusel', [JuegosController::class, 'getCarruselJuegos']);
Route::get('info_Juego/{id}', [JuegosController::class, 'getJuegoCompleto']);
Route::get('galeria/{id}', [JuegosController::class, 'getGaleria']);
Route::get('carruselNormal', [JuegosController::class, 'getNormal']);
Route::post('registrarse', [userController::class, 'registro']);
Route::post('loguearse', [userController::class, 'login']);
