<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoletoExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boleto_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solicitacao_id')->unsigned();
            $table->foreign('solicitacao_id')->references('id')->on('solicitacaos')->onDelete('cascade');
            $table->decimal('valor', 9,2)->unsigned();
            $table->tinyInteger('status_pagamento')->default(0);
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
        Schema::dropIfExists('boleto_extras');
    }
}
