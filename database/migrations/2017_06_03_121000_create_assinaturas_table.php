<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssinaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assinaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('rec_alocado_id')->unsigned();
            $table->foreign('rec_alocado_id')->references('id')->on('rec_alocados')->onDelete('cascade');
            $table->integer('usina_id')->unsigned();
            $table->foreign('usina_id')->references('id')->on('usinas')->onDelete('cascade');
            $table->string('tipo', 100);
            $table->tinyInteger('ativa')->unsigned()->default(1);
            $table->dateTime('validade');
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
        Schema::dropIfExists('assinaturas');
    }
}
