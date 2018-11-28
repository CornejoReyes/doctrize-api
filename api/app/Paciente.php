<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Response;

class Paciente extends Model
{
    protected $table = "pacientes";
    public $timestamps = false;
    protected $hidden = ['contrasena'];

    public function citas(){
        return $this->hasMany('App\Cita','paciente_id');
    }

    public function datos(){
        return $this->hasOne('App\DatosPaciente','paciente_id')->orderBy('id', 'desc');
    }

    /*
    * Descripción: Esta funcion cuenta los pacientes y devuelve un objeto con los datos
    */
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

    /*
    * Descripcion: Ésta función permite obtener todos los pacientes registrados en la
    * plataforma.
    */
    public static function getAll(){
        $response = new Response();

        try{
            $response->rows = Paciente::all();
            $response->code = 200;
            if(count($response->rows) == 0){
                $reponse->msg = "No se encontró información de pacientes";
            }
        }
        catch( \Exception $e){
            $response->code = 500;
            $response->msg = "Se produjo un error al obtener los pacientes";
            $response->exception = $e->getMessage();
        }

        return $response;

    }

    /*
    * Descripcion: Devuelve el paciente solicitado mediante el id que acepta.
    * En caso de que no exista, se devuelve un mensaje notificandolo.
    * Parámetros:
    * (int) id   ID del paciente
    */
    public static function get($id){
        $response = new Response();

        try{
            $response->rows = self::where('id', $id)->with('datos')->get();
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

    /*
    * Descripcion: Se obtienen todas las citas que ha registrado un paciente.
    * Si no se encuentran registros, se devuelve un mensaje notificandolo.
    * Parámetros:
    * (int) id   ID del paciente
    */
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

    /*
    * Descripcion: Ésta función permite crear un paciente en el sistema.
    * Parámetros:
    * (array) data   Paciente a registrar
    * data: {
        nombre
        apellido_paterno
        apellido_materno
        fecha_nacimiento
        sexo
        telefono
        calle
        colonia
        municipio
    }
    */
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

    /*
    * Descripcion: Con ésta función se permite editar un paciente
    * Parámetros:
    * (array) data   Paciente modificado
    * data: {
        id
        nombre
        apellido_paterno
        apellido_materno
        fecha_nacimiento
        sexo
        telefono
        calle
        colonia
        municipio
    }
    */
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

    /*
    * Descripcion: Con ésta función se permite editar los datos clínicos del paciente.
    * Parámetros:
    * (int) id   ID del paciente
    * (array) userData   Datos clínicos del paciente
    * userData: {
        peso
        altura
        presion
        alergia
    }
    */
    public static function editData($id, $userData)
    {
        $response = new Response;
        try {
            $data = new DatosPaciente;
            $data->paciente_id = $id;
            $data->peso = $userData['peso'];
            $data->altura = $userData['altura'];
            $data->presion = $userData['presion'];
            $data->alergia = $userData['alergia'];
            $data->save();
            $response->code = 200;
            $response->msg = "Se ha guardado la información";
        }
        catch (\Exception $e) {
            $response->code = 500;
            $response->msg = "Se produjo un error";
            $response->exception = $e->getMessage();
        }
        return $response;
    }

}
