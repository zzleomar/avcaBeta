<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table ="horarios";

    protected $fillable = [
        'entrada', 'salida'
    ];

    public function empleados(){
    	return $this->hasMany('App\Empleado');
    }
}
