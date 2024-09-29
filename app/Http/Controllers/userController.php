<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;


class userController extends Controller
{
    //

    public function registro(Request $peticion){

        $peticion->validate([
            "usuario" => 'required|min:3',
            "email" => 'required|email|unique:users',
            // "password" => 'required|min:8|confirmed',
            "password" => 'required|min:8',
        ]);

        $usuario = new User();

        $usuario->usuario = $peticion->usuario;
        $usuario->email = $peticion->email;
        $usuario->password = Hash::make($peticion->password);
        $usuario->activo = 1;
        // $usuario->ultimo_acceso = date('Y-m-d H:i:s');
        
        // SE PUEDE CREAR UNA TABLA DONDE SE COLOQUE UNA TABLA PARA CLIENTES (EMPRESAS)
        // Le asignamos el rol de Cliente
        // $usuario->assignRole('cliente');
        // Le asignamos el rol de usuario
        $usuario->assignRole('usuario');
        // $usuario->assignRole('admin');
        
        $usuario->save();


        return response()->json($usuario, Response::HTTP_CREATED);


    }


    public function login(Request $peticion){

        $bandera = false;

        $credenciales = $peticion->validate([
            'email'=>['required', 'email'],
            // 'name'=>['required'],
            'password'=>['required'],
        ]);
 
        $buscarUsuario = $peticion->email;

        if(Auth::attempt($credenciales)){
            $usuario = User::where('email', '=', $buscarUsuario)->first();

            $auth = Auth::user();
            $token = $auth->createToken('token')->plainTextToken;
            return response([
            "valido"=>!$bandera,
            "token"=>$token,
            "mssg" => "credenciales correctas",
            "id"=>$usuario->id,
            "usuario"=>$usuario->usuario,
            "email"=>$usuario->email,
            
        ], 200);


        }else{
            return response()->json([
              "mssg"=> "credenciales incorrectas",
            ],401);
        }



    }

    public function recuperarContrasenia(){

    }

}
