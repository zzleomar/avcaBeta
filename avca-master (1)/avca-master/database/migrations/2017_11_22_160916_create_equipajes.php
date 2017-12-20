<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipajes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipajes', function (Blueprint $table) {
            $table->increments('id');
            $table->float('peso')->unsigned()->nullable();
            $table->float('costo_sobrepeso')->unsigned()->nullable();
            $table->integer('cantidad')->unsigned()->nullable();
            $table->integer('boleto_id')->unsigned()->nullable();
            $table->foreign('boleto_id')->references('id')->on('boletos')->onDelete('cascade');

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
        Schema::dropIfExists('equipajes');
    }
}
