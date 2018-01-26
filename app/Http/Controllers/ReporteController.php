<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vuelo;
use Auth;
use App\Personal;
use Carbon\Carbon;



class ReporteController extends Controller
{
    public function ReporteIngreso(){
        $actual=Carbon::now();
    	$inicio=Carbon::parse($actual->year."-".$actual->month."-01");
    	if(Auth::user()->tipo=='Subgerente de Sucursal'){
    		$personal=Personal::find(Auth::user()->personal_id);
	        $sucursal= $personal->empleado->sucursal;
	        $idsucursal=$sucursal->id;
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
    		$idsucursal=0;
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
    	$datosG=Vuelo::reporte($inicio,$actual,$idsucursal);
    	if(sizeof($datosG)){
    		setlocale(LC_TIME, "es");
			$mes1=$inicio->formatLocalized('%B');
			$mes2=$actual->formatLocalized('%B');
			if($mes1==$mes2){
    			$titulo="Ventas del ".$inicio->day." al ". $actual->day." de ".$mes1." del ".$actual->year;
			}
			else{
    			$titulo="Ventas del ".$inicio->day." de ".$mes1." al ". $actual->day." ".$mes2." del ".$actual->year;
			}
    	}else{
    		$titulo="No Existen ventas registradas en el periodo indicado";
    	}
    	$dias=array();
    	$entradas=array();
    	foreach ($datosG as $dato){
    		array_push($dias, "Dia".$dato->day);
    		array_push($entradas, $dato->venta);
    	}
    	$chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels($dias)
        ->datasets([
            [
                "label" => "Ingresos de Boleteria",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $entradas,
            ]
        ])
        ->options([]);
	 
	 	return view('subgerente-sucursal.reportes',compact('chartjs'))->with("datos",$datos)->with('titulo',$titulo); 

    }
    public function AjaxReporteIngreso($tipo){
    	if(Auth::user()->tipo=='Subgerente de Sucursal'){
    		$personal=Personal::find(Auth::user()->personal_id);
	        $sucursal= $personal->empleado->sucursal;
	        $idsucursal=$sucursal->id; 	
    	}
    	else{
	        $idsucursal=0;
    	}
    	$actual=Carbon::now();
    	$actual=Carbon::now();
    	$inicio=Carbon::parse($actual->year."-".$actual->month."-01");
    	if(Auth::user()->tipo=='Subgerente de Sucursal'){
    		$personal=Personal::find(Auth::user()->personal_id);
	        $sucursal= $personal->empleado->sucursal;
	        $idsucursal=$sucursal->id;
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
    		$idsucursal=0;
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
    	switch ($tipo) {
    		case '1': //Lo que va de mes
		    	$inicio=Carbon::parse($actual->year."-".$actual->month."-01");
    			break;
    		case '2': //Semana Pasada
    			$actual->subDays(7);
    			while (($actual->formatLocalized('%A')!='Sunday')&&($actual->formatLocalized('%A')!='domingo')){
    				$actual->addDay();
        		}
		    	$inicio=$actual->copy();
		    	$inicio->subDays(6);		    	
    			break;
    		case '3'://mes Pasado
    			$actual->subMonth();
    			$actual=Carbon::create($actual->year,$actual->month,(cal_days_in_month(CAL_GREGORIAN, $actual->month,$actual->year)));
    			$inicio=$actual->copy();
    			$inicio->day=1;
    			break;
    	}
    	$datosG=Vuelo::reporte($inicio->year."-".$inicio->month."-".$inicio->day,$actual->year."-".$actual->month."-".$actual->day,$idsucursal);
    	if(sizeof($datosG)){
    		setlocale(LC_TIME, "es");
			$mes1=$inicio->formatLocalized('%B');
			$mes2=$actual->formatLocalized('%B');
			if($mes1==$mes2){
    			$titulo="Ventas del ".$inicio->day." al ". $actual->day." de ".$mes1." del ".$actual->year;
			}
			else{
    			$titulo="Ventas del ".$inicio->day." de ".$mes1." al ". $actual->day." ".$mes2." del ".$actual->year;
			}
    	}else{
    		$titulo="No Existen ventas registradas en el periodo indicado";
    	}
    	$dias=array();
    	$entradas=array();
    	foreach ($datosG as $dato){
    		array_push($dias, "Dia".$dato->day);
    		array_push($entradas, $dato->venta);
    	}
    	$chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels($dias)
        ->datasets([
            [
                "label" => "Ingresos de Boleteria",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $entradas,
            ]
        ])
        ->options([]);
	 	return view('subgerente-sucursal.reportes',compact('chartjs'))->with("datos",$datos)->with('titulo',$titulo)->with("tipo",$tipo); 

        //return view('subgerente-sucursal.ajax.reporte-ajax',compact('chartjs'))->with("titulo",$titulo)->with("datos",$datos);
    }
}
