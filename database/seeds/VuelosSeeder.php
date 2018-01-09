<?php

use Illuminate\Database\Seeder;
use App\Vuelo;

class VuelosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Vuelo::class, 100)->create()
            ->each(function ($a) {
                $x=random_int(1, 5);
                $y=random_int(1, 207);
                DB::table('piernas')->insert([
                    'aeronave_id' => $x,
                    'vuelo_id'    => $a->id,
                    'ruta_id'     => $y
                ]);
	       });
            //CREAR UN VUELO
       /* factory(Vuelo::class, 1)->create([
                    'salida'      => '2017-01-01 18:00:00',
                    'estado'      => 'abierto' //ejecutado //cancelado
            ])
            ->each(function ($a){
                $a->
                DB::table('piernas')->insert([
                    'aeronave_id' => '1',
                    'vuelo_id'    => $a->id,
                    'ruta_id'     => '1'
                ]);
                DB::table('tripulante_vuelo')->insert([
                    'tripulante_id' => '2',
                    'vuelo_id'      => $a->id
                ]);
                DB::table('tripulante_vuelo')->insert([
                    'tripulante_id' => '13',
                    'vuelo_id'      => $a->id
                ]);
                DB::table('tripulante_vuelo')->insert([
                    'tripulante_id' => '30',
                    'vuelo_id'      => $a->id
                ]);
                DB::table('tripulante_vuelo')->insert([
                    'tripulante_id' => '37',
                    'vuelo_id'      => $a->id
                ]);
                DB::table('tripulante_vuelo')->insert([
                    'tripulante_id' => '44',
                    'vuelo_id'      => $a->id
                ]);
                DB::table('tripulante_vuelo')->insert([
                    'tripulante_id' => '60',
                    'vuelo_id'      => $a->id
                ]);
           }); */
    }
}
