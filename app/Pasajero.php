<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Pasajero extends Model
{
    protected $table ="pasajeros";

    protected $fillable = [
        'nombres', 'apellidos','cedula','tlf_movil','tlf_casa','direccion'
    ];

	public function facturas(){
		return $this->hasMany('App\Factura');
	}
	public function boletos(){
		return $this->hasMany('App\Boleto');
	}
	public function scopeBuscarCI($query, $dato){
		return $query->where('cedula',$dato);
	   // return DB::table('pasajeros')->where('cedula',$dato)->get();
	}
}
