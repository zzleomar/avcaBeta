<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cesta_ticket extends Model
{
    protected $table ="cesta_tickets";

    protected $fillable = [
        'monto','dias'
    ];

    public function vouche(){
    	return $this->hasOne('App\Vouche');
    }
}
