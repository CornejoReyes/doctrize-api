<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = "doctores";

    public function citas(){
        return $this->hasMany('App\Cita');
    }

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

    public static function getCitas($id){
        $response = new Response();

        try{
            $response->rows = self::find($id)->citas;
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
