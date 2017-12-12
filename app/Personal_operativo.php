<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Personal_operativo extends Model
{
    protected $table = 'personal_operativo';

    protected $fillable = ['rango','horas_extras','licencia','personal_id'];

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
        return DB::select("SELECT personal_operativo.id, personal.nombres, personal.apellidos 
                        FROM personal_operativo 
                        JOIN personal_operativo_vuelo ON personal_operativo.id=personal_operativo_vuelo.personal_operativo_id 
                        JOIN vuelos ON personal_operativo_vuelo.vuelo_id=vuelos.id 
                        JOIN personal ON personal_operativo.personal_id=personal.id 
                        WHERE personal_operativo.rango='$rango' AND 
                            NOT(vuelos.salida>'$antes' AND 
                                vuelos.salida<'$despues') 
                            UNION 
                                SELECT personal_operativo.id, personal.nombres, personal.apellidos 
                                FROM personal_operativo 
                                JOIN personal ON personal_operativo.personal_id=personal.id 
                                WHERE personal_operativo.rango='$rango' AND 
                                    personal_operativo.id NOT IN(SELECT personal_operativo_vuelo.personal_operativo_id 
                                            FROM personal_operativo_vuelo)");
    
        /* muy complicada de hacer en laravel
        


         return DB::table('personal_operativo')
            ->join('personal_operativo_vuelo', 'personal_operativo.id', '=', 'personal_operativo_vuelo.personal_operativo_id')
            ->join('vuelos','personal_operativo_vuelo.vuelo_id','=','vuelos.id')
            ->join('personal','personal_operativo.personal_id','=','personal.id')
            ->select('personal_operativo.id','personal.nombres','personal.apellidos')
            ->where('personal_operativo.rango','=',$rango)
            ->where(function ($query){

            }),['vuelos.salida','>',$antes],['vuelos.salida','<',$despues]]);*/

    }

}
