<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sucursal;
use Szykra\Notifications\Flash;
use App\Ruta;
use App\Vuelo;
use App\Pierna;
use App\Aeronave;
use App\Personal_operativo;
use Carbon\Carbon;

class GerenciaSucursalesController extends Controller
{
    public function __construct(){
      Carbon::setLocale('es');
      date_default_timezone_set('America/Caracas');
    }
    public function index(){
        $sucursal=Sucursal::orderBy('nombre','ASC')->get();
    	return view('gerente-sucursales.index')->with('origenes',$sucursal);
    }

    public function destinos($id){
    	$sucursal = Sucursal::find($id);
    	$destinos=$sucursal->destinos;
    	return view('gerente-sucursales.ajax.destinos-ajax')->with('destinos',$destinos);
    }

    public function vuelos($origen,$destino){
        $vuelo= new Vuelo();
        $Sorigen= Sucursal::find($origen);
        $Sdestino= Sucursal::find($destino);
        $ruta =  Ruta::Buscador($origen,$destino)->first();
        $vuelos1= $vuelo->Buscador($ruta->id,"abierto");
        $vuelos2= $vuelo->Buscador($ruta->id,"ejecutado");
        $vuelos3= $vuelo->Buscador($ruta->id,"cancelado");
        $vuelos4= $vuelo->Buscador($ruta->id,"retrasado");
   		$ruta2= array('ruta' => $Sorigen->nombre." --> ".$Sdestino->nombre, 'origen_id' => $Sorigen->id, 'destino_id' => $Sdestino->id  );
   		return view('gerente-sucursales.ajax.vuelos-ajax')
   			->with('abiertos',$vuelos1)
   			->with('ejecutados',$vuelos2)
   			->with('cancelados',$vuelos3)
   			->with('retrasados',$vuelos4)
   			->with('ruta',$ruta2);
    }

    public function vuelo($id){
        $vuelo= Vuelo::find($id);
        $boletos=['Pagado','Reservados'];
        $estado=[0 => "Pagado"];
        $boletos['Pagado']= $vuelo->Disponibilidad($estado,$id);
        $estado[0]="Reservados";
        $boletos['Reservados']= $vuelo->Disponibilidad($estado,$id);
        $vuelo->personal_operativo();
       // dd($vuelo->pierna->aeronave->matricula);
        return view('gerente-sucursales.ajax.ver-vuelo-ajax')
                ->with('boletos',$boletos)
                ->with('vuelo',$vuelo); 
    }

    public function CancelarVuelo(Request $request){
      $vuelo = new Vuelo();
      $vuelo->Actualizar($request->vuelo_id,"cancelado");
      flash::success('El vuelo '.$request->vuelo_id.' ha sido cancelado');
      return redirect('/gerente-sucursales');
    }

    public function consultarDisponibilidad($salida,$origen, $destino){
      $central= Sucursal::find(1);
      $year=DATE("Y",strtotime($salida));
      $mes=DATE("m",strtotime($salida));
      $dia=DATE("d",strtotime($salida));
      $minuto=DATE("i",strtotime($salida)); //minutos
      $hora=DATE("H",strtotime($salida));//hora en formato 24hras
      $actual = Carbon::now();
      $salidaCarbon = Carbon::parse($salida);
      $actual->addHours(4); //agg 4hras a la hora actual con el fin de permitir planificar vuelos con minimo 4hras de antelación
      if(($hora>20)&&($destino!=$central->id)){
            flash::error('No se permiten vuelos en este horario para esta ruta seleccione un horario para antes de las 6pm');
            return view('taquillero.ajax.info-error');
      }
      else{
        if(!($salidaCarbon->gt($actual))){ //si la salida no es despues de la fecha actual
            flash::error('Solo se permiten programar vuelos con por lo menos 4 horas de anticipación');
            return view('taquillero.ajax.info-error');
        }
        else{
            if(($hora<8)&&($origen!=$central->id)){
                flash::error('No se pemiten vuelos en este horario para esta ruta seleccione un horario a partir de las 8am');
                return view('taquillero.ajax.info-error');
        }
        else{
          $personal= new Personal_operativo();
          $aeronave= new Aeronave();
          $horaA=$hora-4;
          $horaD=$hora+4;
          $antes=$year.'-'.$mes.'-'.$dia.' '.$horaA.':'.$minuto.':00';
          $despues=$year.'-'.$mes.'-'.$dia.' '.$horaD.':'.$minuto.':00';          
          $pilotos=$personal->Disponibilidad("Piloto",$antes,$despues);
          $copilotos=$personal->Disponibilidad("Copiloto",$antes,$despues);
          $sobrecargos=$personal->Disponibilidad("Sobrecargo",$antes,$despues);
          $jefacs=$personal->Disponibilidad("Jefe de Cabina",$antes,$despues);
          $aeronaves=$aeronave->Disponibilidad($antes,$despues);
          if(($origen!=$central->id)&&($destino!=$central->id)){
            $pierna=3;
            $ruta1=Ruta::Buscador($central->id,$origen)->first();
            $ruta2=Ruta::Buscador($origen,$destino)->first();
            $ruta3=Ruta::Buscador($destino,$central->id)->first();
            if(!isset($ruta1)){
              $auxS= Sucursal::find($origen);
              flash::error('Registre la ruta '.$central->nombre.' --> '.$auxS->nombre.'  para poder planificar este vuelo');
              return view('gerente-sucursales.ajax.info-error');
            }
            if(!isset($ruta2)){
              $auxS= Sucursal::find($origen);
              $auxS2= Sucursal::find($destino);
              flash::error('Registre la ruta '.$auxS->nombre.' --> '.$auxS2->nombre.'  para poder planificar este vuelo');
              return view('gerente-sucursales.ajax.info-error');
            }
            if(!isset($ruta3)){
              $auxS= Sucursal::find($destino);
              flash::error('Registre la ruta '.$auxS->nombre.' --> '.$central->nombre.'  para poder planificar este vuelo');
              return view('gerente-sucursales.ajax.info-error');
            }
            $piernas = array('ruta1' => $ruta1,
                             'ruta2' => $ruta2,
                             'ruta3' => $ruta3);
            $horaD=$hora-4;
            $horaA=$hora-2;
            $antes=$year.'-'.$mes.'-'.$dia.' '.$horaA.':'.$minuto.':00';
            $despues=$year.'-'.$mes.'-'.$dia.' '.$horaD.':'.$minuto.':00';
            $primero = array('despues' => $despues,
                             'antes'   => $antes);
            $segundo=$salida;
            $horaD=$hora+2;
            $horaA=$hora+4;
            $antes=$year.'-'.$mes.'-'.$dia.' '.$horaA.':'.$minuto.':00';
            $despues=$year.'-'.$mes.'-'.$dia.' '.$horaD.':'.$minuto.':00';
            $tercero = array('despues' => $despues,
                             'antes'   => $antes); 
                return view('gerente-sucursales.ajax.programar-vuelo-OD-ajax')
                    ->with('aeronaves',$aeronaves)
                    ->with('pilotos',$pilotos)
                    ->with('copilotos',$copilotos)
                    ->with('jefacs',$jefacs)
                    ->with('sobrecargos',$sobrecargos)
                    ->with('piernas',$piernas)
                    ->with('primero', $primero)
                    ->with('segundo', $segundo)
                    ->with('tercero', $tercero);           
          }
          else{
            if($origen==$central->id){
              $pierna=2;
              $ruta1=Ruta::Buscador($origen,$destino)->first();
              $ruta2=Ruta::Buscador($destino,$origen)->first();

              if(!isset($ruta1)){
                $auxS= Sucursal::find($origen);
                $auxS2= Sucursal::find($destino);
                flash::error('Registre la ruta '.$auxS->nombre.' --> '.$auxS2->nombre.'  para poder planificar este vuelo');
                return view('gerente-sucursales.ajax.info-error');
              }
              if(!isset($ruta2)){
                $auxS= Sucursal::find($destino);
                $auxS2= Sucursal::find($origen);
                flash::error('Registre la ruta '.$auxS->nombre.' --> '.$auxS2->nombre.'  para poder planificar este vuelo');
                return view('gerente-sucursales.ajax.info-error');
              }
              $piernas = array('ruta1' => $ruta1,
                               'ruta2' => $ruta2);
              $primero=$salida;
              $horaD=$hora+2;
              $horaA=$hora+4;
              $antes=$year.'-'.$mes.'-'.$dia.' '.$horaA.':'.$minuto.':00';
              $despues=$year.'-'.$mes.'-'.$dia.' '.$horaD.':'.$minuto.':00';
              $segundo= array('despues' => $despues,
                               'antes'  => $antes); 
                return view('gerente-sucursales.ajax.programar-vuelo-CD-ajax')
                    ->with('aeronaves',$aeronaves)
                    ->with('pilotos',$pilotos)
                    ->with('copilotos',$copilotos)
                    ->with('jefacs',$jefacs)
                    ->with('sobrecargos',$sobrecargos)
                    ->with('piernas',$piernas)
                    ->with('primero', $primero)
                    ->with('segundo', $segundo);             

            }
            else{
              if($destino==$central->id){
                $pierna=4; //para identificar que es de 2 piernas pero con el destino igual que la central
                $ruta1=Ruta::Buscador($destino,$origen)->first();
                $ruta2=Ruta::Buscador($origen,$destino)->first();
                if(!isset($ruta1)){
                  $auxS= Sucursal::find($destino);
                  $auxS2= Sucursal::find($origen);
                  flash::error('Registre la ruta '.$auxS->nombre.' --> '.$auxS2->nombre.'  para poder planificar este vuelo');
                  return view('gerente-sucursales.ajax.info-error');
                }
                if(!isset($ruta2)){
                  $auxS= Sucursal::find($origen);
                  $auxS2= Sucursal::find($destino);
                  flash::error('Registre la ruta '.$auxS->nombre.' --> '.$auxS2->nombre.'  para poder planificar este vuelo');
                  return view('gerente-sucursales.ajax.info-error');
                }
                $piernas = array('ruta1' => $ruta1,
                                 'ruta2' => $ruta2);
                $horaD=$hora-4;
                $horaA=$hora-2;
                $antes=$year.'-'.$mes.'-'.$dia.' '.$horaA.':'.$minuto.':00';
                $despues=$year.'-'.$mes.'-'.$dia.' '.$horaD.':'.$minuto.':00';
                $primero= array('despues' => $despues,
                                 'antes'  => $antes);
                $segundo=$salida; 
                return view('gerente-sucursales.ajax.programar-vuelo-OC-ajax')
                    ->with('aeronaves',$aeronaves)
                    ->with('pilotos',$pilotos)
                    ->with('copilotos',$copilotos)
                    ->with('jefacs',$jefacs)
                    ->with('sobrecargos',$sobrecargos)
                    ->with('piernas',$piernas)
                    ->with('primero', $primero)
                    ->with('segundo', $segundo);               
              }
            }
          }
        }
      }

    } 
  }

  public function PlanificarVuelo(Request $datos){
    for($i=0 ; $i<sizeof($datos->hora) ; $i++) {
      $vuelo = new Vuelo();
      $vuelo->estado= "abierto";
      $vuelo->salida=$datos->fechaSalida." ".$datos->hora[$i];
      $vuelo->save();

      $pierna = new Pierna();
      $pierna->aeronave_id=$datos->aeronave;
      $pierna->vuelo_id=$vuelo->id;
      $pierna->ruta_id=$datos->ruta[$i];
      $pierna->save();

      $vuelo->personal_operativo()->sync($datos->piloto);
      $vuelo->personal_operativo()->sync($datos->copiloto);
      $vuelo->personal_operativo()->sync($datos->jefac);
      $vuelo->personal_operativo()->sync($datos->sobrecargos[0]);
      $vuelo->personal_operativo()->sync($datos->sobrecargos[1]);
      $vuelo->personal_operativo()->sync($datos->sobrecargos[2]);

    }
        flash::success('El vuelo a sido planificado');
      return redirect('/gerente-sucursales');

  }

}
