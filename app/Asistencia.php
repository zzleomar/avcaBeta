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
	public function scopePrimeraMes($query, $mes){
      return $query->join('empleados', 'asistencias.empleado_id', '=', 'empleados.id')
                    ->whereMonth('asistencias.entrada', $mes)
                    ->select('asistencias.*')->first();
    }
	public function scopeasistenciaMes($query, $inicio, $salida, $empleado){
      return $query->join('empleados', 'asistencias.empleado_id', '=', 'empleados.id')
                    ->where([['asistencias.entrada','>=', $inicio],['asistencias.entrada','<=', $salida],['empleados.id','=',$empleado]])
                    ->select('asistencias.*');
    }

}
