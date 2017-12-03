<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoletosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletos', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('estado',['Reservado','Pagado','Chequiado','Cancelado','Temporal']);
            $table->integer('asiento')->unsigned()->nullable();
            $table->float('costo')->nullable();
            $table->integer('pasajero_id')->unsigned()->nullable();
            $table->integer('vuelo_id')->unsigned()->nullable();
            

            $table->foreign('pasajero_id')->references('id')->on('pasajeros')->onDelete('cascade');
            $table->foreign('vuelo_id')->references('id')->on('vuelos')->onDelete('cascade');
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
        Schema::dropIfExists('boletos');
    }
}
