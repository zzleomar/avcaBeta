<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aeronave extends Model
{

    protected $table ="aeronaves";

    protected $fillable = [
    	'capacidad','modelo','matricula','estado','ultimo_mantenimiento'
    ];
    

    public function piernas(){
    	return $this->hasMany('App\Pierna');
    }

    public function scopeDisponibilidad($query,$antes,$despues){
        return DB::select("SELECT aeronaves.id, aeronaves.modelo, aeronaves.matricula 
                        FROM aeronaves 
                        JOIN piernas ON aeronaves.id=piernas.aeronave_id 
                        JOIN vuelos ON piernas.vuelo_id=vuelos.id 
                        WHERE NOT(vuelos.salida>'$antes' AND 
                                vuelos.salida<'$despues') 
                            UNION 
                                SELECT aeronaves.id, aeronaves.modelo, aeronaves.matricula 
                                FROM aeronaves
                                WHERE aeronaves.id NOT IN(SELECT piernas.aeronave_id 					  FROM piernas)");
    }

    public function scopeModelos($query){
        return $query->select('modelo')->groupBy('modelo');
    }
    public function scopeModelosA($query, $modelo){
        return $query->where('modelo','=',$modelo);
    }
    public function scopeBuscador($query, $matricula){
        return $query->where('matricula','=',$matricula);
    }
    public function scopeEstados($query){
        return $query->select('estado')->groupBy('estado');
    }
    public function scopeEstadosA($query, $estado){
        return $query->where('estado','=',$estado);
    }

    public function scopeHorasPostMantenimiento($query, $aeronave){
        return DB::select("SELECT SUM(rutas.duracion) as horas
                           FROM vuelos 
                                JOIN piernas ON vuelos.id=piernas.vuelo_id 
                                JOIN aeronaves ON piernas.aeronave_id=aeronaves.id 
                                JOIN rutas ON piernas.ruta_id=rutas.id 
                                WHERE aeronaves.id='$aeronave' AND 
                                      vuelos.salida> aeronaves.ultimo_mantenimiento AND 
                                      vuelos.estado!='cancelado'");
    }

    public function scopeHorasUso($query,$aeronave,$actual){
        return DB::select("SELECT SUM(rutas.duracion) as horas
                           FROM vuelos 
                                JOIN piernas ON vuelos.id=piernas.vuelo_id 
                                JOIN aeronaves ON piernas.aeronave_id=aeronaves.id 
                                JOIN rutas ON piernas.ruta_id=rutas.id 
                                WHERE aeronaves.id='$aeronave' AND 
                                      vuelos.salida> aeronaves.ultimo_mantenimiento AND 
                                      vuelos.salida < '$actual' AND
                                      vuelos.estado!='cancelado'");
    }

    public function scopeHorasPlanificadas($query,$aeronave,$actual){

        return DB::select("SELECT SUM(rutas.duracion) as horas
                           FROM vuelos 
                                JOIN piernas ON vuelos.id=piernas.vuelo_id 
                                JOIN aeronaves ON piernas.aeronave_id=aeronaves.id 
                                JOIN rutas ON piernas.ruta_id=rutas.id 
                                WHERE aeronaves.id='$aeronave' AND 
                                      vuelos.salida> '$actual' AND 
                                      vuelos.estado!='cancelado'");
    }

}
