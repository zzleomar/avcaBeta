<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Nomina extends Model
{
    protected $table ="nominas";

    protected $fillable = [
        'fecha','monto_sueldos','monto_compensacion','monto_deducciones','monto_antiguedad','monto_utilidades','monto_vacaciones','monto_cesta_tickets'
    ];

    public function vouches(){
    	return $this->hasMany('App\Vouche');
    }

    public function scopeActual($query, $mes, $year){
        return $query->whereMonth('fecha', $mes)
                     ->whereYear('fecha', $year);
    	/*return DB::select("Select nominas.* from nominas where MONTH(fecha)='$mes' and YEAR(fecha)='$year'");*/
    }

    public function scopevouchesS($query,$idS,$idN){
        return $query->where("empleados.sucursal_id",$idS)
            ->where("nominas.id",$idN)
            ->join('vouches', 'nominas.id', '=', 'vouches.nomina_id')
            ->join('personal', 'vouches.personal_id', '=', 'personal.id')
            ->join('empleados', 'personal.id', '=', 'empleados.personal_id')
            ->select('vouches.id');
    }
}
