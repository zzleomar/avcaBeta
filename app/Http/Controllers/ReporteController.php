<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vuelo;
use Auth;
use App\Personal;


class ReporteController extends Controller
{
    public function ReporteIngreso(){
    	if(Auth::user()->tipo=='Subgerente de Sucursal'){
    		$personal=Personal::find(Auth::user()->personal_id);
	        $sucursal= $personal->empleado->sucursal;
		 	$vuelos=Vuelo::Sucursal($sucursal->id,"abierto");
		 	$datos=array();
		 	foreach ($vuelos as $vuelo) {
		 		$pagado=Vuelo::Boleteria("Pagado",$vuelo->id);
		 		$reservados=Vuelo::Boleteria("Reservado",$vuelo->id);
		 		$registro=array("vuelo"     => Vuelo::find($vuelo->id),
		 						"pagado"    => $pagado,
		 						"reservado" => $reservados);
		 		array_push($datos, $registro);
		 	}
    	}
    	else{
    		$vuelos=Vuelo::Estado("abierto");
		 	$datos=array();
		 	foreach ($vuelos as $vuelo) {
		 		$pagado=Vuelo::Boleteria("Pagado",$vuelo->id);
		 		$reservados=Vuelo::Boleteria("Reservado",$vuelo->id);
		 		$registro=array("vuelo"     => $vuelo,
		 						"pagado"    => $pagado,
		 						"reservado" => $reservados);
		 		array_push($datos, $registro);
		 	}
    	}
    	
	 //	dd(($datos[0]["vuelo"]->pierna->ruta->tarifa_vuelo)*$pagado);
	 	return view('subgerente-sucursal.reportes')->with("datos",$datos);

    }
}
