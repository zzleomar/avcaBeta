<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCestaTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cesta_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dias')->unsigned();
            $table->float('monto');
            $table->integer('personal_id')->unsigned();
            $table->foreign('personal_id')->references('id')->on('personal')->onDelete('cascade');
            $table->integer('unidadTributario_id')->unsigned()->nullable();

            $table->foreign('unidadTributario_id')->references('id')->on('tabuladores')->onDelete('cascade');
            
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
        Schema::dropIfExists('cesta_tickets');
    }
}
