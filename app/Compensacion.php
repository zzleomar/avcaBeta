<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compensacion extends Model
{
    protected $table ="compensaciones";

    protected $fillable = [
        'monto'
    ];

    public function vauches(){
    	return $this->hasMany('App\Vauche');
    }
}
