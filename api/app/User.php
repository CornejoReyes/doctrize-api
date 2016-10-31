<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Response;

class User extends Authenticatable
{
    public static function login($data){
        $response = new Response();

        try{
            if($data['rol'] == 1){
                $user = DB::table('doctores')->where('usuario', $data['usuario'])->first();
                if($user){
                    if($user->contrasena === md5($data['contrasena'])){
                        $response->code = 200;
                        $response->rows = 'Logueado';
                    }else{
                        $response->code=401;
                        $response->msg = "Usuario o contraseña incorrectos";
                    }
                }else{
                    $response->code=401;
                    $response->msg = "Usuario o contraseña incorrectos";
                }
            }elseif($data['rol'] == 2){
                $user = DB::table('pacientes')->where('usuario', $data['usuario'])->first();
                if($user){
                    if($user->contrasena === md5($data['contrasena'])){
                        $response->code = 200;
                        $response->rows = 'Logueado';
                    }else{
                        $response->code=401;
                        $response->msg = "Contraseña incorrecta";
                    }
                }else{
                    $response->code=404;
                    $response->msg = "No existe usuario";
                }
            }
        }
        catch (\Exception $e){
            $response->code =500;
            $response->exception = $e->getMessage();
            $response->msg = "Se produjo un error al loguear";
        }
        return $response;

    }
}
