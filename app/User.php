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
        'username','tipo','password','email','administrativo_id'
    ];

    public function administrativo(){
        return $this->hasOne('App\Administrativo');
    }
    public function scopePersonal($query, $dato){
        $administrativo=Administrativo::find($dato);
        return Personal::find($administrativo->personal_id);
    }

}
