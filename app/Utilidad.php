<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilidad extends Model
{
	protected $table ="utilidades";

    protected $fillable = [
        'monto'
    ];

    public function vauches(){
    	return $this->hasMany('App\Vauche');
    }
}
