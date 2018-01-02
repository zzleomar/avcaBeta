<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sueldo_base extends Model
{
    protected $table = 'sueldos_base';
    protected $fillable = [
    	'monto','jerarquia'];

    public function personal(){
    	return $this->hasMany('App\Personal');
    }

    public function vauches(){
    	return $this->hasMany('App\Vauche');
    }
}
