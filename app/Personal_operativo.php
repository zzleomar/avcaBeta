<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Personal_operativo extends Model
{
    protected $table = 'personal_operativo';

    protected $fillable = [
        'empleado_id'
    ];

    public function empleado(){
        return $this->hasOne('App\Empleado');
    }


}
