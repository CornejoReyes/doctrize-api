<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DoctorController extends Controller
{
    public function index(){
        $response = \App\Doctor::getAll();
        return response()->json($response)->setStatusCode($response->code);
    }

    public function show($id){
        $response = \App\Doctor::get($id);
        return response()->json($response)->setStatusCode($response->code);
    }

    public function getCitas($id){
        $response = \App\Doctor::getCitas($id);
        return response()->json($response)->setStatusCode($response->code);
    }
}
