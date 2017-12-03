<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personal;
use App\User;
use App\Horario;
use App\Sucursal;
use App\Administrativo;


class ControllerP extends Controller
{
    public function mostrar(){
    	$datos=Personal::orderBy('id')->get();
    	dd($datos);
    }
    public function guardar(Request $nuevo){
    	$horario =new Horario();
    	$horario->save();

    	$sucursal =new Sucursal();
    	$sucursal->nombre=$nuevo->nombre;
		$sucursal->direccion=$nuevo->direccions;
		$sucursal->tasa_salida="2000";
		$sucursal->tasa_mantenimiento="5000";
		$sucursal->save();

		$personal= new Personal();
		$personal->nombres= $nuevo->nombres;
		$personal->apellidos= $nuevo->apellidos;
		$personal->cedula= $nuevo->cedula;
		$personal->tlf_movil= $nuevo->tlf_movil;
		$personal->tlf_casa= $nuevo->tlf_casa;
		$personal->direccion= $nuevo->direccion;
		$personal->save();


		$administrativo= new Administrativo();
		$administrativo->horas_laboradas= 0;
		$administrativo->horas_extras= 0;
		$administrativo->cargo= $nuevo->cargo;
        $administrativo->sucursal()->associate($sucursal);
        $horario=Horario::find('1');
        $administrativo->horario()->associate(Horario::find('1'));
        $personal->administrativo()->save($administrativo);

        $user= new User();
		$user->username=$nuevo->username;
		$user->tipo=$nuevo->tipo;
		$user->password=bcrypt($nuevo->password);
		$user->email=$nuevo->email;
		 $administrativo->user()->save($user);
     

    }
}
