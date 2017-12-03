<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVueloTripulanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuelo_tripulante', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('tripulante_id')->unsigned()->nullable();
            $table->integer('vuelo_id')->unsigned()->nullable();

            $table->foreign('tripulante_id')->references('id')->on('personal_operativo')->onDelete('cascade');

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
        Schema::dropIfExists('vuelo_tripulante');
    }
}
