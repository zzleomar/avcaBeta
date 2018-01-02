<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduccion extends Model
{
    protected $table ="deducciones";

    protected $fillable = [
        'monto','ausencias'
    ];

    public function vauche(){
    	return $this->hasOne('App\Vauche');
    }
}
