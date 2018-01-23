<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sucursal;
use Szykra\Notifications\Flash;
use App\Ruta;
use App\Vuelo;
use App\Pierna;
use App\Boleto;
use App\Aeronave;
use App\Tripulante;
use Carbon\Carbon;

class GerenciaSucursalesController extends Controller
{
    public function __construct(){
      Carbon::setLocale('es');
      date_default_timezone_set('America/Caracas');
    }
    public function index(){
      $central= Sucursal::find(1);
      $destinos=$central->destinos;
      $sucursal=Sucursal::orderBy('nombre','ASC')->get();
      $vuelo =new vuelo();
      $vuelos1= $vuelo->FillBuscador("abierto",0)->get();
      //dd($vuelos1[0]->pierna->ruta->origen->nombre);
      $vuelos2= $vuelo->FillBuscador("ejecutado",0)->get();
      $vuelos3= $vuelo->FillBuscador("cancelado",0)->get();
      $vuelo->VuelosRetrasados(date('Y-m-d H:i:s'));
      $vuelos4= $vuelo->FillBuscador("retrasado",0)->get();
    	return view('gerente-sucursales.index')
            ->with('abiertos',$vuelos1)
            ->with('ejecutados',$vuelos2)
            ->with('cancelados',$vuelos3)
            ->with('retrasados',$vuelos4)
            ->with('origenes',$sucursal)
            ->with('destinos',$destinos)
            ->with('central',$central);
    }

    public function vuelos($origen,$destino){
        $vuelo= new Vuelo();
        $Sorigen= Sucursal::find($origen);
        $Sdestino= Sucursal::find($destino);
        $ruta =  Ruta::Buscador($origen,$destino)->first();
        $vuelos1= $vuelo->FillBuscador("abierto",$ruta->id)->get();
        $vuelos2= $vuelo->FillBuscador("ejecutado",$ruta->id)->get();
        $vuelos3= $vuelo->FillBuscador("cancelado",$ruta->id)->get();
        $vuelos4= $vuelo->FillBuscador("retrasado",$ruta->id)->get();
      $ruta2= array('ruta' => $Sorigen->nombre." --> ".$Sdestino->nombre, 'origen_id' => $Sorigen->id, 'destino_id' => $Sdestino->id  );
      return view('gerente-sucursales.ajax.vuelos-ajax')
        ->with('abiertos',$vuelos1)
        ->with('ejecutados',$vuelos2)
        ->with('cancelados',$vuelos3)
        ->with('retrasados',$vuelos4)
        ->with('ruta',$ruta2);
    }

    public function rutas(Request $datos){
      $rutas;
      if(isset($datos->origen)){
        $rutas=$this->rutasO($datos->origen);
      }
      else{
        if(isset($datos->destino)){
          $rutas=$this->rutasD($datos->destino);
        }
        else{
          //$rutas= Ruta::orderBy('id')->paginate(15);
          $rutas= Ruta::orderBy('id')->get();
        }
      }
      $sucursales= Sucursal::orderBy('nombre','ASC')->get();
      return view('gerente-sucursales.administracion-rutas')->with('rutas',$rutas)->with('sucursales',$sucursales);

    }
    public function rutasO($id){
      $sucursal=Sucursal::find($id);
      $destinos= $sucursal->destinos()->get();
     // $destinos= $sucursal->destinos()->paginate(15);
      return $destinos;
    }
    public function rutasD($id){
      $sucursal=Sucursal::find($id);
      $origenes= $sucursal->origenes()->get();
     // $origenes= $sucursal->origenes()->paginate(15);
      return $origenes;
    }

    public function rutasAjax($id){
      $ruta=Ruta::find($id);
      $sucursales= Sucursal::orderBy('nombre','ASC')->get();
      return view('gerente-sucursales.ajax.modificar-ruta-ajax')->with('ruta',$ruta)->with('sucursales',$sucursales);
    }

    public function destinos($id){
    	$sucursal = Sucursal::find($id);
    	$destinos=$sucursal->destinos;
    	return view('gerente-sucursales.ajax.destinos-ajax')->with('destinos',$destinos);
    }

    public function vuelo($id){
        $vuelo= Vuelo::find($id);
        $boletos=['Pagados','Reservados','Chequeado','Cancelados'];

        $estado[0]="Reservado";
        $boletos['Reservados']= $vuelo->Disponibilidad($estado,$id);

        $estado[0]="Chequeado";
        $boletos['Chequeados']= $vuelo->Disponibilidad($estado,$id);

        $estado[0]="Cancelado";
        $boletos['Cancelados']= $vuelo->Disponibilidad($estado,$id);

        $estado=[0 => "Pagado"];
        $boletos['Pagados']= $vuelo->Disponibilidad($estado,$id);

        $boletos['Pagados']=$boletos['Pagados']+$boletos['Chequeados'];//En caso que el vuelo este en periodo de chequeo o ya fue ejecutado los boletos en estado chequeado se cuentan como pagados igualmente

        $vuelo->tripulantes();
        $he= array();
        $actual=Carbon::now();
        foreach($vuelo->tripulantes as $tripulante){
          array_push($he, $tripulante->HorasExperiencia($tripulante->id,$actual->toDateTimeString())[0]);
          
        }
        return view('gerente-sucursales.ajax.ver-vuelo-ajax')
                ->with('boletos',$boletos)
                ->with('vuelo',$vuelo)
                ->with('he',$he); 
    }

    public function CancelarVuelo(Request $request){
      $vuelo = new Vuelo();
      $boleto =new Boleto();
      $boleto->Actualizar('Cancelado',$request->vuelo_id);
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
            flash::error('No se permiten vuelos en este horario. Seleccione un horario para antes de las 06:00 pm');
            return view('taquillero.ajax.info-error');
      }
      else{
        if(!($salidaCarbon->gt($actual))){ //si la salida no es despues de la fecha actual
            flash::error('Fecha inválida');
            return view('taquillero.ajax.info-error');
        }
        else{
            if(($hora<8)&&($origen!=$central->id)){
                flash::error('No se pemiten vuelos en este horario. Seleccione un horario a partir de las 08:00 am');
                return view('taquillero.ajax.info-error');
        }
        else{
            if($hora<6){
                flash::error('No se pemiten vuelos en este horario. Seleccione un horario a partir de las 06:00 am');
                return view('taquillero.ajax.info-error');
            }
            else{

              $personal= new Tripulante();
              $aeronave= new Aeronave();
              $horaA=$hora-4;
              $horaD=$hora+4;
              $antes=$year.'-'.$mes.'-'.$dia.' '.$horaA.':'.$minuto.':00';
              $despues=$year.'-'.$mes.'-'.$dia.' '.$horaD.':'.$minuto.':00';


              //DATOS PARA CALCULAR HORAS PLANIFICADAS DEL PERSONAL PARA LA QUICENA
              //Y LAS HORAS DE VUELO DE EXPERIENCIA
              //
              $actual2=Carbon::now();
              $mes2=DATE("m",strtotime($salidaCarbon->toDateTimeString()));
              $year2=DATE("Y",strtotime($salidaCarbon->toDateTimeString()));
              $fechaincio=DATE("d",strtotime($salidaCarbon->toDateTimeString()));
              if($fechaincio<15){ //dia de partida para calcular las horas de vuelos planificadas en la quicena
                $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                $fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
              }
              else{
                $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                $fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
              }


              $pilotos=$personal->Disponibilidad("Piloto",$antes,$despues);
              $pihe= array(); //HORAS DE EXPERIENCIA DEL PILOTO
              $pihp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
              foreach ($pilotos as $piloto) {
                array_push($pihe, $personal->HorasExperiencia($piloto->id,$actual2->toDateTimeString())[0]);
                array_push($pihp, $personal->VuelosPlanificadas($piloto->id,$fechaincio,$fechafin)[0]);
              }

              $copilotos=$personal->Disponibilidad("Copiloto",$antes,$despues);
              $copihe= array(); //HORAS DE EXPERIENCIA DEL COPILOTO
              $copihp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
              foreach ($copilotos as $copiloto) {
                array_push($copihe, $personal->HorasExperiencia($copiloto->id,$actual2->toDateTimeString())[0]);
                array_push($copihp, $personal->VuelosPlanificadas($copiloto->id,$fechaincio,$fechafin)[0]);
              }

              $sobrecargos=$personal->Disponibilidad("Sobrecargo",$antes,$despues);
              $sohe= array(); //HORAS DE EXPERIENCIA DEL SOBRECARGO
              $sohp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
              foreach ($sobrecargos as $sobrecargo) {
                array_push($sohe, $personal->HorasExperiencia($sobrecargo->id,$actual2->toDateTimeString())[0]);
                array_push($sohp, $personal->VuelosPlanificadas($sobrecargo->id,$fechaincio,$fechafin)[0]);
              }

              $jefacs=$personal->Disponibilidad("Jefe de Cabina",$antes,$despues);
              $jche= array(); //HORAS DE EXPERIENCIA DEL JEFA DE CABINA
              $jchp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
              foreach ($jefacs as $jefac) {
                array_push($jche, $personal->HorasExperiencia($jefac->id,$actual2->toDateTimeString())[0]);
                array_push($jchp, $personal->VuelosPlanificadas($jefac->id,$fechaincio,$fechafin)[0]);
              }


              $aeronaves=$aeronave->Disponibilidad($antes,$despues);
              $aehm= array(); //HORAS DE VUELOS DESPUES DEL MANTENIMIENTO DE LA AERONAVE
              foreach ($aeronaves as $aeronaveF) {
                array_push($aehm, $aeronave->HorasPostMantenimiento($aeronaveF->id)[0]);
              }
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
                        ->with('tercero', $tercero)
                        ->with('pihe',$pihe)
                        ->with('pihp',$pihp)
                        ->with('copihe',$copihe)
                        ->with('copihp',$copihp)
                        ->with('sohe',$sohe)
                        ->with('sohp',$sohp)
                        ->with('jche',$jche)
                        ->with('jchp',$jchp)
                        ->with('aehm',$aehm);           
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
                        ->with('segundo', $segundo)
                        ->with('pihe',$pihe)
                        ->with('pihp',$pihp)
                        ->with('copihe',$copihe)
                        ->with('copihp',$copihp)
                        ->with('sohe',$sohe)
                        ->with('sohp',$sohp)
                        ->with('jche',$jche)
                        ->with('jchp',$jchp)
                        ->with('aehm',$aehm);             

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
                        ->with('segundo', $segundo)
                        ->with('pihe',$pihe)
                        ->with('pihp',$pihp)
                        ->with('copihe',$copihe)
                        ->with('copihp',$copihp)
                        ->with('sohe',$sohe)
                        ->with('sohp',$sohp)
                        ->with('jche',$jche)
                        ->with('jchp',$jchp)
                        ->with('aehm',$aehm);               
                  }
                }
              }
            }
          }
}
    } 
  }

  public function PlanificarVuelo(Request $datos){
    $piloto= Tripulante::find($datos->piloto);
    $copiloto= Tripulante::find($datos->copiloto);
    $jefac= Tripulante::find($datos->jefac);
    $sobrecargo1= Tripulante::find($datos->sobrecargos[0]);
    $sobrecargo2= Tripulante::find($datos->sobrecargos[1]);
    $sobrecargo3= Tripulante::find($datos->sobrecargos[2]);
    for($i=0 ; $i<(sizeof($datos->hora)) ; $i++) {
      $vuelo = new Vuelo();
      $vuelo->estado= "abierto";
      $vuelo->salida=$datos->fechaSalida." ".$datos->hora[$i];
      $vuelo->save();

      $pierna = new Pierna();
      $pierna->aeronave_id=$datos->aeronave;
      $pierna->vuelo_id=$vuelo->id;
      $pierna->ruta_id=$datos->ruta[$i];
      $pierna->save();

      $piloto->vuelos()->attach($vuelo->id);
      $copiloto->vuelos()->attach($vuelo->id);
      $jefac->vuelos()->attach($vuelo->id);
      $sobrecargo1->vuelos()->attach($vuelo->id);
      $sobrecargo2->vuelos()->attach($vuelo->id);
      $sobrecargo3->vuelos()->attach($vuelo->id);

      /*$vuelo->Tripulante()->sync($piloto);
      $vuelo->Tripulante()->sync($copiloto);
      $vuelo->Tripulante()->sync($jefac);
      $vuelo->Tripulante()->sync($sobrecargo1);
      $vuelo->Tripulante()->sync($sobrecargo2);
      $vuelo->Tripulante()->sync($sobrecargo3);*/
      
    }
        flash::success('El vuelo ha sido planificado');
      return redirect('/gerente-sucursales');

  }
  public function NuevaRuta(Request $datos){
    $nueva= new Ruta();
    $origen=Sucursal::find($datos->origenid);
    $destino=Sucursal::find($datos->destinoid);
    if(sizeof($nueva->Buscador($datos->origenid,$datos->destinoid)->first())){
      flash::error('La Ruta '.$origen->nombre." ---> ".$destino->nombre." Ya Existe");
      return redirect('/gerente-sucursales/administracion-rutas');
    }
    else{
      if(sizeof($nueva->RutaInactiva($datos->origenid,$datos->destinoid)->first())){
          $nueva=RutaInactiva($datos->origenid,$datos->destinoid)->first();
      }
      $nueva->origen_id=$datos->origenid;
      $nueva->destino_id=$datos->destinoid;
      $nueva->distancia=$datos->distancia;
      $nueva->duracion=$datos->horas.":".$datos->minutos.":00";
      $nueva->tarifa_vuelo=$datos->precio;
      $nueva->siglas=$origen->siglas."-".$destino->siglas;
      $nueva->estado="activa";
      $nueva->save();
      flash::success('La Ruta '.$origen->nombre." ---> ".$destino->nombre." Fue Registrado Correctamente");
      return redirect('/gerente-sucursales/administracion-rutas');
    }
  }

  public function EliminarRuta(Request $datos){
    $ruta =Ruta::find($datos->ruta_id);
    $ruta->estado="inactiva";
    $ruta->save();
    flash::info('La Ruta '.$ruta->origen->nombre." ---> ".$ruta->destino->nombre." ha sido inhabilitada");
    return redirect('/gerente-sucursales/administracion-rutas');

  }

  public function habilitarRuta(Request $datos){
    $ruta =Ruta::find($datos->ruta_idH);
    $ruta->estado="activa";
    $ruta->save();
    flash::info('La Ruta '.$ruta->origen->nombre." ---> ".$ruta->destino->nombre." ha sido habilitada");
    return redirect('/gerente-sucursales/administracion-rutas');

  }

  public function ModificarRuta(Request $datos){
      $ruta= Ruta::find($datos->ruta_id);
      $ruta->distancia=$datos->distancia;
      $ruta->duracion=$datos->duracion;
      $ruta->tarifa_vuelo=$datos->precio;    
      if(($ruta->origen->id!=$datos->origenid)||($ruta->destino->id!=$datos->destinoid)){
          $origen=Sucursal::find($datos->origenid);
          $destino=Sucursal::find($datos->destinoid);
          if(sizeof($ruta->Buscador($datos->origenid,$datos->destinoid)->first())){
            flash::error('La Ruta '.$origen->nombre." ---> ".$destino->nombre." Ya Existe");
            return redirect('/gerente-sucursales/administracion-rutas');
          }
          else{
            $ruta->origen_id=$datos->origenid;
            $ruta->destino_id=$datos->destinoid;
            $ruta->siglas=$origen->siglas."-".$destino->siglas;
          }
          $ruta->save();
          flash::success('La Ruta '.$origen->nombre." ---> ".$destino->nombre." Fue Registrado Correctamente");
          return redirect('/gerente-sucursales/administracion-rutas');
      }
      else{
        $ruta->save();
        flash::success('La Ruta '.$ruta->origen->nombre." ---> ".$ruta->destino->nombre." Fue Actualizada Correctamente");
        return redirect('/gerente-sucursales/administracion-rutas');
      }

  }

  public function modeloAeronave($modelo){
    return Aeronave::ModelosA($modelo)->get();
  }

  public function estadoAeronave($estado){
    return Aeronave::EstadosA($estado)->get();
  }

  public function aeronaves(Request $datos){

      $aeronaves;
      if(isset($datos->modelo)){
        $aeronaves=$this->modeloAeronave($datos->modelo);
      }
      else{
        if(isset($datos->estado)){
          $aeronaves=$this->estadoAeronave($datos->estado);
        }
        else{
          $aeronaves= Aeronave::orderBy('id')->get();
        }
      }
      $actual = Carbon::now();
      $aehm= array(); //HORAS DE VUELOS DESPUES DEL MANTENIMIENTO A LA FECHA ACTUAL
      $aehp= array(); //HORAS DE VUELOS PLANIFICADAS DESPUES DE LA FECHA ACTUAL
      foreach ($aeronaves as $aeronaveF) {
        array_push($aehm, Aeronave::HorasUso($aeronaveF->id,$actual->toDateTimeString())[0]);
        array_push($aehp, Aeronave::HorasPlanificadas($aeronaveF->id,$actual->toDateTimeString())[0]);
      }
      $modelos=Aeronave::Modelos()->get();
      $estados=Aeronave::Estados()->get();
      return view('gerente-sucursales.administracion-aeronaves')
                  ->with('aeronaves',$aeronaves)
                  ->with('aehm',$aehm)
                  ->with('aehp',$aehp)
                  ->with('modelos',$modelos)
                  ->with('estados',$estados);
  }

public function NuevaAeronave(Request $datos){
    $nueva= new Aeronave();
    if(sizeof($nueva->Buscador($datos->matricula)->first())){
      flash::error('La Matricula ya existe registrada para otra Aeronave');
      return redirect('/gerente-sucursales/administracion-rutas');
    }
    else{
      $nueva->matricula=$datos->matricula;
      $nueva->capacidad=$datos->capacidad;
      $nueva->modelo=$datos->modelo;
      $nueva->estado=$datos->estado;
      $nueva->save();
      flash::success('La Aeronave '.$nueva->matricula." Fue Registrado Correctamente");
      return redirect('/gerente-sucursales/administracion-aeronaves');
    }
  }

public function Eliminaraeronave(Request $datos){
    $aeronave = Aeronave::find($datos->aeronave_id);
    $aeronave->delete();
    flash::info('La aeronave '.$aeronave->matricula." Fue Eliminada Correctamente");
    return redirect('/gerente-sucursales/administracion-aeronaves');

  }

   public function AeronavesAjax($id){
      $aeronave=Aeronave::find($id);
      $sucursales= Sucursal::orderBy('nombre','ASC')->get();
      return view('gerente-sucursales.ajax.modificar-aeronave-ajax')->with('aeronave',$aeronave);
    }

  public function ModificarAeronave(Request $datos){
      $aeronave= Aeronave::find($datos->aeronave_id);
      $aeronave->matricula=$datos->matricula;
      $aeronave->capacidad=$datos->capacidad;
      $aeronave->modelo=$datos->modelo;    
      $aeronave->estado=$datos->estado;  
      if($datos->estado=='mantenimiento'){
        $aeronave->ultimo_mantenimiento=date('Y-m-d');
      }  
      $aeronave->save();
      flash::success('La aeronave '.$aeronave->matricula." Fue Actualizada Correctamente");
      return redirect('/gerente-sucursales/administracion-aeronaves');

  }
}