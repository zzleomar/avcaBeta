<?php

use Illuminate\Database\Seeder;

class SucursalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Caracas – Maiquetía',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'CCS'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Puerto Ayacucho',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'PYH'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'San Tomé – Anzoátegui',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'SOM'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'San Fernando de Apure',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'SFD'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Maracay',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'MYC'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Barinas',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'BNS'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Ciudad Bolivar',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'CBL'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Valencia',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'VLN'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'San Carlos',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'SCC'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Tucupita',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'TUV'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Punto Fijo – Falcón',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'LSP'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Barquisimeto',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'BRM'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Maturín',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'MUN'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Porlamar – Isla de Margarita',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'PMV'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Acarigua - Portuguesa',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'AGV'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Cumaná',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'CUM'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'San Cristobal - Táchira',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'SCI'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Trujillo',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'VLV'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'San Felipe -Yaracuy',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'SNF'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Maracaibo',
		    'nombre_aeropuerto' => ' ',
		    'siglas' => 'MAR'
		]);

    }
}
