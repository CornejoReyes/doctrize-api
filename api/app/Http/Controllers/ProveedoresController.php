<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Proveedores;

class ProveedoresController extends Controller
{
    public function index()
    {
        $response = Proveedores::getAll();
        return response()->json($response)->setStatusCode($response->code);
    }

    public function get($id)
    {
        $response = Proveedores::get($id);
        return response()->json($response)->setStatusCode($response->code);
    }

    public function create(Request $provider)
    {
        $response = Proveedores::create($provider->all());
        return response()->json($response)->setStatusCode($response->code);
    }

    public function edit(Request $provider, $id)
    {
        $response = Proveedores::edit($id, $provider);
        return response()->json($response)->setStatusCode($response->code);
    }

    public function remove($id)
    {
        $response = Proveedores::remove($id);
        return response()->json($response)->setStatusCode($response->code);
    }
}
