<?php

namespace App\Http\Controllers;


use App\Http\Requests;
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

    public function updateObject(){
        $object = Request::all();
        $response = \App\Cita::updateObject($object);
        return response()->json($response)->setStatusCode($response->code);
    }
}
