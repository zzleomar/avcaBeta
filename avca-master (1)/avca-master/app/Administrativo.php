<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    protected $table = 'administrativos';

    protected $fillable = [
        'horas_laboradas','horas_extras','cargo','personal_id','sucursal_id','horario_id'//,'user_id'
    ];

	public function personal(){
        //$this->hasOne('App\Personal','id_personal','id');
        return $this->hasOne('App\Personal');
    }

    public function user(){
        return $this->hasOne('App\User');
    }

    Public function sucursal(){
    	return $this->belongsTo('App\Sucursal');
    }

    Public function horario(){
        return $this->belongsTo('App\Horario');
    }

}

