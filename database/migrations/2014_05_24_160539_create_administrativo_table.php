<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministrativoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrativos', function (Blueprint $table) {
            $table->increments('id');
            $table->time('horas_laboradas')->nullable();
            $table->time('horas_extras')->nullable();
            $table->string('cargo',255);
            $table->integer('personal_id')->unsigned()->nullable();
            //$table->integer('user_id')->unsigned()->nullable();
            $table->integer('horario_id')->unsigned()->nullable();
            $table->integer('sucursal_id')->unsigned()->nullable();
            
            $table->foreign('sucursal_id')->references('id')->on('sucursales')->onDelete('cascade');
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('personal_id')->references('id')->on('personal')->onDelete('cascade');
            $table->foreign('horario_id')->references('id')->on('horarios')->onDelete('cascade');
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
        Schema::dropIfExists('administrativos');
    }
}
