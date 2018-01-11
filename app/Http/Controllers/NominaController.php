<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Nomina;
use App\vouche;

class NominaController extends Controller
{
    public function __construct(){
      Carbon::setLocale('es');
      date_default_timezone_set('America/Caracas');
    }
    public function generar($opc, $nomina){
    	if($opc=='1'){ //si es la nomina actual
        	$actual=Carbon::now();
            $nomina=Nomina::Actual($actual->month,$actual->year)->first();
            if(!(is_null($nomina))) //Si la nomina actual esta creada
            {//Enviar información a la vista
                dd($nomina->vouche[0]->personal);//
                
            }
            else{
                dd("Es una nomina nueva");//Hacer calculos por personal
            }
    	}
    	else{ //si es otra nomina
    		$nomina=Nomina::find($nomina);

    	}

    }
}
