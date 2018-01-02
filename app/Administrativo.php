<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    protected $table = 'administrativos';

    protected $fillable = [
        'empleado_id'
    ];

	public function empleado(){
        return $this->hasOne('App\Empleado');
    }

}

