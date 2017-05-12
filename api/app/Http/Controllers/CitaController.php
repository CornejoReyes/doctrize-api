<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Http\Request as Req;
use Request;

class CitaController extends Controller
{
    public function index(){
        $response = \App\Cita::getAll();
        return response()->json($response)->setStatusCode($response->code);
    }
    public function countCitas(){
        $id = Request::input('id');
        $response = \App\Cita::countCitas($id);
        return response()->json($response)->setStatusCode($response->code);
    }

    public function show($id){
        $response = \App\Cita::get($id);
        return response()->json($response)->setStatusCode($response->code);
    }

    public function create(){
        $object = Request::all();
        $response = \App\Cita::create($object);
        return response()->json($response)->setStatusCode($response->code);
        //return $response;
    }

    public function updateObject(Req $req, $id){
        $receta = $req->get('receta');
        $comentario_doctor = $req->get('comentario_doctor');
        $response = \App\Cita::updateObject($id, $receta, $comentario_doctor);
        return response()->json($response)->setStatusCode($response->code);
    }

    public function cancel($id)
    {
        $response = \App\Cita::cancel($id);
        return response()->json($response)->setStatusCode($response->code);
    }
}
