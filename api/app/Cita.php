<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = "citas";
    public $timestamps=false;

    public function paciente(){
        return $this->belongsTo('App\Paciente');
    }

    public function doctor(){
        return $this->belongsTo('App\Doctor');
    }

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
            $response->rows = self::where('id',$id)->with('paciente')->get();
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
        //echo json_encode($posible);
    }


}
