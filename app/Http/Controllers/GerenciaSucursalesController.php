<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sucursal;
use Szykra\Notifications\Flash;
use App\Ruta;
use App\Vuelo;
use App\Aeronave;
use App\Personal_operativo;
use Carbon\Carbon;

class GerenciaSucursalesController extends Controller
{
    public function __construct(){
      Carbon::setLocale('es');
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
   		$ruta2=$Sorigen->nombre." --> ".$Sdestino->nombre;
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

    public function consultarDisponibilidad($salida){
      $year=DATE("Y",strtotime($salida));
      $mes=DATE("m",strtotime($salida));
      $dia=DATE("d",strtotime($salida));
      $minuto=DATE("i",strtotime($salida)); //minutos
      $hora=DATE("H",strtotime($salida));//hora en formato 24hras
      $personal= new Personal_operativo();
      $aeronave= new Aeronave();
      if($hora<19){
        $horaA=$hora-2;
        $horaD=$hora+2;
        $antes=$year.'-'.$mes.'-'.$dia.' '.$horaA.':'.$minuto.':00';
        $despues=$year.'-'.$mes.'-'.$dia.' '.$horaD.':'.$minuto.':00';
        $pilotos=$personal->Disponibilidad("Piloto",$antes,$despues);
        $copilotos=$personal->Disponibilidad("Copiloto",$antes,$despues);
        $sobrecargos=$personal->Disponibilidad("Sobrecargo",$antes,$despues);
        $jefacs=$personal->Disponibilidad("Jefa de Cabina",$antes,$despues);
        $aeronaves=$aeronave->Disponibilidad($antes,$despues);
        return view('gerente-sucursales.ajax.programar-vuelo-ajax')
                ->with('pilotos',$pilotos)
                ->with('copilotos',$copilotos)
                ->with('jefacs',$jefacs)
                ->with('sobrecargos',$sobrecargos); 
      }
      else{
        flash::error('No es permitido programar un vuelo a esta hora');
            return view('gerente-sucursales.ajax.info-error');
      }
    }

}
