<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Request;

class PacienteController extends Controller
{
    public function index(){
        $response = \App\Paciente::getAll();
        return response()->json($response)->setStatusCode($response->code);
    }
    public function countPacientes(){
        $response = \App\Paciente::countPacientes();
        return response()->json($response)->setStatusCode($response->code);
    }

    public function show($id){
        $response = \App\Paciente::get($id);
        return response()->json($response)->setStatusCode($response->code);
    }

    public function getCitas($id){
        $response = \App\Paciente::getCitas($id);
        return response()->json($response)->setStatusCode($response->code);
    }

    public function create(){
        $object = Request::all();
        $response = \App\Paciente::create($object);
        return response()->json($response)->setStatusCode($response->code);
    }

    public function updateObject(){
        $object = Request::all();
        $response = \App\Paciente::updateObject($object);
        return response()->json($response)->setStatusCode($response->code);
    }
}
