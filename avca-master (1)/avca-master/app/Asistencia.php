<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencias';
    protected $fillable = [
    	'hora_entrada','hora_salida','fecha'];
}

public function administrativo(){
	return $this->hasOne('App\Administrativo');
}


