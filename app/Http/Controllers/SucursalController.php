<?php

namespace App\Http\Controllers;
use App\Vuelo;
use App\Sucursal;
use App\User;
use App\Personal;
use Auth;
use Szykra\Notifications\Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    public function index(){

        $personal=Personal::find(Auth::user()->personal_id);
        $sucursal= $personal->empleado->sucursal;

        $vuelo=new Vuelo();
        $datos1=$vuelo->Sucursal($sucursal->id,"abierto");
        $datos2=$vuelo->Sucursal($sucursal->id,"cerrado");
        $datos3=$vuelo->Retrasados($sucursal->id,date('Y-m-d H:i:s'));
        if(sizeof($datos3)!=0){
            foreach ($datos3 as $datos) {
                $vuelo->Actualizar($datos->id,"retrasado");
            }
        }
        return view('subgerente-sucursal.index')
    	->with('sucursal',$sucursal)
        ->with('vuelosA',$datos1)
        ->with('vuelosC',$datos2)
    	->with('vuelosR',$datos3);
    }

    public function VueloDetalles($id){
        $vuelo= Vuelo::find($id);
        $boletos=['Pagado','Reservados'];
        $estado=[0 => "Pagado"];
        $boletos['Pagado']= $vuelo->Disponibilidad($estado,$id);
        $estado[0]="Reservados";
        $boletos['Reservados']= $vuelo->Disponibilidad($estado,$id);
        $vuelo->tripulantes();
       // dd($vuelo->pierna->aeronave->matricula);
        return view('subgerente-sucursal.ajax.info-vuelo-ajax')
                ->with('boletos',$boletos)
                ->with('vuelo',$vuelo);      
    }

    public function CulminarVuelo($id){
        $vuelo=new Vuelo();
        $vuelo->Actualizar($id,"ejecutado");
        flash::success('El vuelo '.$id.' ha cambiado de estado');
        return redirect('/sucursal');

    }
}
