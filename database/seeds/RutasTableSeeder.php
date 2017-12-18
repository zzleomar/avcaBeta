<?php

use Illuminate\Database\Seeder;
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
 
        $ruta = new Ruta();
        for ($i=1; $i < 24; $i++) { 
        	for ($j=($i+1); $j < 25; $j++) { 

        		$x=random_int(1, 9);
			    $x=(($x/10)*470);
			    if($x==0)
			    {  $x=470;}

    			$y=random_int(1, 9);
			    $y=(($y/10)*5000);
		        if($y==0)
		        {    $y=5000;  }

		    	DB::table('rutas')->insert([
				    'distancia' => $x,
                    'tarifa_vuelo' => $y,
	        		'duracion' => "00:40:00",
	        		'destino_id' => $j,
	    			'origen_id' => $i
		    	]);
        	}
        }
    }
}
