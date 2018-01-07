<?php

namespace App\Http\Controllers;

use Szykra\Notifications\Flash;
use Illuminate\Http\Request;
use App\Personal;
use App\Sucursal;

class PersonalController extends Controller
{
    public function index(Request $datos){
        $cargos=Personal::Cargos(); //selecciono todo los cargos existentes
        $sucursales=Sucursal::orderBy("nombre")->get(); //selecciono todas las sucursales ordenadas por el nombre
    	if(isset($datos->cargo)){
            $empleados=Personal::Pcargo($datos->cargo);//busco todo el personal que posee un cargo en particular
            
	    	return view('asistente-RRHH.index')
                        ->with('empleados',$empleados)
                        ->with('cargos',$cargos)
                        ->with('sucursales',$sucursales);
    	}
    	else{
    		if(isset($datos->sucursal)){
                $empleados=Personal::Psucursal($datos->sucursal);//busco todo el personal que labora en una sucursal en particular
	    		return view('asistente-RRHH.index')
                        ->with('empleados',$empleados)
                        ->with('cargos',$cargos)
                        ->with('sucursales',$sucursales);
    		}
    		else{
    			$empleados=Personal::Ordenados();

	    		return view('asistente-RRHH.index')
                        ->with('empleados',$empleados)
                        ->with('cargos',$cargos)
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
}
