<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeronave extends Model
{

    protected $table ="aeronaves";

    protected $fillable = [
    	'capacidad','modelo'
    ];
    

    public function piernas(){
    	return $this->hasMany('App\Pierna');
    }

}
