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
        return $this->hasMany('App\Cesta_ticket','sueldoMinimo_id','id');
    }
    Public function escalas(){
        return $this->hasMany('App\Cesta_ticket','escala_id','id');
    }
    Public function antiguedades(){
        return $this->hasMany('App\Cesta_ticket','antiguedad_id','id');
    }
    Public function compensaciones(){
        return $this->hasMany('App\Cesta_ticket','compensacion_id','id');
    }
    Public function constantes(){
        return $this->hasMany('App\Cesta_ticket','constante_id','id');
    }
    


}
