<?php

use Illuminate\Database\Seeder;
use App\Vuelo;
use Carbon\Carbon;

class PasajerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Pasajero::class, 150)->create();
        for($i=1;$i<40;$i++){
        	$idvuelo=random_int(1, 504);
        	$vuelo=Vuelo::find($idvuelo);
        	$actual=Carbon::now();
        	$carbonSalida=Carbon::parse($vuelo->salida);
        	if($carbonSalida->lt($actual)){
        		$estado="Chequeado";
        	}
        	else{
        		$estado="Pagado";
        	}
        	DB::table('boletos')->insert([
	            'estado' => $estado,
	            'pasajero_id' => $i,
	            'vuelo_id' => $idvuelo,
	            'asiento' => $i,
	            'costo' => 180000
	        ]);
        }
        for($i=40;$i<51;$i++){
        	$idvuelo=random_int(1, 504);
        	$vuelo=Vuelo::find($idvuelo);
        	$actual=Carbon::now();
        	$carbonSalida=Carbon::parse($vuelo->salida);
        	if($carbonSalida->lt($actual)){
        		$estado="Chequeado";
        	}
        	else{
        		$estado="Reservado";
        	}
        	DB::table('boletos')->insert([
	            'estado' => $estado,
	            'pasajero_id' => $i,
	            'vuelo_id' => $idvuelo,
	            'asiento' => $i,
	            'costo' => 180000
	        ]);
        }

        for($i=51;$i<110;$i++){
            $idvuelo=random_int(361, 504);
            $vuelo=Vuelo::find($idvuelo);
            $actual=Carbon::now();
            $carbonSalida=Carbon::parse($vuelo->salida);
            DB::table('boletos')->insert([
                'estado' => "Pagado",
                'pasajero_id' => $i,
                'vuelo_id' => $idvuelo,
                'asiento' => $i,
                'costo' => 180000
            ]);
        }

        for($i=111;$i<151;$i++){
            $idvuelo=random_int(400, 504);
            $vuelo=Vuelo::find($idvuelo);
            $actual=Carbon::now();
            $carbonSalida=Carbon::parse($vuelo->salida);
            DB::table('boletos')->insert([
                'estado' => "Reservado",
                'pasajero_id' => $i,
                'vuelo_id' => $idvuelo,
                'asiento' => $i,
                'costo' => 180000
            ]);
        }
    }
}
