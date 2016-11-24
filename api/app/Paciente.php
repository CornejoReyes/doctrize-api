<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Response;

class Paciente extends Model
{
    protected $table = "pacientes";
    public $timestamps = false;

    public function citas(){
        return $this->hasMany('App\Cita','paciente_id');
    }

    public static function countPacientes(){
        $response = new Response();

        try{
            $response->rows = self::count();
            $response->code = 200;
            if(count($response->rows) == 0){
                $reponse->msg = "No se encontró información de pacientes";
            }
        }
        catch( \Exception $e){
            $response->msg = "Se produjo un error al obtener los pacientes";
            $response->exception = $e->getMessage();
        }

        return $response;
    }

    public static function getAll(){
        $response = new Response();

        try{
            $response->rows = self::all();
            $response->code = 200;
            if(count($response->rows) == 0){
                $reponse->msg = "No se encontró información de pacientes";
            }
        }
        catch( \Exception $e){
            $response->msg = "Se produjo un error al obtener los pacientes";
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
                $reponse->msg = "No se encontró información de pacientes";
            }
        }
        catch( \Exception $e){
            $response->msg = "Se produjo un error al obtener los pacientes";
            $response->exception = $e->getMessage();
        }

        return $response;

    }

    public static function getCitas($id){
        $response = new Response();

        try{
            $response->rows = self::where('id',$id)->with('citas.doctor')->get();
            $response->code = 200;
            if(count($response->rows) == 0){
                $reponse->msg = "No se encontró información de pacientes";
            }
        }
        catch( \Exception $e){
            $response->msg = "Se produjo un error al obtener los pacientes";
            $response->exception = $e->getMessage();
        }

        return $response;

    }

    public static function create(array $data = []){
        $response = new Response();
        $object = new self();
        try{
            $object->nombre = $data['nombre'];
            $object->apellido_paterno = $data['apellido_paterno'];
            $object->apellido_materno = $data['apellido_materno'];
            $object->fecha_nacimiento = $data['fecha_nacimiento'];
            $object->sexo = $data['sexo'];
            $object->telefono = $data['telefono'];
            $object->calle = $data['calle'];
            $object->colonia = $data['colonia'];
            $object->municipio = $data['municipio'];
            $object->save();
            $response->code = 200;
            $response->msg = "Se añadió al paciente correctamente";
        }
        catch(\Exception $e){
            $response->msg = "Se produjo un error al añadir al paciente";
            $response->exception = $e->getMessage();
            $response->code = 500;
        }

        return $response;
    }

    public static function updateObject(array $data = []){
        $response = new Response();
        $object = self::find($data['id']);
        try{
            $object->nombre = $data['nombre'];
            $object->apellido_paterno = $data['apellido_paterno'];
            $object->apellido_materno = $data['apellido_materno'];
            $object->fecha_nacimiento = $data['fecha_nacimiento'];
            $object->sexo = $data['sexo'];
            $object->telefono = $data['telefono'];
            $object->calle = $data['calle'];
            $object->colonia = $data['colonia'];
            $object->municipio = $data['municipio'];
            $object->save();
            $response->code = 200;
            $response->msg = "Se actualizó al paciente correctamente";
        }
        catch(\Exception $e){
            $response->msg = "Se produjo un error al actualizar al paciente";
            $response->exception = $e->getMessage();
            $response->code = 500;
        }

        return $response;
    }

}
