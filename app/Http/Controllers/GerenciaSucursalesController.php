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
use App\Personal_operativo;
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
      $vuelos1= $vuelo->FillBuscador("abierto")->get();
      $vuelos2= $vuelo->FillBuscador("ejecutado")->get();
      $vuelos3= $vuelo->FillBuscador("cancelado")->get();
      $vuelo->VuelosRetrasados(date('Y-m-d H:i:s'));
      $vuelos4= $vuelo->FillBuscador("retrasado")->get();
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
        $boletos=['Pagado','Reservados'];
        $estado=[0 => "Pagado"];
        $boletos['Pagado']= $vuelo->Disponibilidad($estado,$id);
        $estado[0]="Reservados";
        $boletos['Reservados']= $vuelo->Disponibilidad($estado,$id);
        $vuelo->personal_operativo();
        return view('gerente-sucursales.ajax.ver-vuelo-ajax')
                ->with('boletos',$boletos)
                ->with('vuelo',$vuelo); 
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
            if($hora<6){
                flash::error('No se pemiten vuelos en este horario para esta ruta seleccione un horario a partir de las 6am');
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
  }

  public function PlanificarVuelo(Request $datos){
    $piloto= Personal_operativo::find($datos->piloto);
    $copiloto= Personal_operativo::find($datos->copiloto);
    $jefac= Personal_operativo::find($datos->jefac);
    $sobrecargo1= Personal_operativo::find($datos->sobrecargos[0]);
    $sobrecargo2= Personal_operativo::find($datos->sobrecargos[1]);
    $sobrecargo3= Personal_operativo::find($datos->sobrecargos[2]);
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

      /*$vuelo->personal_operativo()->sync($piloto);
      $vuelo->personal_operativo()->sync($copiloto);
      $vuelo->personal_operativo()->sync($jefac);
      $vuelo->personal_operativo()->sync($sobrecargo1);
      $vuelo->personal_operativo()->sync($sobrecargo2);
      $vuelo->personal_operativo()->sync($sobrecargo3);*/
      
    }
        flash::success('El vuelo a sido planificado');
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
      $nueva->origen_id=$datos->origenid;
      $nueva->destino_id=$datos->destinoid;
      $nueva->distancia=$datos->distancia;
      $nueva->duracion=$datos->duracion;
      $nueva->tarifa_vuelo=$datos->precio;
      $nueva->siglas=$origen->siglas."-".$destino->siglas;
      $nueva->save();
      flash::success('La Ruta '.$origen->nombre." ---> ".$destino->nombre." Fue Registrado Correctamente");
      return redirect('/gerente-sucursales/administracion-rutas');
    }
  }

  public function EliminarRuta(Request $datos){
    $ruta =Ruta::find($datos->ruta_id);
    $ruta->delete();
    flash::info('La Ruta '.$ruta->origen->nombre." ---> ".$ruta->destino->nombre." Fue Eliminada Correctamente");
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

  public function aeronaves(){
      return view('gerente-sucursales.administracion-aeronaves');
  }

}
