<?php

use Illuminate\Database\Seeder;

class PasajerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Pasajero::class, 25)->create();
    }
}
