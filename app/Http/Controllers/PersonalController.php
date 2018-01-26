<?php

namespace App\Http\Controllers;

use Szykra\Notifications\Flash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Personal;
use App\Empleado;
use App\Nomina;
use App\Horario;
use App\Personal_operativo;
use App\Tripulante;
use App\Sucursal;
use Auth;
use App\Administrativo;

class PersonalController extends Controller
{
    public function IdSucursalAuth(){
        $personal= Personal::find(Auth::user()->personal_id);
        return $personal->empleado->sucursal_id;
    }
    public function index(Request $datos){
        $nominas=Nomina::all();
        setlocale(LC_TIME, "es");
        $fechas=array();
        foreach ($nominas as $nomina) {
            $salida=Carbon::parse($nomina->fecha);
            $datos=array("id" => $nomina->id,
                        "nombre" => $salida->formatLocalized('%B %Y'));
            array_push($fechas, $datos);
        }
        $idS=0;
        $sucursal=null;
        if(Auth::user()->tipo!="Gerente de RRHH"){
            $idS=$this->IdSucursalAuth();
            $sucursal=Sucursal::find($idS);
        }
        $cargos=Personal::Cargos(); //selecciono todo los cargos existentes
        $sucursales=Sucursal::orderBy("nombre")->get(); //selecciono todas las sucursales ordenadas por el nombre
        $horarios=Horario::orderBy("id")->get();
    	if(isset($datos->cargo)){
            $empleados=Personal::Pcargo($datos->cargo,$idS);//busco todo el personal que posee un cargo en particular
	    	return view('asistente-RRHH.index')
                        ->with('empleados',$empleados)
                        ->with('cargos',$cargos)
                        ->with('horarios',$horarios)
                        ->with('sucursales',$sucursales)
                        ->with('sucursal',$sucursal)
                        ->with('fechas', $fechas);
    	}
    	else{
    		if(isset($datos->sucursal)){
                $empleados=Personal::Psucursal($datos->sucursal);//busco todo el personal que labora en una sucursal en particular
	    		return view('asistente-RRHH.index')
                        ->with('empleados',$empleados)
                        ->with('cargos',$cargos)
                        ->with('horarios',$horarios)
                        ->with('sucursales',$sucursales)
                        ->with('sucursal',$sucursal)
                        ->with('fechas', $fechas);
    		}
    		else{
    			$empleados=Personal::Ordenados($idS);

	    		return view('asistente-RRHH.index')
                        ->with('empleados',$empleados)
                        ->with('cargos',$cargos)
                        ->with('horarios',$horarios)
                        ->with('sucursal',$sucursal)
                        ->with('sucursales',$sucursales)
                        ->with('fechas', $fechas);
    		}
    	}
    }

    public function eliminar(Request $datos){
        $personal=Personal::find($datos->empleado_id);
        $personal->estado="inactivo";
        $personal->save();
        flash::info('El empleado '.$personal->apellidos." ".$personal->nombres." ha sido inhabilitado");
        return redirect('/gerencia/RRHH');
    }

    public function activar(Request $datos){
        $personal=Personal::find($datos->empleado_id);
        $personal->estado="activo";
        $personal->save();
        flash::info('El empleado '.$personal->apellidos." ".$personal->nombres." ha sido incorporado");
        return redirect('/gerencia/RRHH');
    }

    public function nuevo(Request $datos){
        $nuevo= new Personal();
        $nuevo->nombres=$datos->nombres;
        $nuevo->apellidos=$datos->apellidos;
        $nuevo->cedula=$datos->nacionalidad.$datos->cedula;
        $nuevo->tlf_movil=$datos->tlf_movil;
        $nuevo->tlf_casa=$datos->tlf_casa;
        $nuevo->direccion=$datos->direccion;
        $nuevo->entrada=$datos->fechaEntrada;
        $nuevo->save();
        switch ($datos->tipoC) { //Segun el tipo de personal
            case '1':
                $nuevoEmpleado= new Empleado();
                $nuevoEmpleado->cargo=$datos->cargo1;
                $sucursal=Sucursal::find($datos->sucursalid);
                $horario=Horario::find($datos->horarioid);
                $nuevoEmpleado->sucursal()->associate($sucursal);
                $nuevoEmpleado->horario()->associate($horario);
                $nuevo->empleado()->save($nuevoEmpleado);

                $nuevoPersonalOperativo= new Personal_operativo();
                $nuevoEmpleado->personal_operativo()->save($nuevoPersonalOperativo);
                break;
            case '2':
                $nuevoTripulante= new Tripulante();
                $nuevoTripulante->rango=$datos->cargo2;
                $nuevoTripulante->licencia=$datos->licencia;
                $nuevo->tripulante()->save($nuevoTripulante);
                break;
            case '3':
                $nuevoEmpleado= new Empleado();
                $nuevoEmpleado->cargo=$datos->cargo3;
                $sucursal=Sucursal::find($datos->sucursalid);
                $horario=Horario::find($datos->horarioid);
                $nuevoEmpleado->sucursal()->associate($sucursal);
                $nuevoEmpleado->horario()->associate($horario);
                $nuevo->empleado()->save($nuevoEmpleado);

                $nuevoAdministrativo= new Administrativo();
                $nuevoEmpleado->administrativo()->save($nuevoAdministrativo);
                break;
        }
        flash::info('El empleado '.$nuevo->apellidos." ".$nuevo->nombres." ha sido registrado en el sistema");
        return redirect('/gerencia/RRHH');

    }

    public function ajaxDatosModificar($id){
        $idS=0;
        $sucursal=new Sucursal();
        if(Auth::user()->tipo!="Gerente de RRHH"){
            $idS=$this->IdSucursalAuth();
            $sucursal=Sucursal::find($idS);
        }
        $personal=Personal::find($id);
        $sucursales=Sucursal::orderBy("nombre")->get();
        $horarios=Horario::orderBy("id")->get();
        return view('asistente-RRHH.ajax.datos-personal-ajax')
                        ->with('empleado',$personal)
                        ->with('horarios',$horarios)
                        ->with('sucursal',$sucursal)
                        ->with('sucursales',$sucursales);


    }

    public function modificar(Request $datos){
        $personal=Personal::BuscarCI($datos->cedula)->first();
        if(sizeof($personal)){
            $personal->nombres=$datos->nombres;
            $personal->apellidos=$datos->apellidos;
            $personal->cedula=$datos->nacionalidad.$datos->cedula;
            $personal->tlf_movil=$datos->tlf_movil;
            $personal->tlf_casa=$datos->tlf_casa;
            $personal->direccion=$datos->direccion;
            $personal->entrada=$datos->fechaEntrada;
            $personal->save();
            switch ($datos->tipoC) { //Segun el tipo de personal
                case '1':
                    if(is_null($personal->empleado)){ //De tripulante a Personal_operativo
                        $tripulante=Tripulante::find($personal->tripulante->id);
                        $tripulante->delete();

                        $nuevoEmpleado= new Empleado();
                        $nuevoEmpleado->cargo=$datos->cargo1;
                        $sucursal=Sucursal::find($datos->sucursalid);
                        $horario=Horario::find($datos->horarioid);
                        $nuevoEmpleado->sucursal()->associate($sucursal);
                        $nuevoEmpleado->horario()->associate($horario);
                        $personal->empleado()->save($nuevoEmpleado);

                        $nuevoPersonalOperativo= new Personal_operativo();
                        $nuevoEmpleado->personal_operativo()->save($nuevoPersonalOperativo);
                    }
                    else{
                        $empleado=Empleado::find($personal->empleado->id);
                        $empleado->cargo=$datos->cargo1;
                        $empleado->save();
                        if(is_null($personal->empleado->personal_operativo)){//De administrativo a Personal operativo
                            $administrativo=Administrativo::find($personal->empleado->administrativo->id);
                            $administrativo->delete();
                            $nuevoPersonalOperativo= new Personal_operativo();
                            $empleado->personal_operativo()->save($nuevoPersonalOperativo);

                        }
                    }
                    break;
                case '2':

                    if(is_null($personal->empleado)){ //De tripulante a tripulante                        
                        $tripulante=Tripulante::find($personal->tripulante->id);
                        $tripulante->rango=$datos->cargo2;
                        $tripulante->licencia=$datos->licencia;
                        $tripulante->save();                        
                    }
                    else{ //De empleado a tripulante
                            $empleado=Empleado::find($personal->empleado->id);
                            $empleado->delete();
                            $nuevoTripulante= new Tripulante();
                            $nuevoTripulante->rango=$datos->cargo2;
                            $nuevoTripulante->licencia=$datos->licencia;
                            $personal->tripulante()->save($nuevoTripulante);
                        }
                    break;
                case '3':
                    if(is_null($personal->empleado)){ //De tripulante a Administrativo
                        $tripulante=Tripulante::find($personal->tripulante->id);
                        $tripulante->delete();

                        $nuevoEmpleado= new Empleado();
                        $nuevoEmpleado->cargo=$datos->cargo3;
                        $sucursal=Sucursal::find($datos->sucursalid);
                        $horario=Horario::find($datos->horarioid);
                        $nuevoEmpleado->sucursal()->associate($sucursal);
                        $nuevoEmpleado->horario()->associate($horario);
                        $personal->empleado()->save($nuevoEmpleado);

                        $nuevoAdministrativo= new Administrativo();
                        $nuevoEmpleado->administrativo()->save($nuevoAdministrativo);
                    }
                    else{
                        $empleado=Empleado::find($personal->empleado->id);
                        $empleado->cargo=$datos->cargo3;
                        $empleado->save();
                        if(is_null($personal->empleado->administrativo)){//De Personal operativo a administrativo
                            $personal_operativo=Personal_operativo::find($personal->empleado->personal_operativo->id);
                            $personal_operativo->delete();

                            $nuevoAdministrativo= new Administrativo();
                            $empleado->administrativo()->save($nuevoAdministrativo);

                        }
                    }
                    break;
            }

            flash::info('Los datos del empleado '.$personal->apellidos." ".$personal->nombres." han sido modificado");
            return redirect('/gerencia/RRHH');
        }else{
            flash::info('Este campo no se puede modificar');
            return redirect('/gerencia/RRHH');
        }
    }
}
