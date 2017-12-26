<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Boleto;
use App\Pasajero;
use App\Vuelo;
use App\Pierna;
use App\Sucursal;
use App\Ruta;
use App\Equipaje;
use App\User;
use App\Administrativo;
use App\Http\Requests\confirmarRequest;
use Auth;
use Szykra\Notifications\Flash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class TaquillaController extends Controller
{
    public function __construct(){
      Carbon::setLocale('es');
      date_default_timezone_set('America/Caracas');
    }
    public function index(){
        //tomo el id del administrativo que esta haciendo uso del sistema
        $id_adminitrativo=Auth::user()->administrativo_id;
        //tomo el id de la sucursal a la cual trabaja
        $id= Administrativo::find($id_adminitrativo)->sucursal_id;
        //tomo los datos de la sucursal
        $sucursal= Sucursal::find($id);
        $vuelos= new Vuelo();
        //busco todos los destinos programados de la fecha actual en adelante
        $actual = Carbon::now();
        $datos=$vuelos->Destinos($id,$actual->toDateTimeString());
        //retorno a la vista con los datos
        //$id_adminitrativo=Auth::user()->administrativo_id;
        $boleto= new Boleto();
        $boleto->EliminarRegistroTemporal($sucursal->id);
        return view('taquillero.index')->with('vuelos', $datos)->with('sucursal', $sucursal);
        
        /* destino fecha disponibilidad precio y estatus*/
    }
    
    public function Accion(Request $datos, $accion){
        $boleto=Boleto::find($datos->boleto_id);
        $pasajeroAux=Pasajero::BuscarCI($datos->nacionalidad.$datos->cedula)->first();
        if(sizeOf($pasajeroAux)){ //si el pasajero esta registrado
            $pasajero=$pasajeroAux;
            $this->ActualizarDatosPasajero($datos,$pasajero);

        }
        else{ //si el pasajero no esta registrado
            $pasajero=$this->RegistrarPasajero($datos);
        }
       // dd($pasajero);
        switch ($accion) {
            case 'Pagar'://vender boleto
                            $consulta=$boleto->Buscar($boleto->vuelo_id,$pasajero->id,"Reservado")->first();
                            if(sizeOf($consulta)){
                                $datos->boleto_id=$consulta->id;
                            }
                            $this->CambiarEstado($datos->boleto_id,$pasajero,"Pagado");

                            flash::success('El boleto '.$datos->boleto_id.' ha sido pagado');

                            // ---  Imprimir Boleto
                            //Recuperar toda la informacion
                           /* return $this->getdata(
                                $pasajero->nombres." ".$pasajero->apellidos,
                                $boleto->asiento,
                                Carbon::parse($boleto->vuelo->salida)->format('h:i'),
                                Carbon::parse($boleto->vuelo->salida)->format('d/m'),
                                $boleto->vuelo->pierna->ruta->origen->nombre,
                                $boleto->vuelo->pierna->ruta->destino->nombre,
                                $boleto->vuelo->pierna->ruta->origen->siglas,
                                $boleto->vuelo->pierna->ruta->destino->siglas,
                                $boleto->id,
                                Carbon::parse($boleto->vuelo->salida)->format('h:i'),
                                $boleto->vuelo->pierna->ruta->siglas
                                

                            );*/
                break;

            case 'Reservar'://Reservar boleto
                $actual = Carbon::now();
                $salidaCarbon = Carbon::parse($boleto->vuelo->salida);
                $salidaCarbon->subDay();
                if($actual->gt($salidaCarbon)){
                    flash::error('El tiempo para reservar un boleto para este vuelo a expirado');
                    return redirect('/taquilla');
                }
                else{
                    $this->CambiarEstado($datos->boleto_id,$pasajero,"Reservado");
                    flash::success('El boleto '.$datos->boleto_id.' ha sido reservado');
                }
                break;

            case 'Renovar'://Reutilizar un boleto pagado y luego cancelado
                $consulta=$boleto->Buscar($boleto->vuelo_id,$pasajero->id,"Cancelado")->first();
                if(sizeOf($consulta)){
                    $this->EliminarBoleto($consulta->id);
                }
                $this->CambiarEstado($datos->boleto_id,$pasajero,"Pagado");
                flash::success('El boleto ha sido renovado');
                break;

            case 'Cancelar'://Cancelar boleto pagado
                $consulta=$boleto->Buscar($boleto->vuelo_id,$pasajero->id,"Pagado")->first();
                if(sizeOf($consulta)){
                    $datos->boleto_id=$consulta->id;
                }
                $this->CambiarEstado($datos->boleto_id,$pasajero,"Cancelado");
                flash::success('El boleto '.$datos->boleto_id.' ha sido cancelado posee un lapso de un año para renovarlo');//busco el boleto que esta pagado
                break;

            case 'Liberar'://Cancelar Reservación
                $consulta=$boleto->Buscar($boleto->vuelo_id,$pasajero->id,"Reservado")->first();
                if(sizeOf($consulta)){
                    $datos->boleto_id=$consulta->id;
                }
                $this->EliminarBoleto($datos->boleto_id);
                flash::success('La reservación '.$datos->boleto_id.' ha sido cancelada');
                break;
            
            default:
                # code...
                break;
        }
        if($datos->boleto_id2==0)//si es una sola pierna
        {
            $id_adminitrativo=Auth::user()->administrativo_id;
            $sucursal_id= Administrativo::find($id_adminitrativo)->sucursal_id;
            $boleto->EliminarRegistroTemporal($sucursal_id);
            return redirect('/taquilla');
        }
        else{
            $datos->boleto_id=$datos->boleto_id2;
            $datos->boleto_id2=0;
            $this->Accion($datos,$accion);
            $id_adminitrativo=Auth::user()->administrativo_id;
            $sucursal_id= Administrativo::find($id_adminitrativo)->sucursal_id;
            $boleto->EliminarRegistroTemporal($sucursal_id); 
            return redirect('/taquilla');

        }            
    }

    public function EliminarBoleto($id){
        $boleto=Boleto::find($id);
        $boleto->delete();
    }
    public function ActualizarDatosPasajero(Request $request,Pasajero $pasajero){
        $pasajero->cedula=$request->nacionalidad.$request->cedula;
        $pasajero->nombres=$request->nombres;
        $pasajero->apellidos=$request->apellidos;
        $pasajero->direccion=$request->direccion;
        $pasajero->tlf_movil=$request->tlf_movil;
        $pasajero->tlf_casa=$request->tlf_casa;
        $pasajero->save();
    }
    public function RegistrarPasajero(Request $request){
        //ESTE MÉTODO ESTA CONECTADO CON EL METODO ACCIÖN 
    	$pasajero = new Pasajero();
    	$pasajero->cedula=$request->nacionalidad.$request->cedula;
    	$pasajero->nombres=$request->nombres;
    	$pasajero->apellidos=$request->apellidos;
    	$pasajero->direccion=$request->direccion;
    	$pasajero->tlf_movil=$request->tlf_movil;
    	$pasajero->tlf_casa=$request->tlf_casa;
    	$pasajero->save();
    	return $pasajero;
    }
    public function CambiarEstado($id, $pasajero, $estado){
        $boleto = Boleto::find($id);
        $boleto->pasajero_id=$pasajero->id;
        $boleto->estado=$estado;
        $boleto->save();
    }
    public function ContenidoChequear(){
        $id_adminitrativo=Auth::user()->administrativo_id;
        $sucursal_id= Administrativo::find($id_adminitrativo)->sucursal_id;
        $sucursal=Sucursal::find($sucursal_id);
        $actual = Carbon::now();
        $vuelos=Vuelo::Sucursal($sucursal_id,"abierto");
        foreach ($vuelos as $key => $vuelo) {
            $inicio = Carbon::parse($vuelo->salida);
            $fin = Carbon::parse($vuelo->salida);
            $inicio->subHours(2); //inicio
            $fin->subHours(1); //inicio

            if(!(($actual->gt($inicio))&&($actual->lt($fin)))){
                //si la fecha y hora actual no es despues del inicio del chequeo 
                //y no es antes del final del chequeo del vuelo
                unset($vuelos[$key]);
                
            }

        }
        return view('taquillero/confirmacionBoleto')->with('vuelos',$vuelos)->with('sucursal',$sucursal);
    }
    public function ChequearBoletoAjax($ci,$vuelo_id){
        $vuelo= Vuelo::find($vuelo_id);
        $ruta = array('origen' => Sucursal::find($vuelo->pierna->ruta->origen_id)->nombre, 'destino' => Sucursal::find($vuelo->pierna->ruta->destino_id)->nombre );
        $pasajero = Pasajero::BuscarCI($ci)->first();
        if(is_null($pasajero)){
             flash::error('Este pasajero no se encuentra registrado');
            return view('taquillero.ajax.info-error');
        }
        else{
            $boleto = Boleto::BuscarP($vuelo_id,$pasajero->id)->first();
            if(sizeof($boleto)!=0){
                if($boleto->estado=="Pagado"){
                    $boleto = Boleto::Buscar($vuelo->id,$pasajero->id,"Pagado")->first();
                    return view('taquillero.ajax.chequear-boleto-ajax')
                        ->with('boleto',$boleto)
                        ->with('pasajero',$pasajero)
                        ->with('ruta',$ruta)
                        ->with('vuelo',$vuelo);
                }
                else{
                    switch ($boleto->estado) {
                        case 'Reservado':
                            flash::error('El boleto del pasajero no se encuentra pagado');
                            return view('taquillero.ajax.info-error');
                            break;
                        case 'Chequeado':
                            flash::info('El boleto del pasajero ya se encuentra chequeado');
                            return view('taquillero.ajax.info-error');
                            break;
                        case 'Cancelado':
                            flash::error('El boleto del pasajero fue cancelado');
                            return view('taquillero.ajax.info-error');
                            break;
                        default:
                            flash::error('Error inesperado. Estado '.$boleto->estado." indefinido en este módulo del sistema");
                            return view('taquillero.ajax.info-error');
                            break;
                    }
                }
            }
            else{
                 flash::error('Este pasajero no posee boletos para el vuelo señalado');
                return view('taquillero.ajax.info-error');
            }
        }
        
    }
    public function ChequearBoleto(Request $request){ //chequiar boleto
        $boleto = Boleto::find($request->boleto_id);
        $boleto->estado='Chequeado';
        $boleto->save();
        if($request->cantidad!=0){
            $equipaje= new Equipaje();
            $equipaje->peso=$request['peso-equipaje'];
            $equipaje->boleto_id=$request->boleto_id;
            $equipaje->costo_sobrepeso=$request->costo;
            $equipaje->cantidad=$request['cantidad-equipaje'];
            $equipaje->save();
        }
        flash::success('El boleto ha sido chequeado exitosamente');
        return redirect('/taquilla/confirmar-boleto');
    }
    public function fechasDisponibles($fechas){
        $cont=0;
        foreach ($fechas as $fecha) {
            $vuelo=Vuelo::find($fecha->id);
            $ocupados=$this->ConsultarDisponibilidad($vuelo);
            if($ocupados>=$vuelo->pierna->aeronave->capacidad){
                $cont=$cont+1;
            }

       }
       return $cont;
    }
    public function ajaxVuelo($origen,$destino){
        $vuelo= new Vuelo();
        $actual = Carbon::now();
        $fechas= $vuelo->Horarios($origen,$destino,$actual->toDateTimeString());
        $cont=$this->fechasDisponibles($fechas);
       if((sizeof($fechas))!=$cont){
            $id_adminitrativo=Auth::user()->administrativo_id;
            $sucursal_id= Administrativo::find($id_adminitrativo)->sucursal_id;
            if($origen==$sucursal_id){
                return view('taquillero.ajax.info-vuelo-ajax')->with('fechas',$fechas);
            }
            else{//si es el ajaxVuelo de la segunda pierna
                return view('taquillero.ajax.info-vuelo2-ajax')->with('fechas2',$fechas);
            }
        }
        else{
            flash::error('No hay disponibilidad de boletos');
            return view('taquillero.ajax.info-error');
        }
    }

    public function ConsultarDisponibilidad($vuelo){
        //creo un array con los estados de boletos que disminuyen la disponibilidad
        //$estados=["Reservado","Pagado","Temporal"];
        $estados=["Reservado","Pagado"];
       //consulto cuantos boletos estan comprados
        $ocupados=$vuelo->Disponibilidad($estados,$vuelo->id);
        $ocupados=$ocupados+8;//le sumo los asientos reservados para 3era edad, discapasitados y de menore sin acompañantes
        return $ocupados;
    }

    public function ajaxVueloDisp($id,$nro){
        //busco datos del vuelo a cosultar disponibilidad
        $vuelo= Vuelo::find($id);
        $ocupados=$this->ConsultarDisponibilidad($vuelo);
        //si hay disponibilidad
        if($ocupados<$vuelo->pierna->aeronave->capacidad)
        {
            $fechas;
            $costo=$vuelo->pierna->ruta->tarifa_vuelo;
            $boleto=new Boleto();
            $boleto->Generar($ocupados,$vuelo->id,$costo);
            //Verificar si es la seguda pierna
            if($nro==0){
                //Datos para una posible segunda pierna
                $destino=Sucursal::find($vuelo->pierna->ruta->destino_id);
                $origen=Sucursal::find($vuelo->pierna->ruta->origen_id);
                $vuelos2= new Vuelo();
                $actual = Carbon::now();
                $datos=$vuelos2->Destinos($destino->id,$actual->toDateTimeString());
                if(sizeof($datos)==0){
                    flash::info('No hay destinos disponible');
                }
                else{
                    $fechas= $vuelo->Horarios($destino->id,$origen->id,$vuelo->salida);
                    $cont=$this->fechasDisponibles($fechas);
                    if((sizeof($fechas))==$cont){
                        flash::info('No hay fechas disponibles para retorno');
                    }

                }
                    
                return view('taquillero.ajax.info-disponibilidad-ajax')->with('boleto',$boleto)->with('vuelos2', $datos)->with('sucursal', $origen)->with('sucursal2', $destino)->with('fechas',$fechas);    
            }
            else{//si es un segundo viaje
                $origen= Vuelo::find($nro);
                $costoT=$origen->pierna->ruta->tarifa_vuelo+$costo;//calculo el costo total de las 2 piernas
                return view('taquillero.ajax.info-disponibilidad2-ajax')->with('boleto',$boleto)->with('costoT',$costoT); 
            }
            
        }
        else{//si no hay disponibilidad
            flash::error('No hay disponibilidad de boletos');
            return view('taquillero.ajax.info-error');
        }
    }

    public function ajaxVueloPasajero($idboleto,$nacionalidad,$id,$auxB){
        $cedula=$nacionalidad.$id;
        $boleto= Boleto::find($idboleto);
        $pasajeroAux=Pasajero::BuscarCI($cedula)->first();
        if(sizeOf($pasajeroAux)){
            $pasajero=$pasajeroAux;
            $consulta=$boleto->BuscarP($boleto->vuelo_id,$pasajero->id)->first();
            
            if((sizeOf($consulta))==0){
                    if($auxB==0)//si es un vuelo de una sola pierna
                    {
                        return view('taquillero.ajax.info-vuelo-pasajero-ajax')
                            ->with('pasajero',$pasajero)
                            ->with('boleto_id',$boleto->id)
                            ->with('boleto_id2','0')
                            ->with('costo',$boleto->costo);
                    }
                    else{
                        $boleto2= Boleto::find($auxB);
                        return view('taquillero.ajax.info-vuelo-pasajero-ajax')
                            ->with('pasajero',$pasajero)
                            ->with('boleto_id',$boleto->id)
                            ->with('boleto_id2',$auxB)
                            ->with('costo',($boleto->costo+$boleto2->costo));
                    }
            }
            else{
                $pendiente=$boleto->Pendiente($pasajero->id);

                if(sizeOf($pendiente)!=0){
                    if(sizeOf($pendiente)==2){ //el sistema le permite a un pasajero solo tener hasta dos boletos cancelados en caso que fuera sido un vuelo de 2 piernas
                     $pendiente[0]->costo=$pendiente[0]->costo+$pendiente[1]->costo;   
                    }

                    if($boleto->costo>$pendiente[0]->costo){
                        $costo=$boleto->costo-$pendiente[0]->costo;
                    }
                    else{
                        $costo=0;
                    }

                    flash::info('Este pasajero posee un boleto pendiente de '.$pendiente[0]->costo);
                    return view('taquillero.ajax.info-vuelo-pasajero-ajax')
                    ->with('pasajero',$pasajero)
                    ->with('boleto_id',$boleto->id)
                    ->with('estado','Cancelado')
                    ->with('boleto_id2',$auxB)
                    ->with('pendiente',$pendiente[0])
                    ->with('costo',$costo);

                }
                if($auxB!=0)//si es un vuelo de una sola pierna
                {
                    $boleto2= Boleto::find($auxB);
                    $auxcosto=$boleto->costo+$boleto2->costo;
                }
                else{
                    $auxcosto=$boleto->costo;
                }
                switch ($consulta->estado) {
                    case 'Reservado':

                        flash::info('Este pasajero posee un boleto reservado para este vuelo');
                        break;
                    case 'Pagado':

                        flash::error('Este pasajero ya posee un boleto para este vuelo');
                        break;
                }
                return view('taquillero.ajax.info-vuelo-pasajero-ajax')
                ->with('pasajero',$pasajero)
                ->with('boleto_id2',$auxB)
                ->with('boleto_id',$boleto->id)
                ->with('estado',$consulta->estado)
                ->with('costo',$auxcosto);
            }
        }
        else{
            if($auxB!=0)//si es un vuelo de una sola pierna
            {
                $boleto2= Boleto::find($auxB);
                $auxcosto=$boleto->costo+$boleto2->costo;
            }
            else{
                $auxcosto=$boleto->costo;
            }
            return view('taquillero.ajax.info-vuelo-pasajero-ajax')
                ->with('boleto_id',$boleto->id)
                ->with('boleto_id2',$auxB)
                ->with('costo',$auxcosto);
        }
    }

    public function generarpdf($data){
        
        $view =  \View::make('pdf.invoice', compact('data'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //return $pdf->stream('invoice');   
        return $pdf->download('invoice');
    }

    public function getdata(
        $nombrecompleto, $asiento, $hora,$fecha, $origen, $destino,$origenmin,$destinomin, $boletonro,$embarquehasta, $idvuelo)
    {
        $data =  [
            'nombreapellido'            => $nombrecompleto,
            'hora'                      => $hora,
            'fecha'                     => $fecha, 
            'asiento'                   => $asiento,
            'origen'                    => $origen,
            'destino'                   => $destino,
            'origen_min'                => $origenmin,
            'destino_min'               => $destinomin,
            'boletonro'                 => $boletonro,
            'embarquehasta'             => $embarquehasta,
            'idvuelo'                   => $idvuelo,


            
          

        ];
       return $this->generarpdf($data);
    }

}



/*Estados de los boletos
--Reservado=cuando esta reservado no pagado
--Pagado=cuando esta pagado
--Chequeado=cuando fue chequiado en la taquilla el dia del vuelo--
--Cancelado=cuando el boleto fue pagado y luego cancelado o el vuelo postergado
--Temporal= es cuando se genera un boleto que se esta vendiendo o reservando aunque no esta completada la venta
*/

/*
Estados de los vuelos
--abierto=cuando el gerente de sucursales lo planifica y inicia la venta
--cerrado=cuando es hora de autorización y embarquaje para iniciar la ejecución del vuelo
--cancelado=cuando por alguna dificulta inremediable el vuelo se cancela
--retrasado=cuando se pasa la hora de salida
--ejecutado=cuando el subgerente de sucursal notifica que ya la aeronave partio a su destino
 */


 //PROBLEMA LOS BOLETOS NO PODEMOS RELACIONARLO CON LA TABLA VUELO SI UN VUELO POSEE VARIAS PIERNAS PORQUE UN BOLETO ES DISTINTO POR CADA PIERNA... SOLUCIÓN O RELACIONAR EL BOLETO DIRECCTAMENTE CON PIERNA O ELIMINAR LA TABLA PIERNA O DEJAR LA TABLA PIERNA PERO COLOCAR CADA VUELO UNA PIERNA SI EL DESTINO SE REQUIERE VARIAS PIERNAS NO SE REGISTRA UN SOLO VUELO SINO IGUAL VARIOS VUELOS
        //AL BOLETO LE AGG LOS CAMPOS CODIGO ASIENTO Y COSTO TOTAL