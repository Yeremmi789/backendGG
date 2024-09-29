<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Galeria_Juegos;
use App\Models\Juegos;
use Illuminate\Http\Request;

class JuegosController extends Controller
{
    //
    public function getCarruselJuegos(){
        $juegos = new Juegos();


        $carrusel = Juegos::select(
            'id',
            'titulo',
            'portada',
            'versionJuego',
            'precio',
            'descuento',
            'precioDescontado',
        )->where('descuento', '!=', 0)
        ->get();

        

        return response()->json($carrusel);
    }

    public function getJuegoCompleto($id)
    {
        // Obtener el juego con su logo relacionado
        $juegos = Juegos::join('logo_juegos', 'logo_juegos.juego_id', '=', 'juegos.id')
            // ->join('galeria_juegos', 'galeria_juegos.juego_id', '=', 'juegos.id')
            // ->select('juegos.*', 'logo_juegos.*', 'galeria_juegos.*') // seleccionamos los campos necesarios
            ->select('juegos.*', 'logo_juegos.*') // seleccionamos los campos necesarios
            ->where('juegos.id', '=', $id) // id de búsqueda
            ->first(); //SE COLOCA FIRST para que devuelva llaves {} y no corchetes []
            // en este caso es get, porque como se consultan muchas imagenes con el mismo id del juego

        // $imagenesGaleria = Galeria_Juegos::where('juego_id', '=', $id)
        // ->pluck('ruta_img');


        return response()->json($juegos);

        // return response()->json([
        //     "Juegos" => $juegos,
        //     "Galeria" => $imagenesGaleria
        // ]);
    }


    public function getGaleria($id)
    {

        $infoGaleria = Galeria_Juegos::select('id','ruta_img','activo')->where('juego_id', '=', $id)->get();

        // Obtener solo las rutas de imágenes de la galería asociadas al juego
        $galeria = Galeria_Juegos::where('juego_id', '=', $id)
            ->pluck('ruta_img'); // Devuelve solo las rutas de las imágenes
        return response()->json($infoGaleria);

    }

    public function getNormal(){

        $carrusel = Juegos::select(
            'id',
            'titulo',
            'portada',
            'versionJuego',
            'precio'
        )
        ->where('descuento', 0)
        ->orWhere('descuento', null)
        ->get();



        return response()->json($carrusel);

    }



    // hace falta crear una tabla que contenga el nombre de las empresas, ejemplo
    // 1. BEHAVIOR
    // 2. ROCKSTAR GAMES
    // 3. EPIC GAMES
    // 4. EA SPORTS
    // para que cuando se haga la consulta a la información del juego, busque deacuerdo al id que lleva el juego
    // juegos => id,titulo,precio, ID_EMPRESA, no se si aplicar una segunda consulta exclusiva para los carruseles Ó junto al getJuegoCompleto()... pendiente


    public function getCarruselDestacados(){

    }

    public function getDescuentos(){

    }

    
}
