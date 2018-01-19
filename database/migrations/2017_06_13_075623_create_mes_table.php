<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mes', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('descricao');
            $table->decimal('kwh', 9,2)->unsigned();
            $table->decimal('base_calculo', 9,2)->unsigned();
            $table->decimal('valor_retificado', 9,2)->unsigned()->nullable();
            $table->mediumText('imagem')->nullable();
            $table->longText('mensagem')->nullable();
            $table->tinyInteger('aprovado')->unsigned()->default(0);
            $table->tinyInteger('atualizado')->unsigned()->default(0);
            $table->tinyInteger('ativo')->unsigned()->default(0);
            $table->integer('solicitacao_id')->unsigned();
            $table->foreign('solicitacao_id')->references('id')->on('solicitacaos')->onDelete('cascade');
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
        Schema::dropIfExists('mes');
    }
}
