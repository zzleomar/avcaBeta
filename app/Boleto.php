<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Boleto extends Model
{

	protected $table ="boletos";

    protected $fillable = [
    	'estado','pasajero_id','vuelo_id','asiento','costo'
    ];


    public function pasajero(){
    	return $this->belongsTo('App\Pasajero');
    }
    public function vuelo(){
    	return $this->belongsTo('App\Vuelo');
    }
    public function equipaje(){
        return $this->hasOne('App\Equipaje');
    }
    public function scopeGenerar($query, $ocupados,$vuelo,$costo){
        $this->estado  ="Temporal";
        $this->vuelo_id=$vuelo;
        $this->asiento =($ocupados+1);
        $this->costo   =$costo;
        $this->save();
    }
    public function scopeBuscarP($query, $vuelo, $pasajero){ //busca un boleto de cierto vuelo que le pertenesca a x pasajero y retorna su estado
        return DB::table('boletos')->select('estado')->where('vuelo_id',$vuelo)->where('pasajero_id',$pasajero);
    }
//busca el boleto con cierto estado de algun vuelo que le pertenesca al pasajero y lo retorna
    public function scopeBuscar($query, $vuelo, $pasajero, $estado){
        return DB::table('boletos')
            ->where('vuelo_id',$vuelo)
            ->where('estado',$estado)
            ->where('pasajero_id',$pasajero);
    }

    public function scopePendiente($query, $pasajero){
        return DB::table('boletos')->where('estado','Cancelado')->where('pasajero_id',$pasajero)->get();   
    }
    
    public function scopeChequear($query, $pasajero){
        
    }

    public function EliminarRegistroTemporal($sucursal){
        DB::table('boletos')
            ->join('vuelos', 'vuelos.id', '=', 'boletos.vuelo_id')
            ->join('piernas', 'vuelos.id', '=', 'piernas.vuelo_id')
            ->join('rutas', 'piernas.ruta_id', '=', 'rutas.id')
            ->join('sucursales', 'rutas.origen_id', '=', 'sucursales.id')
            ->where('boletos.estado', '=', 'Temporal')
            ->where('sucursales.id', '=', $sucursal)
            ->delete();
    }
            
}
