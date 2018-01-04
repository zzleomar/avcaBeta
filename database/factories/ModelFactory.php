<?php

use Faker\Generator as Faker;
use App\Pasajero;
use App\Personal;
use App\Empleado;
use App\Aeronave;
use App\Sucursal;
use App\User;
use App\Vuelo;
use App\Pierna;
use App\Tripulante;

$factory->define(Vuelo::class, function (Faker $faker) {
    
return [
        'salida' => $faker->dateTimeBetween('-1 month','2018-02-30 12:00:00',date_default_timezone_get()),
        'estado' => "abierto"
    ];
});
$factory->define(Pierna::class, function (Faker $faker) {
    return [
    ];
});
$factory->define(Aeronave::class, function (Faker $faker) {
    return [
        'capacidad' => "64",
        'modelo' => "ATR-72",
        'estado' => "activo",
        'ultimo_mantenimiento' => '2017-12-28',
        'matricula' => str_random(5)
    ];
});

$factory->define(Pasajero::class, function (Faker $faker) {
	return [
		'nombres' => $faker->firstName,
		'apellidos' => $faker->lastName,
		'cedula' => 'V'.$faker->postcode,
        'tlf_movil' => $faker->phoneNumber,
        'tlf_casa' => $faker->phoneNumber,
        'direccion' => $faker->address
	];
});

$factory->define(User::class, function (Faker $faker) {
	return [
		'username' =>$faker->userName,
		'password' =>bcrypt('1234567'),
		'email' =>$faker->safeEmail,
        'remember_token' => str_random(10)
    ];
});

$factory->define(Sucursal::class, function (Faker $faker) {
	return [
		'direccion' => $faker->address
    ];
});

$factory->define(Personal::class, function (Faker $faker) {

return [
        'nombres' => $faker->firstName,
		'apellidos' => $faker->lastName,
		'cedula' => 'V'.$faker->postcode,
		'tlf_movil' => $faker->phoneNumber,
		'tlf_casa' => $faker->phoneNumber,
		'direccion' => $faker->address,
        'entrada' => $faker->dateTimeBetween('-2 year','2017-11-30 12:00:00',date_default_timezone_get())
    ];
});

$factory->define(Empleado::class, function (Faker $faker) {
    $x=$faker->randomDigit;
    if($x!=0){
    	$x=(($x/10)*27);
    	$x=intval($x);
    	if($x==0)
    		$x=1;
    }
    else{
    	$x=1;
    }
    $y=$faker->randomDigit;
    if($y!=0){
    	$y=(($y/10)*5);
    	$y=intval($y);
    	if($y==0)
    		$y=1;
    }
    else{
    	$y=1;
    }
    return [
        
	//	'sucursal_id'     => $x,
		//'horario_id'      => $y
		//'sucursal_id'     => $this->random('Sucursal')->id,
		//'horario_id'      => $this->random('Horario')->id
    ];
});

$factory->define(Tripulante::class, function (Faker $faker) {
    return [
        'licencia' => $faker->postcode
    ];
});

?>
