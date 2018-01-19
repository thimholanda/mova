<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_empresa',100)->unique();
            $table->string('nome_empresa',100);
            $table->string('nome_responsavel',100);
            $table->string('endereco',100)->nullable();
            $table->integer('numero')->unsigned()->nullable();
            $table->string('complemento',50)->nullable();
            $table->string('bairro',100)->nullable();
            $table->string('telefone',30)->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_infos');
    }
}
