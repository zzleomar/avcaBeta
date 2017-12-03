<?php

use Illuminate\Database\Seeder;
use App\Personal;

class PersonalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Personal::class, 24)->create()
            ->each(function ($a) {
	           $a->administrativo()->save(factory(App\Administrativo::class)->make([
                     'sucursal_id' => $a->id,
    			     'cargo' => 'Subgerente de Sucursal',
			         ])
                );
               $a->administrativo->user()->save(factory(App\User::class)->make([
                            'tipo' => 'Subgerente de Sucursal',
                        ])
                );
	       });

	    factory(Personal::class, 24)->create()
            ->each(function ($u) {
               $u->administrativo()->save(factory(App\Administrativo::class)->make([
                        'sucursal_id' => ($u->id-24),
                        'cargo' => 'Asistente de Trafico',
                        ])
                );
                $u->administrativo->user()->save(factory(App\User::class)->make([
                                'tipo' => 'Operador',
                            ])
                    );
             });

        factory(Personal::class, 10)->create()
            ->each(function ($u) {
               $u->personal_operativo()->save(factory(App\Personal_operativo::class)->make([
                        'rango' => 'Piloto',
                        ])
                );
             });
        factory(Personal::class, 12)->create()
            ->each(function ($u) {
               $u->personal_operativo()->save(factory(App\Personal_operativo::class)->make([
                        'rango' => 'Copiloto',
                        ])
                );
             });
        factory(Personal::class, 42)->create()
            ->each(function ($u) {
               $u->personal_operativo()->save(factory(App\Personal_operativo::class)->make([
                        'rango' => 'Sobrecargo',
                        ])
                );
             });
    }
}
