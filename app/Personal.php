<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table ="personal";

    protected $fillable =[
	'nombres','apellidos','cedula','tlf_movil','tlf_casa','direccion','sueldo_base_id'
	];

    public function empleado(){
    	return $this->hasOne('App\Empleado');
    }
    public function tripulante(){
    	return $this->hasOne('App\Tripulante');
    }

    Public function sueldo_base(){
        return $this->belongsTo('App\Sueldo_base');
    }
    public function user(){
        return $this->hasOne('App\User');
    }

    public function vauches(){
        return $this->hasMany('App\Vauche');
    }

    public function scopeBuscarCI($query, $dato){
        return $query->where('cedula',$dato);
    }

}
