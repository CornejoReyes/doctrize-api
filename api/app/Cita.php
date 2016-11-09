<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = "citas";
    public $timestamps=false;

    public function paciente(){
        return $this->belongsTo('App\Paciente','id');
    }

    public function doctor(){
        return $this->belongsTo('App\Doctor','id');
    }

    public static function getAll(){
        $response = new Response();

        try{
            $response->rows = self::with('paciente')->get();
            $response->code = 200;
            if(count($response->rows) == 0){
                $reponse->msg = "No se encontró información de citas";
            }
        }
        catch( \Exception $e){
            $response->msg = "Se produjo un error al obtener las citas";
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
                $reponse->msg = "No se encontró información de citas";
            }
        }
        catch( \Exception $e){
            $response->msg = "Se produjo un error al obtener las citas";
            $response->exception = $e->getMessage();
        }

        return $response;

    }

    public static function create(array $data = []){
        $response = new Response();
        $object = new self();
        try{
            $object->paciente_id = $data['paciente_id'];
            $object->doctor_id = $data['doctor_id'];
            $object->comentario = $data['comentario'];
            $object->fecha = $data['fecha'];
            $object->tiempo = $data['tiempo'];
            $object->estado_id = 1;
            $object->save();
            $response->code = 200;
            $response->msg = "Se agendó la cita correctamente";
        }
        catch(\Exception $e){
            $response->msg = "Se produjo un error al agendar la cita";
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
