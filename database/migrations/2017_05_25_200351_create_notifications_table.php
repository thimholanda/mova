<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {

            $table->increments('id');

            $table->string('title', 255);
            $table->text('text');

            $table->timestamps();
        });

        DB::table('notifications')->insert([
            [
                'title' => 'ativar_premium',
                'text' => '<strong>ative sua conta</strong> para acessar todos os produtos pelo período de 1 ano',
            ]
        ]);

        DB::table('notifications')->insert([
            [
                'title' => 'solicitacao_reprovada',
                'text' => '<strong>Sua solicitação foi reprovada.</strong> Acesse "Minha Conta" para revisar as informações',
            ]
        ]);

        DB::table('notifications')->insert([
            [
                'title' => 'solicitacao_aprovada',
                'text' => '<strong>Sua solicitação foi aprovada.</strong> Acesse "Minha Conta" para escolher a energia',
            ]
        ]);

        DB::table('notifications')->insert([
            [
                'title' => 'solicitacao_enviada',
                'text' => '<strong>Sua solicitação foi enviada.</strong> Você será notificado por e-mail assim que for auditada.',
            ]
        ]);

        DB::table('notifications')->insert([
            [
                'title' => 'conta_ativada',
                'text' => '<strong>Sua conta Premium foi ativada</strong> com sucesso! Parabéns por incentivar a utilização de energia renovável',
            ]
        ]);

        DB::table('notifications')->insert([
            [
                'title' => 'mensagem',
                'text' => '<strong>A resposta para sua mensagem</strong> está disponível. Acesse o menu "Contato" para visualizá-la.',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
