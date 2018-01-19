<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vouche extends Model
{
	protected $table = 'vouches';

     protected $fillable = [
        'sueldo_base','personal_id','nomina_id',
        'utilidad','vacacion','deduccion',
        'compensacion','antiguedad','ausencias','sueldoMinimo_id','escala_id','antiguedad_id','compensacion_id','constante_id'
    ];


    Public function personal(){
        return $this->belongsTo('App\Personal');
    }
     Public function nomina(){
        return $this->belongsTo('App\Nomina');
    }
    public function sueldoMinimo(){
        return $this->belongsTo('App\Tabulador','sueldoMinimo_id','id');
    }
    public function escala(){
        return $this->belongsTo('App\Tabulador','escala_id','id');
    }
    public function antiguedad(){
        return $this->belongsTo('App\Tabulador','antiguedad_id','id');
    }
    public function compensacion(){
        return $this->belongsTo('App\Tabulador','compensacion_id','id');
    }
    public function constante(){
        return $this->belongsTo('App\Tabulador','constante_id','id');
    }
    
    
}