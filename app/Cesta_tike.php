<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cesta_tike extends Model
{
    protected $table ="cesta_tikes";

    protected $fillable = [
        'monto','dias'
    ];

    public function vauche(){
    	return $this->hasOne('App\Vauche');
    }
}
