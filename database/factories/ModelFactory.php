<?php

use Faker\Generator as Faker;
use App\Pasajero;
use App\Personal;
use App\Administrativo;
use App\Aeronave;
use App\Sucursal;
use App\User;
use App\Vuelo;
use App\Pierna;
use App\Personal_operativo;

$factory->define(Vuelo::class, function (Faker $faker) {
    
return [
        'salida' => $faker->dateTimeThisMonth('2017-12-30 12:00:00',date_default_timezone_get()),
        'estado' => "abierto"
    ];
});
$factory->define(Pierna::class, function (Faker $faker) {
    return [
    ];
});
$factory->define(Aeronave::class, function (Faker $faker) {
    return [
        'capacidad' => "108",
        'modelo' => "Boeing 737",
        'estado' => "Activo",
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
        'tasa_salida' => '5000',
        'tasa_mantenimiento' => '2000',
        'tasa_sobrepeso' => '1000',
		'direccion' => $faker->address
    ];
});

$factory->define(Personal::class, function (Faker $faker) {

return [
        'nombres' => $faker->firstName,
		'apellidos' => $faker->lastName,
		'cedula' => $faker->postcode,
		'tlf_movil' => $faker->phoneNumber,
		'tlf_casa' => $faker->phoneNumber,
		'direccion' => $faker->address
    ];
});

$factory->define(Administrativo::class, function (Faker $faker) {
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
        
        'horas_laboradas' => '00:00:00',
        'horas_extras'    => '00:00:00',
	//	'sucursal_id'     => $x,
		'horario_id'      => $y
		//'sucursal_id'     => $this->random('Sucursal')->id,
		//'horario_id'      => $this->random('Horario')->id
    ];
});

$factory->define(Personal_operativo::class, function (Faker $faker) {
    return [
        'horas_extras'    => '00:00:00',
        'licencia' => $faker->postcode
    ];
});

?>
