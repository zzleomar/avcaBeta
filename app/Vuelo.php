<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vuelo extends Model
{
    protected $table ="vuelos";

    protected $fillable = [
        'estado', 'salida'
    ];
    public function boletos(){
    	return $this->hasMany('App\boleto');
    }
    /*public function piernas(){
        return $this->hasMany('App\Pierna');
    }*/
    public function pierna(){
        return $this->hasOne('App\Pierna');
    }
    public function personal_operativo(){
    	return $this->belongsToMany('App\Personal_operativo');
    }
    public function scopeConsulta($query, $dato){
        return DB::table('vuelos')->join('piernas', 'vuelos.id', '=', 'piernas.vuelo_id')->join('aeronaves', 'piernas.aeronave_id', '=', 'aeronaves.id')->join('rutas', 'piernas.ruta_id', '=', 'rutas.id')->join('sucursales', 'rutas.destino_id', '=', 'sucursales.id')->select('vuelos.id','vuelos.salida', 'vuelos.estado', 'aeronaves.capacidad','sucursales.nombre','rutas.tarifa_vuelo', 'rutas.id')->where('rutas.origen_id',$dato)->get();
    }
    public function scopeDisponibilidad($query, $estados,$id){
        $contador=0;
        foreach ($estados as $estado) {
            $contador=$contador+(DB::table('vuelos')->join('boletos', 'vuelos.id', '=', 'boletos.vuelo_id')->where([['boletos.estado',$estado],['vuelos.id',$id]])->count());
        }
        return $contador;
    }
    //nueva scopefunción para index
    public function scopeDestinos($query, $dato){
        return DB::table('vuelos')->join('piernas', 'vuelos.id', '=', 'piernas.vuelo_id')->join('rutas', 'piernas.ruta_id', '=', 'rutas.id')->join('sucursales', 'rutas.destino_id', '=', 'sucursales.id')->select('sucursales.id as su','sucursales.nombre','rutas.id')->where([['rutas.origen_id','=',$dato],['vuelos.estado','=','abierto']])->groupBy('sucursales.id','sucursales.nombre','rutas.id')->get();
    }

    public function scopeHorarios($query,$origen,$destino){
        return DB::table('vuelos')->
            join('piernas','vuelos.id', '=', 'piernas.vuelo_id')->
            join('rutas','piernas.ruta_id','=','rutas.id')->
            join('sucursales','rutas.destino_id','=','sucursales.id')->
            select('vuelos.id','vuelos.salida')->
            where([['rutas.destino_id','=',$destino],['rutas.origen_id','=',$origen]])->get();       
    }
    
}
