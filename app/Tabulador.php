<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tabulador extends Model
{
    
	protected $table ="tabuladores";

    protected $fillable = [
    	'descripcion','digito','estado'
    ];


    Public function cesta_tickets(){
        return $this->hasMany('App\Cesta_ticket','unidadTributaria_id','id');
    }
    Public function sueldosMinimos(){
        return $this->hasMany('App\Vouche','sueldoMinimo_id','id');
    }
    Public function escalas(){
        return $this->hasMany('App\Vouche','escala_id','id');
    }
    Public function antiguedades(){
        return $this->hasMany('App\Vouche','antiguedad_id','id');
    }
    Public function compensaciones(){
        return $this->hasMany('App\Vouche','compensacion_id','id');
    }
    Public function constantes(){
        return $this->hasMany('App\Vouche','constante_id','id');
    }

    Public function scopebuscar($query, $tabulador){
        return $query->where([['descripcion',"=",$tabulador],['estado',"=","Activo"]]);
    }
    


}
