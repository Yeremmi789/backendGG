<?php

use App\Http\Controllers\DescuentosController;
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
