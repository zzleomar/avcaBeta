<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ruta extends Model
{
    protected $table ="rutas";

    protected $fillable = [
    	'distancia','duracion','tarifa_sobrepeso','tarifa_vuelo','destino_id','origen_id'
    ];

    public function origen(){
    	return $this->belongsTo('App\Sucursal','origen_id','id');
    }
    public function destino(){
    	return $this->belongsTo('App\Sucursal','destino_id','id');
    }
    public function piernas(){
    	return $this->hasMany('App\Pierna');
    }

    public function scopeBuscador($query, $origen,$destino){
        return $query->where('destino_id',$destino)
                    ->where('origen_id',$origen);
    }
}
