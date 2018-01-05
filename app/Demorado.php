<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demorado extends Model
{
    protected $table = 'demorados';

     protected $fillable = [
        'demora','salida_demorada','vuelo_id'
    ];


    Public function vuelo(){
        return $this->hasOne('App\Vuelo');
    }
}
