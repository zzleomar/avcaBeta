<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    protected $fillable = ['nombre','direccion','tasa_salida','tasa_mantenimiento'];

    public function administrativos(){
    	return $this->hasMany('App\Administrativo');
    }

    public function destinos(){//retorna los destinos para su sucursal
    	return $this->hasMany('App\Ruta','id','id_origen');
    }
    public function origenes(){//retorna las rutas de las sucursales que llegan a la sucursal
    	return $this->hasMany('App\Ruta','id','id_destino');
    }
}


