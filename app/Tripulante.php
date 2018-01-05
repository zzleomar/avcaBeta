<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tripulante extends Model
{

    protected $table = 'tripulantes';

     protected $fillable = [
        'rango','licencia','personal_id'
    ];
    
    public function personal(){
        return $this->hasOne('App\Personal');
    }

    public function vuelos(){
        return $this->belongsToMany('App\Vuelo');
    }
    
    public function scopePersona($query){
        return Personal::find($this->personal_id);
    }

    public function scopeDisponibilidad($query,$rango,$antes,$despues){
        return DB::select("SELECT tripulantes.id, personal.nombres, personal.apellidos 
                        FROM tripulantes 
                        JOIN tripulante_vuelo ON tripulantes.id=tripulante_vuelo.tripulante_id 
                        JOIN vuelos ON tripulante_vuelo.vuelo_id=vuelos.id 
                        JOIN personal ON tripulantes.personal_id=personal.id 
                        WHERE tripulantes.rango='$rango' AND 
                            NOT(vuelos.salida>'$antes' AND 
                                vuelos.salida<'$despues') 
                            UNION 
                                SELECT tripulantes.id, personal.nombres, personal.apellidos 
                                FROM tripulantes 
                                JOIN personal ON tripulantes.personal_id=personal.id 
                                WHERE tripulantes.rango='$rango' AND 
                                    tripulantes.id NOT IN(SELECT tripulante_vuelo.tripulante_id 
                                            FROM tripulante_vuelo)");
    
        // muy complicada de hacer en laravel

    }

    public function scopeHorasExperiencia($query, $id, $actual){
        return DB::select("SELECT SUM(rutas.duracion) as horas
                            FROM tripulantes 
                            JOIN tripulante_vuelo ON tripulantes.id=tripulante_vuelo.tripulante_id
                            JOIN vuelos ON tripulante_vuelo.vuelo_id=vuelos.id
                            JOIN piernas ON vuelos.id=piernas.vuelo_id
                            JOIN rutas ON piernas.ruta_id=rutas.id
                            WHERE tripulantes.id='$id' AND vuelos.salida<'$actual' AND vuelos.estado!='cancelado'");
    }

    public function scopeHorasPlanificadas($query, $id, $inicio, $final){ 
        return DB::select("SELECT SUM(rutas.duracion) as horas
                           FROM tripulantes 
                           JOIN tripulante_vuelo ON tripulantes.id=tripulante_vuelo.tripulante_id 
                           JOIN vuelos ON tripulante_vuelo.vuelo_id=vuelos.id 
                           JOIN piernas ON vuelos.id=piernas.vuelo_id 
                           JOIN rutas ON piernas.ruta_id=rutas.id 
                           WHERE tripulantes.id='$id' AND 
                                 vuelos.salida>'$inicio' AND 
                                 vuelos.salida<'$final' AND 
                                 vuelos.estado!='cancelado'");
    }

    public function scopeVuelosPlanificadas($query, $id, $inicio, $final){
        return DB::select("SELECT COUNT(vuelos.id) as cantidad
                           FROM tripulantes 
                           JOIN tripulante_vuelo ON tripulantes.id=tripulante_vuelo.tripulante_id 
                           JOIN vuelos ON tripulante_vuelo.vuelo_id=vuelos.id 
                           JOIN piernas ON vuelos.id=piernas.vuelo_id 
                           JOIN rutas ON piernas.ruta_id=rutas.id 
                           WHERE tripulantes.id='$id' AND 
                                 vuelos.salida>'$inicio' AND 
                                 vuelos.salida<'$final' AND 
                                 vuelos.estado!='cancelado'");
    }
}
