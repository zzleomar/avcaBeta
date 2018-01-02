<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Personal;
use App\Administrativo;

class User extends Authenticatable
{
    use Notifiable;

    protected $table ="users";

    protected $fillable = [
        'username','tipo','password','email','personal_id'
    ];

    public function personal(){
        return $this->hasOne('App\Personal');
    }
    public function scopeDatosPersonal($query, $dato){
        return Personal::find($dato)->first();
    }

}
