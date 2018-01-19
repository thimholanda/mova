<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('tipo');
            $table->mediumText('imagem')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('pagamento_status')->unsigned()->default(0);
            $table->string('pagamento_link', 255);
            $table->integer('aprovado')->unsigned()->default(0);
            $table->text('mensagem')->nullable();
            $table->integer('simulacao_id')->unsigned();
            $table->foreign('simulacao_id')->references('id')->on('simulacaos')->onDelete('cascade');
            $table->tinyInteger('ativa')->default(1);
            $table->tinyInteger('atualizada')->default(0);
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
        Schema::dropIfExists('solicitacaos');
    }
}
