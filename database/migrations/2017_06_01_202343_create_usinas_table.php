<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usinas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 255);
            $table->date('inicio_operacao');
            $table->string('fonte_energia', 100);
            $table->text('endereco');
            $table->decimal('lat', 10,8);
            $table->decimal('lng', 11,8);
            $table->bigInteger('recs_disponiveis')->unsigned()->default(0);
            $table->tinyInteger('ativa')->unsigned()->default(1);
            $table->tinyInteger('prioridade')->unsigned();
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
        Schema::dropIfExists('usinas');
    }
}
