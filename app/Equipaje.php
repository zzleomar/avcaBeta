<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipaje extends Model
{
    protected $table ="equipajes";

    protected $fillable = [
        'peso','boleto_id'
    ];
    
    public function boletos(){
    	return $this->HasOne('App\Boleto');
    }
}
