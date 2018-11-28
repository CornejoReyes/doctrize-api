<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = "citas";
    public $timestamps = false;

    public function paciente(){
        return $this->belongsTo('App\Paciente');
    }

    public function doctor(){
        return $this->belongsTo('App\Doctor');
    }

    public function receta()
    {
        return $this->hasOne('App\Receta');
    }

    /*
    * Descripcion: Esta funcion cuenta todas las citas disponibles del sistema.
    * Si no hay citas disponibles, devuelve un mensaje notificándolo.
    */
    public static function countCitas($id){
        $response = new Response();

        $citas = new Doctor();

        try{
            $citas = $citas->countCitas($id);
            $response->rows = $citas;
            $response->code = 200;
            if(count($response->rows) == 0){
                $reponse->msg = "No se encontró información de citas";
            }
        }
        catch( \Exception $e){
            $response->msg = "Se produjo un error al contar";
            $response->exception = $e->getMessage();
        }
        return $response;
    }

    /*
    * Descripcion: Esta funcion obtiene todas las citas registradas en el sistema.
    * Si no hay citas disponibles, devuelve un mensaje notificándolo.
    */
    public static function getAll(){
        $response = new Response();

        try{
            $response->rows = self::where('estado_id', 2)->with('paciente')->get();
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

    /*
    * Descripcion: Esta funcion obtiene los datos de una cita basado en el parametro id que recibe la funcion.
    * Si no se encuentra la cita, se devuelve un mensaje notificándolo
    * Parámetros:
    * (int) id  El id de la cita
    */
    public static function get($id){
        $response = new Response();

        try{
            $response->rows = self::where('id',$id)->with('paciente.datos', 'receta')->get();
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

    /*
    * Descripcion: Esta funcion permite crear una cita en el sistema. Si la hora de la cita a registrar
    * ya está ocupada, se devuelve un error y un mensaje notificando que la hora está ocupada.
    * Parámetros:
    * (array) data   La cita a registrar
    * data: {
        paciente_id
        doctor_id
        comentario
        fecha
        descripcion
    }
    */
    public static function create(array $data = []){
        $response = new Response();
        $object = new self();
        $try = new self();
        try{
            $posible = $try->where('fecha',$data['fecha'])->get();
            if(count($posible) != 0){
                $response->code = 500;
                $response->msg = "Fecha y hora ocupados";
                $response->rows = $data;
            }else{
                $object->paciente_id = $data['paciente_id'];
                $object->doctor_id = $data['doctor_id'];
                $object->comentario = $data['comentario'];
                $object->fecha = $data['fecha'];
                $object->estado_id = 1;
                $object->descripcion = $data['descripcion'];
                $object->save();
                $response->code = 200;
                $response->msg = "Se agendó la cita correctamente";
                $response->rows = $object;
            }
        }
        catch(\Exception $e){
            $response->msg = "Se produjo un error al agendar la cita";
            $response->exception = $e->getMessage();
            $response->code = 500;
        }

        return $response;
    }

    /*
    * Descripcion: Esta funcion permite agregar una receta y / o comentario a la cita y a su vez
    * la cambia a estado de "Terminada".
    * Parámetros:
    * (string) receta_doc   La receta dada por el doctor
    * (string) comentario_doctor   Recomendaciones hechas por el doctor
    */
    public static function updateObject($id, $receta_doc, $comentario_doctor)
    {
        $response = new Response;
        try {
            $cita = Cita::find($id);
            $cita->comentario_doctor = $comentario_doctor;
            $cita->estado_id = 3;
            $cita->save();
            $receta = new Receta;
            $receta->cita_id = $id;
            $receta->receta = $receta_doc;
            $receta->save();
            $response->code = 200;
            $response->msg = "Se ha guardado la cita.";
        }
        catch (\Exception $e) {
            $response->msg = "Se produjo un error al guardar la cita";
            $response->exception = $e->getMessage().' '.$e->getLine();
            $response->code = 500;
        }
        return $response;

    }

    /*
    * Descripcion: Con ésta función se cancela una cita y se le asigna un estado de "Cancelada".
    * Parámetros:
    * (int) id   La cita a cancelar
    */
    public static function cancel($id)
    {
        $response = new Response;
        try {
            $cita = Cita::find($id);
            $cita->estado_id = 2;
            $cita->save();
            $response->code = 200;
            $response->msg = "Se ha cancelado la cita";
        }
        catch (\Exception $e) {
            $response->code = 500;
            $response->msg = "Se ha producido un error";
            $response->exception = $e->getMessage();
        }
        return $response;

    }


}
