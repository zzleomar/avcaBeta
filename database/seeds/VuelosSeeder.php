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
                $x=random_int(1, 8);
                $y=random_int(1, 276);
                DB::table('piernas')->insert([
                    'aeronave_id' => $x,
                    'vuelo_id'    => $a->id,
                    'ruta_id'     => $y
                ]);
	       });

        /*factory(Vuelo::class, 100)->create()
            ->each(function ($a) {
                $x=random_int(1, 8);
                $y=random_int(1, 276);
                $a->piernas()->save(factory(App\Pierna::class)->make([
                    'aeronave_id' => $x,
                    'vuelo_id'    => $a->id,
                    'ruta_id'     => $y,
                     ])
                );
           });*/
    }
}
