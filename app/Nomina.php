<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Nomina extends Model
{
    protected $table ="nominas";

    protected $fillable = [
        'fecha','monto_sueldos','monto_compensacion','monto_deducciones','monto_antiguedad'
    ];

    public function vouche(){
    	return $this->hasMany('App\Vouche');
    }

    public function scopeActual($query, $mes, $year){
        return $query->whereMonth('fecha', $mes)
                     ->whereYear('fecha', $year);
    	/*return DB::select("Select nominas.* from nominas where MONTH(fecha)='$mes' and YEAR(fecha)='$year'");*/
    }
}
