<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencias';
    protected $fillable = [
    	'entrada','salida','empleado_id'];
}

public function empleado(){
	return $this->belongsTo('App\Empleado');
}


