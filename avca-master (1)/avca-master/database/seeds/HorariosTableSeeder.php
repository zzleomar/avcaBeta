<?php

use Illuminate\Database\Seeder;

class HorariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('horarios')->insert([
            'entrada' => '08:00:00',
            'salida'  => '16:00:00'
        ]);
        DB::table('horarios')->insert([
            'entrada' => '07:00:00',
            'salida'  => '18:00:00'
        ]);
        DB::table('horarios')->insert([
            'entrada' => '15:00:00',
            'salida'  => '20:00:00'
        ]);
        DB::table('horarios')->insert([
            'entrada' => '07:00:00',
            'salida'  => '20:00:00'
        ]);
    }
}
