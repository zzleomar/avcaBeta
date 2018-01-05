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
            $table->integer('sueldo_base_id')->unsigned();
            $table->integer('personal_id')->unsigned();
            $table->integer('nomina_id')->unsigned();
            $table->integer('utilidad_id')->unsigned()->nullable();
            $table->integer('vacacion_id')->unsigned()->nullable();
            $table->integer('deduccion_id')->unsigned()->nullable();
            $table->integer('compensacion_id')->unsigned()->nullable();
            $table->integer('cesta_ticket_id')->unsigned()->nullable();


            $table->foreign('sueldo_base_id')->references('id')->on('sueldos_base')->onDelete('cascade');
            $table->foreign('personal_id')->references('id')->on('personal')->onDelete('cascade');
            $table->foreign('nomina_id')->references('id')->on('nominas')->onDelete('cascade');
            $table->foreign('utilidad_id')->references('id')->on('utilidades')->onDelete('cascade');
            $table->foreign('vacacion_id')->references('id')->on('vacaciones')->onDelete('cascade');
            $table->foreign('deduccion_id')->references('id')->on('deducciones')->onDelete('cascade');
            $table->foreign('compensacion_id')->references('id')->on('compensaciones')->onDelete('cascade');
            $table->foreign('cesta_ticket_id')->references('id')->on('cesta_tickets')->onDelete('cascade');

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
