<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencias';
    protected $fillable = [
    	'entrada','salida','empleado_id'];

	public function empleado(){
		return $this->belongsTo('App\Empleado');
	}

	public function scopeConsultar($query, $fecha, $empleado){
		return $query->join('empleados', 'asistencias.empleado_id', '=', 'empleados.id')
					 ->where('empleados.id', '=', $empleado)
					 ->where('asistencias.entrada', '<', $fecha)
					 ->whereNull('asistencias.salida')
					 ->select('asistencias.*');

	}

}
