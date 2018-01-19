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
use App\Empleado;
use App\Personal;
use App\Http\Requests\confirmarRequest;
use Auth;
use Szykra\Notifications\Flash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;





class ListaChequeo extends Controller
{
	public function __construct(){
      Carbon::setLocale('es');
      date_default_timezone_set('America/Caracas');
    }

    public function ajaxInicio(){
    	$personal=Personal::find(Auth::user()->personal_id);
        $sucursal= $personal->empleado->sucursal;        
        $actual = Carbon::now();     
        
        //Revisr Vuelo Cerrado
        //Vuelo::VuelosCerrados($actual2->toDateTimeString());

        $vuelos=Vuelo::Sucursal($sucursal->id,"abierto");       
        foreach ($vuelos as $key => $vuelo) {
            $inicio = Carbon::parse($vuelo->salida);
            $fin = Carbon::parse($vuelo->salida);
            $inicio->subHours(1); //inicio           
            if(!(($actual->gt($inicio))&&($actual->lt($fin)))){                
                unset($vuelos[$key]);
            }

            $VuelosSet = array();
            foreach ($vuelos as $vuelo ) {
            	array_push($VuelosSet, Vuelo::find($vuelo->id));
            }
        }

         
        return view('taquillero.ajax.ajaxlistachequeo')->with('vuelos',$VuelosSet)->with('sucursal',$sucursal);
    }

    public function listaimprimir(Request $datos){
        $personal=Personal::find(Auth::user()->personal_id);
        $sucursal= Sucursal::find($personal->empleado->sucursal->id);    
       
    	$vuelo = Vuelo::find($datos->idvuelo);

    	$view = \View::make('pdf.chequeo')->with('vuelo',$vuelo)->with('sucursal',$sucursal)->render();
        $pdf  = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('chequeo');

    }

    

    

}
