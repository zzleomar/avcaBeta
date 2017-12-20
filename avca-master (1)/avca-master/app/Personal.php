<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table ="personal";

    protected $fillable =[
	'nombres','apellidos','cedula','tlf_movil','tlf_casa','direccion'
	];

    public function personal_operativo(){
    	return $this->hasOne('App\Personal_operativo');
    }
    public function administrativo(){
    	return $this->hasOne('App\Administrativo');
    }

}
