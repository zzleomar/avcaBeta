<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aeronave extends Model
{

    protected $table ="aeronaves";

    protected $fillable = [
    	'capacidad','modelo','matricula','estado'
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

}
