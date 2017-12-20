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
		    'siglas' => 'CCS'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Puerto Ayacucho',
		    'siglas' => 'PYH'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'San Tomé – Anzoátegui',
		    'siglas' => 'SOM'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'San Fernando de Apure',
		    'siglas' => 'SFD'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Maracay',
		    'siglas' => 'MYC'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Barinas',
		    'siglas' => 'BNS'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Ciudad Bolivar',
		    'siglas' => 'CBL'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Valencia',
		    'siglas' => 'VLN'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'San Carlos',
		    'siglas' => 'SCC'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Tucupita',
		    'siglas' => 'TUV'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Punto Fijo – Falcón',
		    'siglas' => 'LSP'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Barquisimeto',
		    'siglas' => 'BRM'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Maturín',
		    'siglas' => 'MUN'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Porlamar – Isla de Margarita',
		    'siglas' => 'PMV'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Acarigua - Portuguesa',
		    'siglas' => 'AGV'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Cumaná',
		    'siglas' => 'CUM'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'San Cristobal - Táchira',
		    'siglas' => 'SCI'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Trujillo',
		    'siglas' => 'VLV'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'San Felipe -Yaracuy',
		    'siglas' => 'SNF'
		]);
		$sucursal = factory(App\Sucursal::class)->create([
		    'nombre' => 'Maracaibo',
		    'siglas' => 'MAR'
		]);

    }
}
