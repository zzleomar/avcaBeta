<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

     protected $fillable = [
        'cargo','personal_id','sucursal_id'
    ];

    Public function sucursal(){
    	return $this->belongsTo('App\Sucursal');
    }

    Public function horarios(){
        return $this->belongsToMany('App\Horario');
    }

    public function personal(){
        return $this->hasOne('App\Personal');
    }

    public function administrativo(){
        return $this->hasOne('App\Administrativo');
    }

    public function personal_operativo(){
        return $this->hasOne('App\Personal_operativo');
    }

    public function asistencias(){
    	return $this->hasMany('App\Asistencia');
    }

}
