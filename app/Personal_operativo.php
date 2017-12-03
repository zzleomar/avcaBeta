<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal_operativo extends Model
{
    protected $table = 'personal_operativo';

    protected $fillable = ['rango','horas_extras','licencia','personal_id'];

    public function personal(){
        return $this->hasOne('App\Personal');
    }
    public function vuelos(){
    	return $this->belongsToMany('App\Vuelo');
    }
}
