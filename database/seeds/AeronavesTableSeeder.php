<?php

use Illuminate\Database\Seeder;

class AeronavesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Aeronave::class, 5)->create();
    }
}
