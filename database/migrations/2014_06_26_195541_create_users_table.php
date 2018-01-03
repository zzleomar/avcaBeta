<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',255);
            $table->enum('tipo',['Operador de Trafico','Subgerente de Sucursal','Gerente de Sucursales','Gerente General','Gerente de RRHH','Asistente de RRHH']);
            $table->string('password',255);
            $table->string('email',40)->nullable();        
            $table->integer('personal_id')->unsigned();

            $table->rememberToken();
            $table->timestamps();
            $table->foreign('personal_id')->references('id')->on('personal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
