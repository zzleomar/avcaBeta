<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table ="horarios";

    protected $fillable = [
        'entrada', 'salida'
    ];

    public function administrativo(){
    	return $this->hasMany('App\Administrativo');
    }
}
