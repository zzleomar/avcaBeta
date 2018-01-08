<?php

namespace App\Http\Controllers;

use Szykra\Notifications\Flash;
use Illuminate\Http\Request;
use App\Personal;
use App\Horario;
use App\Sucursal;

class PersonalController extends Controller
{
    public function index(Request $datos){
        $cargos=Personal::Cargos(); //selecciono todo los cargos existentes
        $sucursales=Sucursal::orderBy("nombre")->get(); //selecciono todas las sucursales ordenadas por el nombre
        $horarios=Horario::orderBy("id")->get();
    	if(isset($datos->cargo)){
            $empleados=Personal::Pcargo($datos->cargo);//busco todo el personal que posee un cargo en particular
	    	return view('asistente-RRHH.index')
                        ->with('empleados',$empleados)
                        ->with('cargos',$cargos)
                        ->with('horarios',$horarios)
                        ->with('sucursales',$sucursales);
    	}
    	else{
    		if(isset($datos->sucursal)){
                $empleados=Personal::Psucursal($datos->sucursal);//busco todo el personal que labora en una sucursal en particular
	    		return view('asistente-RRHH.index')
                        ->with('empleados',$empleados)
                        ->with('cargos',$cargos)
                        ->with('horarios',$horarios)
                        ->with('sucursales',$sucursales);
    		}
    		else{
    			$empleados=Personal::Ordenados();

	    		return view('asistente-RRHH.index')
                        ->with('empleados',$empleados)
                        ->with('cargos',$cargos)
                        ->with('horarios',$horarios)
                        ->with('sucursales',$sucursales);
    		}
    	}
    }

    public function eliminar(Request $datos){
        $personal=Personal::find($datos->empleado_id)->first();
        $personal->delete();
        flash::info('El empleado '.$personal->apellidos." ".$personal->nombres." ha sido eliminado del sistema");
        return redirect('/RRHH');
    }

    public function nuevo(Request $datos){
        dd($datos->all());
        $nuevo= new Personal();
        $nuevo->nombres=$datos->nombres;
        $nuevo->apellidos=$datos->apellidos;
        $nuevo->cedula=$datos->nacionalidad.$datos->cedula;
        $nuevo->tlf_movil=$datos->tlf_movil;
        $nuevo->tlf_casa=$datos->tlf_casa;
        $nuevo->direccion=$datos->direccion;
        $nuevo->entrada=$datos->fechaEntrada;

        /*
        si $datos->tipoC!=1 es personal_operativo
            "cargo1"

        si $datos->tipoC!=2 es tripulante
            "cargo2" 

        si $datos->tipoC!=3 es administrativo  
            "cargo3"


      "sucursalid" => "19"
      "horarioid" => "2"
         */

    }
}
