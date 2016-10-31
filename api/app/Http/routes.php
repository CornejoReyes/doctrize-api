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
        Route::get('/{id}','PacienteController@show');
        Route::post('','PacienteController@create');
        Route::put('/{id}', 'PacienteController@updateObject');
    });

    Route::group(['prefix' => 'auth'], function(){
        Route::post('/login', 'UserController@login');
        Route::post('/logout', 'UserController@logout');
    });

});
