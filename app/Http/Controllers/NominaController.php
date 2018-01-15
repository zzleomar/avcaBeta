<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Nomina;
use App\vouche;
use App\Tripulante;
use App\Tabulador;
use App\Personal;
use App\Asistencia;
use App\Empleado;

class NominaController extends Controller
{
    public function __construct(){
        Carbon::resetToStringFormat();
      Carbon::setLocale('es');
      date_default_timezone_set('America/Caracas');
    }
    public function UltimoDiaMesAnterior($mes,$year){
        $salida=Carbon::create($year,$mes,(cal_days_in_month(CAL_GREGORIAN,$mes, $year)));
        while ($salida->formatLocalized('%A')!='Sunday'){//ubico la salida en el ultimo dia de la ultima semana del mes anterior con las asistencias
                $salida->addDay();
        }
        return $salida;
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
                $Faux=$actual->copy();
                $Faux->subMonth();
                $final=$this->UltimoDiaMesAnterior($Faux->month,$Faux->year);
                if(!($actual->gt($final))){
                    Carbon::setToStringFormat('jS \o\f F, Y');
                    dd("Debe esperar hasta el dia ".$final." para generar esta nómina");
                    Carbon::resetToStringFormat();
                }
                else{
                    $empleados=Empleado::all();
                    $Faux=$actual->copy();
                    $Faux->subMonths(2);
                    $inicio=$this->UltimoDiaMesAnterior($Faux->month,$Faux->year);
                    $inicio->addDay();
                    $deducciones =array();
                    foreach ($empleados as $empleado) {
                        $sueldobase=$this->calcularSueldoBase($empleado);
                        $compensacion=0;
                        $antiguedad=$this->calcularAntiguedad($empleado,$sueldobase,$compensacion,$actual);
                        $ausencias=$this->ausencias($empleado,$inicio,$final,$sueldobase);
                        $deduc=$this->calcularDeducciones($sueldobase,$ausencias);
                        $utilidades=0;
                        $vacaciones=$this->calculoVacaciones($empleado,$sueldobase,$actual);
                        $cestatikes=$this->calculoCestatikes($ausencias);
                        $empleadoA= array("empleado" => $empleado,
                                          "deducciones" => $deduc,
                                            "sueldobase" => $sueldobase,
                                            "antiguedad" => $antiguedad,
                                            "bonocompensacion" => $compensacion,
                                            "utilidades" => $utilidades,
                                            "ausencias" => $ausencias,
                                            "vacaciones" => $vacaciones,
                                            "cestatikes" => "0");
                        array_push($deducciones, $empleadoA);
                        //FAlta unos calculos y congretar montos datos para la tabla nomina y generarla con su vouches
                }//FIN FOREACH EMPLEADO
                dd($deducciones);
                    
                }
                        
                dd("Es una nomina nueva");//Hacer calculos por personal
        	} //FIN SI ES UNA NOMINA NUEVA
        }
    	else{ //si es otra nomina
    		$nomina=Nomina::find($nomina);

    	}
    }

    public function calculoVacaciones($empleado,$sueldobase,$actual){
        $vacaciones=0;
        $personal=Personal::find($empleado->personal_id);
        $entrada=Carbon::parse($personal->entrada);
        if($entrada->mes==$actual->mes){
            $vacaciones=$sueldobase;
        }
        return $vacaciones;        
    }
    public function calcularSueldoBase($empleado){
        $escala=Tabulador::buscar("escala")->first();
        $sueldo_minimo=Tabulador::buscar("sueldo minimo")->first();
        $constante=Tabulador::buscar("constante")->first();
        $sueldoBase=$constante->digito*$sueldo_minimo->digito;
        $personal=Personal::find($empleado->personal_id);
        if($personal->nivel>1){
            for ($i=2; $i <=$personal->nivel ; $i++) { 
                $sueldoBase=$sueldoBase*$escala->digito;
            }
        }
        return $sueldoBase;
    }
    public function calcularAntiguedad($empleado,$sueldobase,$bonocompensacion,$actual){
        $antiguedad=Tabulador::buscar("antiguedad")->first();
        $personal=Personal::find($empleado->personal_id);
        $dias=$actual->diffInDays(Carbon::parse($personal->entrada));
        $yearT=$dias/365;
        if($yearT>0.5){
            $year=intval($yearT);
            if(($yearT-$year)>=0.5){
                $year++;
            }
        }
        dd(($sueldobase+$bonocompensacion)*(($antiguedad->digito/100)*$year));

    }
    public function ausencias($empleado, $inicio, $final,$sueldobase){
        $findesemana;
        $asistencias=Asistencia::asistenciaMes($inicio->toDateTimeString(),$final->toDateTimeString(),$empleado->id)->get();
            if(sizeof($asistencias)!=0){
                $deduc=0;
                $acumuladorDeHoras=0;
                $findesemana=$inicio->copy();
                $semana=1;
                foreach ($asistencias as $asistencia) {
                    $entrada=Carbon::parse($asistencia->entrada);
                    if(!($entrada->lt($findesemana))){//Si la entrada pertenece a otra semana
                        $diferencia=$entrada->diffInDays($findesemana);
                        if($diferencia>=7){
                            $auxSem=intval($diferencia/7);
                            $deduc=$auxSem*40;
                            $findesemana->addDays(((7*($auxSem+1))-1));//Paso a la siguiente semana
                            $semana=$semana+$auxSem+1;
                        }
                        else{
                            if(($acumuladorDeHoras+$deduc)<(40*$semana)){
                                //Si no cumplio las 40 horas semanales
                                $deduc=$deduc+((40*($semana-1))-($acumuladorDeHoras+$deduc)); //Descuentos de dias no laborados

                            }
                            $semana++;
                            $findesemana->addDays(6);//Paso a la siguiente semana
                        }
                    }
                    $salida=Carbon::parse($asistencia->salida);
                    $min=$entrada->diffInMinutes($salida);
                    $horasT=$min/60;
                    $horas=intval($horasT);
                    if($horasT>=8){
                        $acumuladorDeHoras=$acumuladorDeHoras+8;
                    }
                    else{
                        $deduc=$deduc+8-$horas;
                        $acumuladorDeHoras=$acumuladorDeHoras+$horas;
                        if(($horasT-$horas)>=0.5){
                            $deduc--;
                            $acumuladorDeHoras++;
                        }
                    }
                }//FIN FOREACH DE ASISTENCIA
            }//FIN SI ASISTENSIA ES DISTINTO DE 0
        else{//SI el empleado no posee asistencia en todo el mes
            $deduc=999;
        }
        if($deduc!=999){
            $auxDiaSemana=$final->diffInDays($findesemana);
            if($auxDiaSemana>7){
                //SI la ultima semana que laboro no fue la ultima
                $deduc=$deduc+(40*(intval($auxDiaSemana/7)));
                        $borrar=$borrar." ".$deduc;
            }
            else{ //si laboro la ultima semana
                if(($acumuladorDeHoras+$deduc)<(40*($semana-1))){
                    //Si no cumplio las 40 horas de la ultima semana
                    $deduc=$deduc+((40*($semana-1))-($acumuladorDeHoras+$deduc)); //Descuentos de dias no laborados
                }
            }
        }
        return $deduc;
        
    }
    public calcularDeducciones($sueldobase,$deduc){
        if($deduc==999){
            return $sueldobase;
        }
        else{
            $Tdias=$inicio->diffInDays($final);
            $horas=$Tdias*40; //Total de horas que se debio laborar
            $deduc=($deduc*$sueldobase)/$horas;
            return $deduc;
        }
    }
}