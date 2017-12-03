<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    protected $table ="rutas";

    protected $fillable = [
    	'distancia','duracion','tarifa_sobrepeso','tarifa_vuelo','destino_id','origen_id'
    ];

    public function origen(){
    	return $this->belongsTo('App\Sucursal','origen_id','id');
    }
    public function detino(){
    	return $this->belongsTo('App\Sucursal','destino_id','id');
    }
    public function piernas(){
    	return $this->hasMany('App\Pierna');
    }

}
