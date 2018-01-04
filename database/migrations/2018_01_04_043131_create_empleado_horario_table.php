<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoHorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_horario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empleado_id')->unsigned()->nullable();
            $table->integer('horario_id')->unsigned()->nullable();

            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');

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
        Schema::dropIfExists('empleado_horario');
    }
}
