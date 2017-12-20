<?php

use Illuminate\Database\Seeder;
use App\Sucursal;
use App\Ruta;

class RutasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $siglas1=Sucursal::find(1)->siglas;
        $i=1;
        for ($j=2; $j < 20; $j++) { 
            $x=random_int(1, 9);
                $x=(($x/10)*470);
                if($x==0)
                {  $x=470;}

                $y=random_int(1, 9);
                $y=(($y/10)*5000);
                if($y==0)
                {    $y=5000;  }

                $siglas2=Sucursal::find($j)->siglas;
                $siglas=$siglas1."-".$siglas2;
                DB::table('rutas')->insert([
                    'distancia' => $x,
                    'tarifa_vuelo' => $y,
                    'duracion' => "00:40:00",
                    'siglas' => $siglas,
                    'destino_id' => $j,
                    'origen_id' => $i
                ]);
                $siglas=$siglas2."-".$siglas1;
                DB::table('rutas')->insert([
                    'distancia' => $x,
                    'tarifa_vuelo' => $y,
                    'duracion' => "00:40:00",
                    'siglas' => $siglas,
                    'destino_id' => $i,
                    'origen_id' => $j
                ]);
        }
 
        $ruta = new Ruta();
        for ($i=2; $i < 20; $i++) { 
        	for ($j=($i+1); $j < 21; $j++) { 

        		$x=random_int(1, 9);
			    $x=(($x/10)*470);
			    if($x==0)
			    {  $x=470;}

    			$y=random_int(1, 9);
			    $y=(($y/10)*5000);
		        if($y==0)
		        {    $y=5000;  }

                $siglas1=Sucursal::find($i)->siglas;
                $siglas2=Sucursal::find($j)->siglas;
                $siglas=$siglas1."-".$siglas2;
		    	DB::table('rutas')->insert([
				    'distancia' => $x,
                    'tarifa_vuelo' => $y,
	        		'duracion' => "00:40:00",
                    'siglas' => $siglas,
	        		'destino_id' => $j,
	    			'origen_id' => $i
		    	]);
        	}
        }
    }
}
