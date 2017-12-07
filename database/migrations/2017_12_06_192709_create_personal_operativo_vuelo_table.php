<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalOperativoVueloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_operativo_vuelo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('personal_operativo_id')->unsigned()->nullable();
            $table->integer('vuelo_id')->unsigned()->nullable();

            $table->foreign('personal_operativo_id')->references('id')->on('personal_operativo')->onDelete('cascade');

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
        Schema::dropIfExists('personal_operativo_vuelo');
    }
}
