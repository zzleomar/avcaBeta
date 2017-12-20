<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRutas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->increments('id');
            $table->float('distancia',8,2);
            $table->string('siglas',10);
            $table->time('duracion');
            $table->float('tarifa_vuelo');
            $table->integer('destino_id')->unsigned()->nullable();
            $table->integer('origen_id')->unsigned()->nullable();
            //Laves Foreing
            $table->foreign('destino_id')->references('id')->on('sucursales')->onDelete('cascade');
            $table->foreign('origen_id')->references('id')->on('sucursales')->onDelete('cascade');
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
        Schema::dropIfExists('rutas');
    }
}
