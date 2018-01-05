<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemoradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demorados', function (Blueprint $table) {
            $table->increments('id');
            $table->time('demora');
            $table->timestamp('salida_demorada');
            $table->integer('vuelo_id')->unsigned()->nullable();
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
        Schema::dropIfExists('demorados');
    }
}
