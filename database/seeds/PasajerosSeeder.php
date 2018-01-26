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
        factory(App\Pasajero::class, 170)->create();
        for($i=1;$i<40;$i++){
        	$idvuelo=random_int(1, 504);
        	$vuelo=Vuelo::find($idvuelo);
        	$actual=Carbon::now();
        	$carbonSalida=Carbon::parse($vuelo->salida);
            $idDia=random_int(3, ($carbonSalida->day-2));
        	if($carbonSalida->lt($actual)){
        		$estado="Chequeado";
        	}
        	else{
        		$estado="Pagado";
        	}
            $fecha=$carbonSalida->year."-".$carbonSalida->month."-".$idDia;
        	DB::table('boletos')->insert([
	            'estado' => $estado,
	            'pasajero_id' => $i,
	            'vuelo_id' => $idvuelo,
	            'asiento' => $i,
                'created_at' => $fecha,
	            'costo' => 180000
	        ]);
        }
        for($i=40;$i<51;$i++){
        	$idvuelo=random_int(1, 504);
        	$vuelo=Vuelo::find($idvuelo);
        	$carbonSalida=Carbon::parse($vuelo->salida);
            $idDia=random_int(3, ($carbonSalida->day-2));
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
                'created_at' => $carbonSalida->year."-".$carbonSalida->month."-".$idDia,
	            'costo' => 180000
	        ]);
        }

        for($i=51;$i<110;$i++){
            $idvuelo=random_int(361, 504);
            $vuelo=Vuelo::find($idvuelo);
            $carbonSalida=Carbon::parse($vuelo->salida);
            $idDia=random_int(3, ($carbonSalida->day-2));
            DB::table('boletos')->insert([
                'estado' => "Pagado",
                'pasajero_id' => $i,
                'vuelo_id' => $idvuelo,
                'asiento' => $i,
                'created_at' => $carbonSalida->year."-".$carbonSalida->month."-".$idDia,
                'costo' => 180000
            ]);
        }

        for($i=111;$i<151;$i++){
            $idvuelo=random_int(400, 504);
            $vuelo=Vuelo::find($idvuelo);
            $carbonSalida=Carbon::parse($vuelo->salida);
            $idDia=random_int(3, ($carbonSalida->day-2));
            DB::table('boletos')->insert([
                'estado' => "Reservado",
                'pasajero_id' => $i,
                'vuelo_id' => $idvuelo,
                'asiento' => $i,
                'created_at' => $carbonSalida->year."-".$carbonSalida->month."-".$idDia,
                'costo' => 180000
            ]);
        }

        for($i=151;$i<158;$i++){
            $idvuelo=412;
            $vuelo=Vuelo::find($idvuelo);
            $carbonSalida=Carbon::parse($vuelo->salida);
            $idDia=random_int(3, ($carbonSalida->day-2));
            DB::table('boletos')->insert([
                'estado' => "Pagado",
                'pasajero_id' => $i,
                'vuelo_id' => $idvuelo,
                'asiento' => $i,
                'created_at' => $carbonSalida->year."-".$carbonSalida->month."-".$idDia,
                'costo' => 180000
            ]);
        }
        for($i=158;$i<162;$i++){
            $idvuelo=412;
            $vuelo=Vuelo::find($idvuelo);
            $carbonSalida=Carbon::parse($vuelo->salida);
            $idDia=random_int(3, ($carbonSalida->day-2));
            DB::table('boletos')->insert([
                'estado' => "Reservado",
                'pasajero_id' => $i,
                'vuelo_id' => $idvuelo,
                'asiento' => $i,
                'created_at' => $carbonSalida->year."-".$carbonSalida->month."-".$idDia,
                'costo' => 180000
            ]);
        }

        for($i=162;$i<164;$i++){
            $idvuelo=460;
            $vuelo=Vuelo::find($idvuelo);
            $carbonSalida=Carbon::parse($vuelo->salida);
            $idDia=random_int(3, ($carbonSalida->day-2));
            DB::table('boletos')->insert([
                'estado' => "Reservado",
                'pasajero_id' => $i,
                'vuelo_id' => $idvuelo,
                'asiento' => $i,
                'created_at' => $carbonSalida->year."-".$carbonSalida->month."-".$idDia,
                'costo' => 180000
            ]);
        }
        for($i=164;$i<171;$i++){
            $idvuelo=460;
            $vuelo=Vuelo::find($idvuelo);
            $carbonSalida=Carbon::parse($vuelo->salida);
            $idDia=random_int(3, ($carbonSalida->day-2));
            DB::table('boletos')->insert([
                'estado' => "Pagado",
                'pasajero_id' => $i,
                'vuelo_id' => $idvuelo,
                'asiento' => $i,
                'created_at' => $carbonSalida->year."-".$carbonSalida->month."-".$idDia,
                'costo' => 180000
            ]);
        }
    }
}
