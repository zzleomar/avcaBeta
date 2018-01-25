<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Nomina;
use App\vouche;
use App\Tripulante;
use App\Tabulador;
use App\Cesta_ticket;
use App\Personal;
use Auth;
use App\Asistencia;
use App\Empleado;
use Szykra\Notifications\Flash;

class NominaController extends Controller
{
    public function __construct(){
        Carbon::resetToStringFormat();
      Carbon::setLocale('es');
      date_default_timezone_set('America/Caracas');
    }
    public function UltimoDiaMesAnterior($mes,$year){
        $salida=Carbon::create($year,$mes,(cal_days_in_month(CAL_GREGORIAN,$mes, $year)));
        while (($salida->formatLocalized('%A')!='Sunday')&&($salida->formatLocalized('%A')!='domingo')){//ubico la salida en el ultimo dia de la ultima semana del mes anterior con las asistencias
                $salida->addDay();
        }
        return $salida;
    }
    public function generar($tipo, $opc, $nomina){
        $totalUtilidades=0;
        $totalVacaciones=0;
    	if($opc=='1'){ //si es la nomina actual
        	$actual=Carbon::now();
            setlocale(LC_TIME, "es");
            $mes=strftime('%B');
            $nomina=Nomina::Actual($actual->month,$actual->year)->first();
            if(!(is_null($nomina))) //Si la nomina actual esta creada
            {//Enviar información a la vista
                if($tipo==2){
                    
                    $vouches=$nomina->vouches;
                    return view('gerente-RRHH.ajax.nomina-ajax')
                                ->with('vouches',$vouches)
                                ->with('nomina',$nomina)
                                ->with('mes',$mes);
                    //es GERENTE RRHH
                }
                else{
                    //ES SUBGERENTE DE SUCURSAL
                    $personal=Personal::find(Auth::user()->personal_id);
                    $sucursal= $personal->empleado->sucursal;
                    $vouches=$nomina->vouchesS($sucursal->id,$nomina->id)->get();
                    $vouchesA=array();
                    
                    $nomina->monto_sueldos=0;
                    $nomina->monto_compensacion=0;
                    $nomina->monto_deducciones=0;
                    $nomina->monto_antiguedad=0;
                    foreach ($vouches as $idvouche) {
                        $voucheAux=Vouche::find($idvouche)->first();
                        $nomina->monto_sueldos=$nomina->monto_sueldos+$voucheAux->sueldo_base;
                        $nomina->monto_compensacion=$nomina->monto_compensacion+$voucheAux->compensacion;
                        $nomina->monto_deducciones=$nomina->monto_deducciones+$voucheAux->deduccion;
                        $nomina->monto_antiguedad=$nomina->monto_antiguedad+$voucheAux->antiguedad;
                        $nomina->monto_cesta_tickets=$nomina->monto_cesta_tickets+$voucheAux->cestaTicket->monto;
                        array_push($vouchesA, $voucheAux);
                    }
                    return view('gerente-RRHH.ajax.nomina-ajax')
                                ->with('vouches',$vouchesA)
                                ->with('nomina',$nomina)
                                ->with('mes',$mes);

                }
                
            }
            else{
                if($tipo==1){
                    flash::error('Debe esperar que el Gerente de RRHH genere esta nómina');
                    return view('taquillero.ajax.info-error');
                }

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
                    $vouchesA =array();
                    foreach ($empleados as $empleado) {
                        $sueldobase=$this->calcularSueldoBase($empleado);
                        $compensacion=0;
                        $antiguedad=$this->calcularAntiguedad($empleado,$sueldobase,$compensacion,$actual);
                        $ausencias=$this->ausencias($empleado,$inicio,$final,$sueldobase);
                        $deduc=$this->calcularDeducciones($sueldobase,$ausencias,$inicio, $final);

                        $utilidades=$this->calculoUtilizades($sueldobase,$actual,$compensacion,$antiguedad);
                        $vacaciones=$this->calculoVacaciones($empleado,$sueldobase,$actual,$compensacion,$antiguedad);
                        $cestatikes=$this->calculoCestatikes($ausencias,$empleado);
                        if($cestatikes->monto<0){
                            $cestatikes->monto=0;
                        }

                        $empleadoA= array("empleado" => $empleado,
                                          "deducciones" => $deduc,
                                            "sueldobase" => $sueldobase,
                                            "antiguedad" => $antiguedad,
                                            "bonocompensacion" => $compensacion,
                                            "utilidades" => $utilidades,
                                            "ausencias" => $ausencias,
                                            "vacaciones" => $vacaciones,
                                            "cestatikes" => $cestatikes);
                        array_push($vouchesA, $empleadoA);
                        //FAlta unos calculos y congretar montos datos para la tabla nomina y generarla con su vouches
                    }//FIN FOREACH EMPLEADO
                    
                }

                $tripulantes=Tripulante::all();
                foreach ($tripulantes as $tripulante){
                    $sueldobase=$this->calcularSueldoBase($tripulante);
                    $compensacion=$this->calculocompenzacion($sueldobase);
                    $antiguedad=$this->calcularAntiguedad($tripulante,$sueldobase,$compensacion,$actual);
                    $ausencias="0";
                    $deduc="0";

                    $utilidades=$this->calculoUtilizades($sueldobase,$actual,$compensacion,$antiguedad);
                    $vacaciones=$this->calculoVacaciones($tripulante,$sueldobase,$actual,$compensacion,$antiguedad);
                    $cestatikes=$this->calculoCestatikes($ausencias, $tripulante);
                    if($cestatikes->monto<0){
                        $cestatikes->monto=0;
                    }
                    $empleadoA= array("empleado" => $tripulante,
                                      "deducciones" => $deduc,
                                        "sueldobase" => $sueldobase,
                                        "antiguedad" => $antiguedad,
                                        "bonocompensacion" => $compensacion,
                                        "utilidades" => $utilidades,
                                        "ausencias" => $ausencias,
                                        "vacaciones" => $vacaciones,
                                        "cestatikes" => $cestatikes);
                    array_push($vouchesA, $empleadoA);

                }
                $newnomina=new nomina();
                $newnomina->fecha=$actual->toDateTimeString();
                $newnomina->save();
                foreach ($vouchesA as $vouche){
                    $newvouche=new Vouche();
                    $newvouche->sueldo_base=$vouche['sueldobase'];
                    $newvouche->personal_id=$vouche['empleado']->personal_id;
                    $newvouche->nomina_id=$newnomina->id;
                    $newvouche->utilidad=$vouche['utilidades'];
                    $newvouche->vacacion=$vouche['vacaciones'];
                    $newvouche->deduccion=$vouche['deducciones'];
                    $newvouche->compensacion=$vouche['bonocompensacion'];
                    $newvouche->antiguedad=$vouche['antiguedad'];
                    $newvouche->ausencias=$vouche['ausencias'];
                    $newvouche->sueldoMinimo_id=Tabulador::buscar("sueldo minimo")->first()->id;
                    $newvouche->escala_id=Tabulador::buscar("escala")->first()->id;
                    $newvouche->antiguedad_id=Tabulador::buscar("antiguedad")->first()->id;
                    $newvouche->compensacion_id=Tabulador::buscar("bono compensacion")->first()->id;
                    $newvouche->constante_id=Tabulador::buscar("constante")->first()->id;
                    $newnomina->monto_sueldos=$newnomina->monto_sueldos+$newvouche->sueldo_base;
                    $newnomina->monto_compensacion=$newnomina->monto_compensacion+$newvouche->compensacion;
                    $newnomina->monto_deducciones=$newnomina->monto_deducciones+$newvouche->deduccion;
                    $newnomina->monto_antiguedad=$newnomina->monto_antiguedad+$newvouche->antiguedad;

                    $newnomina->monto_utilidades=$newnomina->monto_utilidades+$newvouche->utilidad;
                    $newnomina->monto_vacaciones=$newnomina->monto_vacaciones+$newvouche->vacacion;
                    $newnomina->monto_cesta_tickets=$newnomina->monto_cesta_tickets+$vouche['cestatikes']->monto;

                    $newvouche->save();
                    $vouche['cestatikes']->vouche_id=$newvouche->id;
                    $vouche['cestatikes']->save();
                }
                $newnomina->save();
                return view('gerente-RRHH.ajax.nomina-ajax')
                            ->with('vouches',$newnomina->vouches)
                            ->with('nomina',$newnomina)
                            ->with('mes',$mes);

                //Hacer calculos por personal
        	} //FIN SI ES UNA NOMINA NUEVA
        }
    	else{ //si es otra nomina
            setlocale(LC_TIME, "es");
            $nomina=Nomina::find($nomina);
            $faux=Carbon::parse($nomina->fecha);
            $mes=$faux->formatLocalized('%B');
            if($tipo==2){//Si es un Gerente de RRHH
                    $vouchesA=$nomina->vouches;
                            
            }
            else{
                $personal=Personal::find(Auth::user()->personal_id);
                $sucursal= $personal->empleado->sucursal;
                $vouches=$nomina->vouchesS($sucursal->id,$nomina->id)->get();
                $vouchesA=array();
                
                $nomina->monto_sueldos=0;
                $nomina->monto_compensacion=0;
                $nomina->monto_deducciones=0;
                $nomina->monto_antiguedad=0;
                foreach ($vouches as $idvouche) {
                    $voucheAux=Vouche::find($idvouche)->first();
                    $nomina->monto_sueldos=$nomina->monto_sueldos+$voucheAux->sueldo_base;
                    $nomina->monto_compensacion=$nomina->monto_compensacion+$voucheAux->compensacion;
                    $nomina->monto_deducciones=$nomina->monto_deducciones+$voucheAux->deduccion;
                    $nomina->monto_antiguedad=$nomina->monto_antiguedad+$voucheAux->antiguedad;
                    $nomina->monto_utilidades=$nomina->monto_utilidades+$voucheAux->utilidad;
                    $nomina->monto_vacaciones=$nomina->monto_vacaciones+$voucheAux->vacacion;
                    
                    $nomina->monto_cesta_tickets=$nomina->monto_cesta_tickets+$voucheAux->cestaTicket->monto;
                    array_push($vouchesA, $voucheAux);
                }
               //ES SUBGERENTE DE SUCURSAL
            }

            return view('gerente-RRHH.ajax.nomina-ajax')
                            ->with('vouches',$vouchesA)
                            ->with('nomina',$nomina)
                            ->with('mes',$mes);
    	}
    }

    public function calculocompenzacion($sueldobase){
        $compensacion=Tabulador::buscar("bono compensacion")->first();
        return ($sueldobase*$compensacion->digito)/100;
    }
    public function calculoUtilizades($sueldobase,$actual,$compensacion,$antiguedad){
        $utilidadesDi=Tabulador::buscar("utilidad")->first();
        $utilidades=0;
        if($actual->month==11){
            $utilidades=(($sueldobase+$compensacion+$antiguedad)/30)*$utilidadesDi->digito;
        }
        return round($sueldobase,2);
    }
    public function calculoVacaciones($empleado,$sueldobase,$actual,$compensacion,$antiguedad){
        $vacacionesDi=Tabulador::buscar("vacaciones")->first();
        $vacaciones=0;
        $personal=Personal::find($empleado->personal_id);
        $entrada=Carbon::parse($personal->entrada);
        if($entrada->month==$actual->month){
            $vacaciones=(($sueldobase+$compensacion+$antiguedad)/30)*$vacacionesDi->digito;
        }
        return round($vacaciones,2);
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
        return round($sueldoBase,2);
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
            return round((($sueldobase+$bonocompensacion)*(($antiguedad->digito/100)*$year)), 2);

        }
        else{
            return 0;
        }

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

    public function calculoCestatikes($deducciones,$empleadoET){
        $ut=Tabulador::buscar("unidad tributaria")->first();
        $cesta=Tabulador::buscar("cesta")->first();
        $diasNolaborados=$deducciones/8;
        $cestatikesNew= new Cesta_ticket();
        if((30-(intval($diasNolaborados)))<0){
            $cestatikesNew->monto=0;
            $cestatikesNew->dias=0;
        }
        else{
            $cestatikesNew->monto=(round(($cesta->digito*$ut->digito*(30-(intval($diasNolaborados)))),2));
            $cestatikesNew->dias=(30-(intval($diasNolaborados)));
        }
        $cestatikesNew->personal_id=$empleadoET->personal_id;
        $cestatikesNew->unidadTributaria_id=$ut->id;
        return $cestatikesNew;
    }

    public function calcularDeducciones($sueldobase,$deduc, $inicio, $final){
        if($deduc==999){
            return $sueldobase;
        }
        else{
            $Tdias=$inicio->diffInDays($final);
            $horas=(intval(($Tdias+1)/7))*40;//Total de horas que se debio laborar
            $deduc2=($deduc*$sueldobase)/$horas;
            return round($deduc2,2);
        }
    }
}

