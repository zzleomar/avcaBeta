<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(PasajerosSeeder::class);
        $this->call(HorariosTableSeeder::class);
        $this->call(AeronavesTableSeeder::class);
        $this->call(SucursalesTableSeeder::class);
        $this->call(RutasTableSeeder::class);
        $this->call(PersonalTableSeeder::class);       
        $this->call(VuelosSeeder::class);        
        $this->call(tabuladoresSeeder::class);        

        Model::reguard();
    }
} ?>
