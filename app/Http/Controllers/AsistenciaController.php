<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sucursal;
use Szykra\Notifications\Flash;
use Carbon\Carbon;
use App\Personal;
use App\Asistencia;
use App\Empleado;


class AsistenciaController extends Controller
{
	public function __construct(){
      Carbon::setLocale('es');
      date_default_timezone_set('America/Caracas');
    }
    public function index(){
    	return view('asistente-RRHH.asistencia');
    }
    public function ajaxPerso($nacionalidad, $nro){
    	$cedula=$nacionalidad.$nro;
    	$personal = Personal::buscarCI($cedula)->first();
    	if(sizeof($personal)){ //Si el personal esta registrado
    		if(sizeof($personal->empleado)){ //si el personal es un empleado
    			$personal->empleado();
    			$actual=Carbon::now();
    			$asistencia=Asistencia::Consultar($actual->toDateTimeString(),$personal->empleado->id)->first(); //busco si posee una asistencia registrada de entrada sin salida
    			return view('asistente-RRHH.ajax.info-personal-asistencia-ajax')
    					->with('personal',$personal)
    					->with('asistencia',$asistencia);
    		}
    		else{//es un personal de tripulación
            	flash::info('El Documento de identificación ingresado le pertenece a un personal de tripulación');
           		return view('asistente-RRHH.ajax.info-error');
    		}
    	}else{//si no esta registrado el personal
             flash::error('Este empleado no se encuentra registrado');
            	return view('asistente-RRHH.ajax.info-error');
    	}
    }
    public function nueva(Request $datos, $accion){
    	$actual =Carbon::now();
    	if($accion=='entrada'){ //si la accion es registrar una entrada
	    	$cedula=$datos->nacionalidad.$datos->cedula;
	    	$personal=Personal::buscarCI($cedula)->first();
    		$asistencia = new Asistencia();
    		$asistencia->entrada=$actual->toDateTimeString();
    		$asistencia->empleado_id=$personal->empleado->id;
    		$asistencia->save();
    		flash::success('Entrada Registrada Correctamente');
    	}
    	else{//si la acción es registrar una salida
    		$asistencia = Asistencia::find($datos->Datoasistencia);
    		$asistencia->salida=$actual->toDateTimeString();
    		$asistencia->save();

    		flash::success('Salida Registrada Correctamente');

    	}
    	return redirect('/RRHH/asistencia');

    }
}
