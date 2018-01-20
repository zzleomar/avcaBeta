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
    Public function demorado(){
        return $this->hasOne('App\Demorado');
    }
    public function pierna(){
        return $this->hasOne('App\Pierna');
    }
    public function tripulantes(){
    	return $this->belongsToMany('App\Tripulante');
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
    public function scopeBoleteria($query, $estado, $vuelo){
        return DB::table('vuelos')->join('boletos', 'vuelos.id', '=', 'boletos.vuelo_id')->where([['boletos.estado',$estado],['vuelos.id',$vuelo]])->count();
    }
    //nueva scopefunción para index
    public function scopeDestinos($query, $dato, $fecha){
        return DB::table('vuelos')->join('piernas', 'vuelos.id', '=', 'piernas.vuelo_id')->join('rutas', 'piernas.ruta_id', '=', 'rutas.id')->join('sucursales', 'rutas.destino_id', '=', 'sucursales.id')->select('sucursales.id as su','sucursales.nombre','rutas.id')->where([['rutas.origen_id','=',$dato],['vuelos.estado','=','abierto'],['vuelos.salida','>',$fecha]])->groupBy('sucursales.id','sucursales.nombre','rutas.id')->get();
    }

    public function scopeHorarios($query,$origen,$destino, $fechaAux){
        return DB::table('vuelos')->
            join('piernas','vuelos.id', '=', 'piernas.vuelo_id')->
            join('rutas','piernas.ruta_id','=','rutas.id')->
            join('sucursales','rutas.destino_id','=','sucursales.id')->
            select('vuelos.id','vuelos.salida')->
            where([['rutas.destino_id','=',$destino],['rutas.origen_id','=',$origen],['vuelos.salida','>',$fechaAux]])->whereNotIn('vuelos.estado', ['cancelado','ejecutado'])->get();    
    }

    public function scopeBuscador($query,$ruta,$estado){
            return DB::table('vuelos')->
                join('piernas','vuelos.id', '=', 'piernas.vuelo_id')->
                join('rutas','piernas.ruta_id','=','rutas.id')->
                select('vuelos.id','vuelos.salida','vuelos.estado')->
                where([['rutas.id','=',$ruta],['vuelos.estado','=',$estado]])->get();          
    }

    public function scopeFillBuscador($query,$estado,$ruta){
        if($ruta==0){
            return $query->where("vuelos.estado","=",$estado)
                         ->join('piernas', 'vuelos.id', '=', 'piernas.vuelo_id')
                         ->select('vuelos.id','vuelos.salida', 'vuelos.estado','piernas.ruta_id');
        }
        else{
            return $query->where([["vuelos.estado","=",$estado],["rutas.id","=",$ruta]])
                         ->join('piernas', 'vuelos.id', '=', 'piernas.vuelo_id')
                         ->join('rutas', 'piernas.ruta_id', '=', 'rutas.id')
                         ->select('vuelos.id','vuelos.salida', 'vuelos.estado','piernas.ruta_id');
        }
    }


    public function scopeSucursal($query, $dato, $estado){
        return DB::table('vuelos')
        ->join('piernas', 'vuelos.id', '=', 'piernas.vuelo_id')
        ->join('rutas', 'piernas.ruta_id', '=', 'rutas.id')
        ->join('sucursales', 'rutas.destino_id', '=', 'sucursales.id')
        ->select('vuelos.id','vuelos.salida', 'vuelos.estado','sucursales.nombre')
        ->where([['rutas.origen_id','=',$dato],['vuelos.estado','=',$estado]])
        ->groupBy('vuelos.id','vuelos.salida', 'vuelos.estado','sucursales.nombre')
        ->orderBy('vuelos.salida','ASC')->get();
    }

    public function scopeRetrasados($query, $dato, $fecha){
        return DB::table('vuelos')
        ->join('piernas', 'vuelos.id', '=', 'piernas.vuelo_id')
        ->join('rutas', 'piernas.ruta_id', '=', 'rutas.id')
        ->join('sucursales', 'rutas.destino_id', '=', 'sucursales.id')
        ->select('vuelos.id','vuelos.salida', 'vuelos.estado','sucursales.nombre')
        ->where([['rutas.origen_id','=',$dato],['vuelos.salida','<',$fecha],['vuelos.estado','!=','ejecutado'],['vuelos.estado','!=','cancelado']])
        ->groupBy('vuelos.id','vuelos.salida', 'vuelos.estado','sucursales.nombre')
        ->orderBy('vuelos.salida','ASC')->get();
    }

    public function scopeVuelosRetrasados($query, $fecha){

        $vuelos=$query->where([['vuelos.salida','<',$fecha],['vuelos.estado','!=','ejecutado'],['vuelos.estado','!=','cancelado']])->get();
        foreach ($vuelos as $vuelo) {
            $vuelo->estado="retrasado";
            $vuelo->save();
        }
    }

    public function scopeVuelosCerrados($query, $fecha){ //fecha=a la fecha actual+1hra

        $vuelos=$query->where([['vuelos.salida','<',$fecha],['vuelos.estado','!=','retrasado'],['vuelos.estado','!=','ejecutado'],['vuelos.estado','!=','cancelado']])->get();
        foreach ($vuelos as $vuelo) {
            $vuelo->estado="cerrado";
            $vuelo->save();
        }
    }

    public function scopeActualizar($query, $dato, $estado){
        $vuelo =Vuelo::find($dato);
        $vuelo->estado=$estado;
        $vuelo->save();
    }
    
    
}
