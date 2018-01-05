<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouches', function (Blueprint $table) {
            $table->increments('id');
            $table->float('sueldo_base')->unsigned();
            $table->integer('personal_id')->unsigned();
            $table->integer('nomina_id')->unsigned()->nullable();
            $table->float('utilidad')->unsigned()->nullable();
            $table->float('vacacion')->unsigned()->nullable();
            $table->float('deduccion')->unsigned()->nullable();
            $table->float('compensacion')->unsigned()->nullable();
            $table->float('antiguedad')->unsigned()->nullable();
            $table->time('ausencias')->nullable();

            $table->integer('sueldoMinimo_id')->unsigned()->nullable();
            $table->integer('escala_id')->unsigned()->nullable();
            $table->integer('antiguedad_id')->unsigned()->nullable();
            $table->integer('compensacion_id')->unsigned()->nullable();
            $table->integer('constante_id')->unsigned()->nullable();



            $table->foreign('personal_id')->references('id')->on('personal')->onDelete('cascade');
            $table->foreign('nomina_id')->references('id')->on('nominas')->onDelete('cascade');

            $table->foreign('sueldoMinimo_id')->references('id')->on('tabuladores')->onDelete('cascade');
            $table->foreign('escala_id')->references('id')->on('tabuladores')->onDelete('cascade');
            $table->foreign('antiguedad_id')->references('id')->on('tabuladores')->onDelete('cascade');
            $table->foreign('compensacion_id')->references('id')->on('tabuladores')->onDelete('cascade');
            $table->foreign('constante_id')->references('id')->on('tabuladores')->onDelete('cascade');


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
        Schema::dropIfExists('vouches');
    }
}
