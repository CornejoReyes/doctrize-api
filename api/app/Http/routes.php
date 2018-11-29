<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['prefix' => 'api'], function(){

    Route::group(['prefix' => 'especialidad'], function(){
        Route::get('', 'EspecialidadController@index');
        Route::get('/{id}', 'EspecialidadController@show');
        Route::post('', 'EspecialidadController@create');
        Route::put('/{id}', 'EspecialidadController@updateObject');
    });

    Route::group(['prefix' => 'paciente'], function(){
        Route::get('','PacienteController@index');
        Route::get('/count','PacienteController@countPacientes');
        Route::get('/{id}','PacienteController@show');
        Route::get('/{id}/citas','PacienteController@getCitas');
        Route::post('','PacienteController@create');
        Route::put('/{id}', 'PacienteController@updateObject');
        Route::post('/{id}/data', 'PacienteController@editData');
    });

    Route::group(['prefix' => 'cita'], function(){
        Route::get('','CitaController@index');
        Route::post('/count','CitaController@countCitas');
        Route::get('/{id}','CitaController@show');
        Route::post('/{id}/cancel','CitaController@cancel');
        Route::post('','CitaController@create');
        Route::post('/{id}/update', 'CitaController@updateObject');
    });

    Route::group(['prefix' => 'doctor'], function(){
        Route::get('','DoctorController@index');
        Route::get('/{id}','DoctorController@show');
        Route::get('/{id}/citas','DoctorController@getCitas');
        Route::post('','DoctorController@create');
        Route::put('/{id}', 'DoctorController@updateObject');
    });

    Route::group(['prefix' => 'proveedor'], function(){
        Route::get('', 'ProveedoresController@index');
        Route::get('/{id}', 'ProveedoresController@get');
        Route::post('', 'ProveedoresController@create');
        Route::put('/{id}', 'ProveedoresController@edit');
        Route::delete('/{id}', 'ProveedoresController@remove');
    });

    Route::group(['prefix' => 'auth'], function(){
        Route::post('/login', 'UserController@login');
        Route::post('/logout', 'UserController@logout');
    });

});
