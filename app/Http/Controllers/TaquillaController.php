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
use Illuminate\Support\Facades\DB;


class TaquillaController extends Controller
{
    public function index(){
        //tomo el id del administrativo que esta haciendo uso del sistema
        $id_adminitrativo=Auth::user()->administrativo_id;
        //tomo el id de la sucursal a la cual trabaja
        $id= Administrativo::find($id_adminitrativo)->sucursal_id;
        //tomo los datos de la sucursal
        $sucursal= Sucursal::find($id);
        $vuelos= new Vuelo();
        //busco todos los destinos programados
        $datos=$vuelos->Destinos($id);
        //retorno a la vista con los datos
        return view('taquillero.index')->with('vuelos', $datos)->with('sucursal', $sucursal);
        
        /* destino fecha disponibilidad precio y estatus*/
    }
    
    public function Accion(Request $datos, $accion){
        $boleto=Boleto::find($datos->boleto_id);
        $pasajeroAux=Pasajero::BuscarCI($datos->nacionalidad.$datos->cedula);
        if(sizeOf($pasajeroAux)){ //si el pasajero esta registrado
            $pasajero=$pasajeroAux[0];
        }
        else{ //si el pasajero no esta registrado
            $pasajero=$this->RegistrarPasajero($datos);
        }
        switch ($accion) {
            case 'Pagar'://vender boleto
                $consulta=$boleto->Buscar($boleto->vuelo_id,$pasajero->id,"Reservado");
                if(sizeOf($consulta)){
                    $datos->boleto_id=$consulta[0]->id;
                }
                $this->CambiarEstado($datos->boleto_id,$pasajero,"Pagado");
                flash::success('El boleto ha sido pagado');
                break;

            case 'Reservar'://Reservar boleto
                $this->CambiarEstado($datos->boleto_id,$pasajero,"Reservado");
                flash::success('El boleto ha sido reservado');
                break;

            case 'Renovar'://Reutilizar un boleto pagado y luego cancelado
                $consulta=$boleto->Buscar($boleto->vuelo_id,$pasajero->id,"Cancelado");
                if(sizeOf($consulta)){
                    $this->EliminarBoleto($consulta[0]->id);
                }
                $this->CambiarEstado($datos->boleto_id,$pasajero,"Pagado");
                flash::success('El boleto ha sido renovado');
                break;

            case 'Cancelar'://Cancelar boleto pagado
                $consulta=$boleto->Buscar($boleto->vuelo_id,$pasajero->id,"Pagado");
                if(sizeOf($consulta)){
                    $datos->boleto_id=$consulta[0]->id;
                }
                $this->CambiarEstado($datos->boleto_id,$pasajero->id,"Cancelado");
                flash::success('El boleto ha sido cancelado posee un lapso de un año para renovarlo');//busco el boleto que esta pagado
                break;

            case 'Liberar'://Cancelar Reservación
                $consulta=$boleto->Buscar($boleto->vuelo_id,$pasajero->id,"Reservado");
                if(sizeOf($consulta)){
                    $datos->boleto_id=$consulta[0]->id;
                }
                $this->EliminarBoleto($datos->boleto_id);
                flash::success('La reservación ha sido cancelada');
                break;
            
            default:
                # code...
                break;
        }

        return redirect('/taquilla');
        

    }

    public function EliminarBoleto($id){
        $boleto=Boleto::find($id);
        $boleto->delete();
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
    public function ChequiarBoleto(confirmarRequest $request){ //chequiar boleto

    	$boleto = Boleto::find($request->codigo);
        if(count($boleto) == 0){
            flash::error('El Nro. del boleto ingresado nose encuentra registrado, verifique el boleto');
            return redirect('/taquilla/confirmar-boleto');

        }
        else{
            if($boleto->estado=='Confirmado'){
                $boleto->estado='Chequiado';
                //$boleto->costoEquipaje=$request->costo
                //$boleto->costo=$request->peso
                $boleto->save();
                flash::success('El boleto ha sido chequiado exitosamente');
                return redirect('/taquilla');
            }
            else{
                if($boleto->estado=='Chequiado'){
                    flash::error('El boleto ingresa ya ha sido chequiado');
                    return redirect('/taquilla');
                }
                else{
                    if($boleto->estado=='Reservado'){
                        flash::info('El boleto ingresa no esta pagado');
                        return redirect('/taquilla');
                    }
                    else{
                        if($boleto->estado=='Postergado'){
                            flash::info('El boleto ingresa ha sido postergado');
                            return redirect('/taquilla');
                        }
                        else{
                            flash::error('El vuelo de este boleto ya se ejecuto');
                            return redirect('/taquilla');
                           }
                    }
                }
            }
        }
    }

    public function ajaxVuelo($origen,$destino){
        //dd([$origen." ".$destino]);
        $vuelo= new Vuelo();
        $fechas= $vuelo->Horarios($origen,$destino);
       // dd($fechas);
        return view('partials.ajax.info-vuelo-ajax')->with('fechas',$fechas);
    }

    public function ajaxVueloDisp($id){
        //busco datos del vuelo a cosultar disponibilidad
        $vuelo= Vuelo::find($id);
        //creo un array con los estados de boletos que disminuyen la disponibilidad
        //$estados=["Reservado","Pagado","Temporal"];
        $estados=["Reservado","Pagado"];
        
        //consulto cuantos boletos estan comprados
        $ocupados=$vuelo->Disponibilidad($estados,$vuelo->id);

        $ocupados=$ocupados+8;//le sumo los asientos reservados para 3era edad, discapasitados y de menore sin acompañantes

        //consulto la capacidad de la aeronave asignada
        $capacidad=$vuelo->pierna->aeronave->capacidad;
        //si hay disponibilidad
        if($ocupados<$capacidad)
        {
            $costo=$vuelo->pierna->ruta->origen->tasa_mantenimiento+$vuelo->pierna->ruta->tarifa_vuelo+$vuelo->pierna->ruta->origen->tasa_salida;
            $boleto=new Boleto();
            $boleto->Generar($ocupados,$vuelo->id,$costo);


            $destino=Sucursal::find($vuelo->pierna->ruta->destino_id);
            $vuelos2= new Vuelo();
            $datos=$vuelos2->Destinos($destino->id);
            return view('partials.ajax.info-disponibilidad-ajax')->with('boleto',$boleto)->with('vuelos2', $datos)->with('sucursal2', $destino);
        }
        else{//si no hay disponibilidad
            flash::error('No hay disponibilidad de boletos');
            return view('partials.ajax.info-error');
        }
    }

    public function ajaxVueloPasajero($idboleto,$nacionalidad,$id){
        $cedula=$nacionalidad.$id;
        $boleto= Boleto::find($idboleto);
        $pasajeroAux=Pasajero::BuscarCI($cedula);
        if(sizeOf($pasajeroAux)){
            $pasajero=$pasajeroAux[0];
            $consulta=$boleto->BuscarP($boleto->vuelo_id,$pasajero->id);
            if((sizeOf($consulta))==0){
                $pendiente=$boleto->Pendiente($pasajero->id);

                if(sizeOf($pendiente)==0){
                    return view('partials.ajax.info-vuelo-pasajero-ajax')
                        ->with('pasajero',$pasajero)
                        ->with('boleto_id',$boleto->id)
                        ->with('costo',$boleto->costo);
                }
                else{
                    if($boleto->costo>$pendiente[0]->costo)
                    $costo=$boleto->costo-$pendiente[0]->costo;
                    else
                    $costo=0;
                flash::info('Este pasajero posee un boleto pendiente de '.$pendiente[0]->costo);
                        return view('partials.ajax.info-vuelo-pasajero-ajax')
                        ->with('pasajero',$pasajero)
                        ->with('boleto_id',$boleto->id)
                        ->with('estado','Cancelado')
                        ->with('pendiente',$pendiente[0])
                        ->with('costo',$costo);

                }
            }
            else{

                switch ($consulta[0]->estado) {
                    case 'Reservado':

            flash::info('Este pasajero posee un boleto reservado para este vuelo');
                        break;
                    case 'Pagado':

            flash::error('Este pasajero ya posee un boleto para este vuelo');
                        break;
                }
                return view('partials.ajax.info-vuelo-pasajero-ajax')
                ->with('pasajero',$pasajero)
                ->with('boleto_id',$boleto->id)
                ->with('estado',$consulta[0]->estado)
                ->with('costo',$boleto->costo);
            }
        }
        else{
            return view('partials.ajax.info-vuelo-pasajero-ajax')
                ->with('boleto_id',$boleto->id)
                ->with('costo',$boleto->costo);
        }
    }

}



/*Estados de los boletos
--Reservado=cuando esta reservado no pagado
--Pagado=cuando esta pagado
--Chequiado=cuando fue chequiado en la taquilla el dia del vuelo--
--Cancelado=cuando el boleto fue pagado y luego cancelado o el vuelo postergado
--Temporal= es cuando se genera un boleto que se esta vendiendo o reservando aunque no esta completada la venta
*/

/*
Estados de los vuelos
--abierto=cuando el gerente de sucursales lo planifica y inicia la venta
--cerrado=cuando es hora de autorización y embarquaje para iniciar la ejecución del vuelo
--cancelado=cuando por alguna dificulta inremediable el vuelo se cancela

 */


 //PROBLEMA LOS BOLETOS NO PODEMOS RELACIONARLO CON LA TABLA VUELO SI UN VUELO POSEE VARIAS PIERNAS PORQUE UN BOLETO ES DISTINTO POR CADA PIERNA... SOLUCIÓN O RELACIONAR EL BOLETO DIRECCTAMENTE CON PIERNA O ELIMINAR LA TABLA PIERNA O DEJAR LA TABLA PIERNA PERO COLOCAR CADA VUELO UNA PIERNA SI EL DESTINO SE REQUIERE VARIAS PIERNAS NO SE REGISTRA UN SOLO VUELO SINO IGUAL VARIOS VUELOS
        //AL BOLETO LE AGG LOS CAMPOS CODIGO ASIENTO Y COSTO TOTAL