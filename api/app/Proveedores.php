<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $table = 'proveedores';
    public $timestamps = false;

    /**
     * Descripción: Ésta función permite listar todos los proveedores del sistema
    */
    public static function getAll()
    {
        $response = new Response();

        try {
            $response->code = 200;
            $response->rows = self::all();
            if(count($response->rows) == 0){
                $response->msg = "No se encontró información de proveedores";
            }
        } catch(\Exception $e) {
            $response->msg = "Se produjo un error al obtener los proveedores";
            $response->exception = $e->getMessage();
            $response->code = 500;
        }
        return $response;
    }

    /**
     * Descripción: Ésta función permite los datos de un proveedor del sistema
     * Parámetros:
     * (int) id  El id del proveedor
    */
    public static function get($id)
    {
        $response = new Response();

        try {
            $response->code = 200;
            $response->rows = self::find($id);
            if(count($response->rows) == 0){
                $response->msg = "No se encontró el proveedor";
            }
        } catch(\Exception $e) {
            $response->msg = "Se produjo un error al obtener el proveedor";
            $response->exception = $e->getMessage();
            $response->code = 500;
        }
        return $response;
    }

    /**
     * Descripción: Ésta función permite actualizar un proveedor del sistema.
     * Parámetros:
     * (array) data - Datos a guardar
    */
    public static function create(array $data = [])
    {
        $response = new Response();

        try {
            $provider = new Proveedores();
            $provider->nombre = $data['nombre'];
            $provider->direccion = $data['direccion'];
            $provider->telefono = $data['telefono'];
            $provider->email = $data['email'];
            $provider->save();

            $response->code = 200;
            $response->rows = $provider;
        } catch(\Exception $e) {
            $response->msg = "Se produjo un error al crear el proveedor";
            $response->exception = $e->getMessage();
            $response->code = 500;
        }
        return $response;
    }

    /**
     * Descripción: Ésta función permite actualizar un proveedor del sistema.
     * Parámetros:
     * (int) id - El id del proveedor
     * (array) data - Datos a cambiar
    */
    public static function edit($id, $data)
    {
        $response = new Response();

        try {
            $provider = self::find($id);
            $provider->nombre = $data['nombre'];
            $provider->direccion = $data['direccion'];
            $provider->telefono = $data['telefono'];
            $provider->email = $data['email'];
            $provider->save();

            $response->code = 200;
            $response->rows = $provider;
        } catch(\Exception $e) {
            $response->msg = "Se produjo un error al editar el proveedor";
            $response->exception = $e->getMessage();
            $response->code = 500;
        }
        return $response;
    }

    /**
     * Descripción: Ésta función permite actualizar un proveedor del sistema.
     * Parámetros:
     * (int) id - El id del proveedor
     * (array) data - Datos a cambiar
    */
    public static function remove($id)
    {
        $response = new Response();

        try {
            $provider = self::destroy($id);
            $response->code = 200;
        } catch(\Exception $e) {
            $response->msg = "Se produjo un error al borrar el proveedor";
            $response->exception = $e->getMessage();
            $response->code = 500;
        }
        return $response;
    }
}
