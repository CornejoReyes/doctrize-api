<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    public $timestamps = false;
    protected $table = 'receta';

    public function cita()
    {
        return $this->belongsTo('App\Cita');
    }
}
