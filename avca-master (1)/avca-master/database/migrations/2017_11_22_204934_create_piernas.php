<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiernas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piernas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aeronave_id')->unsigned()->nullable();
            $table->integer('vuelo_id')->unsigned()->nullable();
            $table->integer('ruta_id')->unsigned()->nullable();
            $table->foreign('aeronave_id')->references('id')->on('aeronaves')->onDelete('cascade');
            $table->foreign('vuelo_id')->references('id')->on('vuelos')->onDelete('cascade');
            $table->foreign('ruta_id')->references('id')->on('rutas')->onDelete('cascade');
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
        Schema::dropIfExists('piernas');
    }
}
