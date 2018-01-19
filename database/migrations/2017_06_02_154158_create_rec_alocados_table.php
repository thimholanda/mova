<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecAlocadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rec_alocados', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('quantidade')->unsigned();
            $table->integer('usina_id')->unsigned();
            $table->foreign('usina_id')->references('id')->on('usinas')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('rec_comprado_id')->unsigned();
            $table->foreign('rec_comprado_id')->references('id')->on('rec_comprados')->onDelete('cascade');
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
        Schema::dropIfExists('rec_alocados');
    }
}
