<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = "doctores";

    public function citas(){
        return $this->hasMany('App\Cita');
    }

    /*
    * Descripcion: Esta función permite obtener todos los doctores registrados en la plataforma.
    */
    public static function getAll(){
        $response = new Response();

        try{
            $response->rows = self::all();
            $response->code = 200;
            if(count($response->rows) == 0){
                $reponse->msg = "No se encontró información de doctores";
            }
        }
        catch( \Exception $e){
            $response->msg = "Se produjo un error al obtener los doctores";
            $response->exception = $e->getMessage();
        }

        return $response;

    }

    /*
    * Descripcion: Esta funcion permite obtener a un doctor en específico, basado en
    * el parámetro id pasado a la función.
    * Parámetros:
    * (int) id   El doctor a obtener
    */
    public static function get($id){
        $response = new Response();

        try{
            $response->rows = self::find($id);
            $response->code = 200;
            if(count($response->rows) == 0){
                $reponse->msg = "No se encontró información de doctores";
            }
        }
        catch( \Exception $e){
            $response->msg = "Se produjo un error al obtener los doctores";
            $response->exception = $e->getMessage();
        }
        return $response;
    }

    /*
    * Descripcion: Con ésta función se obtienen las citas a las que el doctor
    * fue asignado, mediante el parámetro id.
    * Parámetros:
    * (int) id   ID del doctor
    */
    public static function getCitas($id){
        $response = new Response();

        try{
            $response->rows = self::find($id)->citas()->where('estado_id', 1)->get();
            $response->code = 200;
            if(count($response->rows) == 0){
                $reponse->msg = "No se encontró información de doctores";
            }
        }
        catch( \Exception $e){
            $response->msg = "Se produjo un error al obtener los doctores";
            $response->exception = $e->getMessage();
        }
        return $response;
    }

    /*
    * Descripcion: Con ésta función se cuentan las citas a las que el doctor
    * fue asignado, mediante el parámetro id.
    * Parámetros:
    * (int) id   ID del doctor
    */
    public static function countCitas($id){
        $response = new Response();

        try{
            $response->rows = self::find($id)->citas()->where('estado_id', 1)->count();
            // $response->rows = count($response->rows);
            $response->code = 200;
            if(count($response->rows) == 0){
                $reponse->msg = "No se encontró información de doctores";
            }
        }
        catch( \Exception $e){
            $response->msg = "Se produjo un error al obtener los doctores";
            $response->exception = $e->getMessage();
        }
        return $response;
    }

}
