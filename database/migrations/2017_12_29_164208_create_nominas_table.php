<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fecha');
            $table->float('monto_sueldos',12,2)->nullable();
            $table->float('monto_compensacion',12,2)->nullable();
            $table->float('monto_deducciones',12,2)->nullable();
            $table->float('monto_antiguedad',12,2)->nullable();
            $table->float('monto_utilidades',12,2)->nullable();
            $table->float('monto_vacaciones',12,2)->nullable();
            $table->float('monto_cesta_tickets',12,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nominas');
    }
}
