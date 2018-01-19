<?php

use Illuminate\Database\Seeder;

class tabuladoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		  DB::table('tabuladores')->insert([
		    	'descripcion' => 'sueldo minimo',
		    	'digito' => '177507.44',
		    	'estado' => 'Activo'
		  ]);

		  DB::table('tabuladores')->insert([
		    	'descripcion' => 'bono compensacion',
		    	'digito' => '15.00',
		    	'estado' => 'Activo'
		  ]);

		  DB::table('tabuladores')->insert([
		    	'descripcion' => 'escala',
		    	'digito' => '1.07',
		    	'estado' => 'Activo'
		  ]);

		  DB::table('tabuladores')->insert([
		    	'descripcion' => 'constante',
		    	'digito' => '15.00',
		    	'estado' => 'Activo'
		  ]);

		  DB::table('tabuladores')->insert([
		    	'descripcion' => 'antiguedad',
		    	'digito' => '15.00',
		    	'estado' => 'Activo'
		  ]);

		  DB::table('tabuladores')->insert([
		    	'descripcion' => 'utilidad',
		    	'digito' => '90',
		    	'estado' => 'Activo'
		  ]);

		  DB::table('tabuladores')->insert([
		    	'descripcion' => 'vacaciones',
		    	'digito' => '45',
		    	'estado' => 'Activo'
		  ]);


		  DB::table('tabuladores')->insert([
		    	'descripcion' => 'cesta',
		    	'digito' => '31',
		    	'estado' => 'Activo'
		  ]);

		  DB::table('tabuladores')->insert([
		    	'descripcion' => 'unidad tributaria',
		    	'digito' => '300',
		    	'estado' => 'Activo'
		  ]);

        
    }
}
