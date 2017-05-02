<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosPaciente extends Model
{
    public $timestamps = false;
    protected $table = 'datos_paciente';

    public function paciente()
    {
        return $this->belongsTo('App\Paciente');
    }
}
