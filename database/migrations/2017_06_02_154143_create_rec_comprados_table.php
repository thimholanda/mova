<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecCompradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rec_comprados', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('quantidade')->unsigned();
            $table->integer('usina_id')->unsigned();
            $table->foreign('usina_id')->references('id')->on('usinas')->onDelete('cascade');
            $table->bigInteger('saldo')->unsigned();
            $table->tinyInteger('ativo')->unsigned()->default(1);
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
        Schema::dropIfExists('rec_comprados');
    }
}
