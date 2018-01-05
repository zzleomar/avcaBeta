<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vouche extends Model
{
	protected $table = 'vouches';

     protected $fillable = [
        'sueldo_base_id','personal_id','nomina_id',
        'utilidad_id','vacacion_id','deduccion_id',
        'compensacion_id','cesta_ticket_id'
    ];
    Public function sueldo_base(){
        return $this->belongsTo('App\Sueldo_base');
    }
    Public function personal(){
        return $this->belongsTo('App\Personal');
    }
     Public function nomina(){
        return $this->belongsTo('App\Nomina');
    }
    Public function utilidad(){
        return $this->belongsTo('App\Utilidad');
    }
    Public function compensacion(){
        return $this->belongsTo('App\Compensacion');
    }

    public function deduccion(){
    	return $this->hasOne('App\Deduccion');
    }
    public function cesta_ticket(){
    	return $this->hasOne('App\Cesta_ticket');
    }
    public function vacacion(){
    	return $this->hasOne('App\Vacacion');
    }
    
}