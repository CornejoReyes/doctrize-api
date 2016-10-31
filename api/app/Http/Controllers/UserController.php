<?php

namespace App\Http\Controllers;


use Request;
use Response;

class UserController extends Controller
{
    public function login(){

        $data = Request::all();
        $response = \App\User::login($data);

        return response()->json($response)->setStatusCode($response->code);

    }
}
