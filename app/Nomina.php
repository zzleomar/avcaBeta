<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    protected $table ="nominas";

    protected $fillable = [
        'fecha'
    ];

    public function vauches(){
    	return $this->hasMany('App\Vauche');
    }
}
