<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    protected $fillable = ['nombre','direccion','tasa_salida','tasa_mantenimiento'];

    public function administrativos(){
    	return $this->hasMany('App\Administrativo');
    }

    public function destinos(){//retorna los destinos para su sucursal
    	return $this->hasMany('App\Ruta','origen_id','id');
    }
    public function origenes(){//retorna las rutas de las sucursales que llegan a la sucursal
    	return $this->hasMany('App\Ruta','destino_id','id');
    }
    
}


