<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    protected $table ="vacaciones";

    protected $fillable = [
        'monto','fecha_inicio','fecha_finalizacion'
    ];

    public function vauche(){
    	return $this->hasOne('App\Vauche');
    }
}
