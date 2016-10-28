<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = "especialidades";
    public $timestamps = false;

    public static function getAll(){
        $response = new Response();

        try{
            $response->rows = self::all();
            $response->code = 200;
            if(count($response->rows) == 0){
                $reponse->msg = "No se encontró información de Especialidades";
            }
        }
        catch( \Exception $e){
            $response->msg = "Se produjo un error al obtener las especialidades";
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
                $reponse->msg = "No se encontró información de Especialidades";
            }
        }
        catch( \Exception $e){
            $response->msg = "Se produjo un error al obtener la especialidad";
            $response->exception = $e->getMessage();
        }

        return $response;

    }

    public static function create(array $data = []){
        $response = new Response();
        $object = new self();
        try{
            $object->nombre = $data['nombre'];
            $object->save();
            $response->code = 200;
            $response->msg = "Se añadió la especialidad correctamente";
        }
        catch(\Exception $e){
            $response->msg = "Se produjo un error al añadir la especialidad";
            $response->exception = $e->getMessage();
            $response->code = 500;
        }

        return $response;
    }

}
