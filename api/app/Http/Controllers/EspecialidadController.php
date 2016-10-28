<?php

namespace App\Http\Controllers;

use Response;
use Request;

class EspecialidadController extends Controller
{
    public function index(){
        $response = \App\Especialidad::getAll();

        return response()->json($response)->setStatusCode($response->code);
    }

    public function show($id){
        $response = \App\Especialidad::get($id);

        return response()->json($response)->setStatusCode($response->code);
    }

    public function create(){
        $object = Request::all();
        $response = \App\Especialidad::create($object);
        return response()->json($response)->setStatusCode($response->code);
    }

    public function update(){
        $object = Request::all();
        $response = \App\Especialidad::update($object);
        return response()->json($response)->setStatusCode($response->code);
    }
}
