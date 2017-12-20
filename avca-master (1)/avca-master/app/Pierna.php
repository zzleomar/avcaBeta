<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pierna extends Model
{
    protected $table ="piernas";

    protected $fillable = [
    	'aeronave_id','vuelo_id','ruta_id'
    ];

    public function aeronave(){
    	return $this->belongsTo('App\Aeronave');
    }

   /* public function vuelo(){
    	return $this->belongsTo('App\Vuelo');
    }*/

    public function vuelo(){
        return $this->hasOne('App\Vuelo');
    }

    public function ruta(){
    	return $this->belongsTo('App\Ruta');
    }
    
}
