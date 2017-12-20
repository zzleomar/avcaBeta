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
            $table->string('tipo',255);
            $table->string('password',255);
            $table->string('email',40)->nullable();        
            $table->integer('administrativo_id')->unsigned();

            $table->rememberToken();
            $table->timestamps();
            $table->foreign('administrativo_id')->references('id')->on('administrativos')->onDelete('cascade');
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
