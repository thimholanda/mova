<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificacaoPagamentoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_name;
    public $solicitacao_id;
    public $assunto;
    public $mensagem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_name, $solicitacao_id, $assunto, $mensagem)
    {
        $this->user_name = $user_name;
        $this->solicitacao_id = $solicitacao_id;
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@ziitbusiness.com.br')
                    ->subject('Status de pagamento de ' . $this->user_name)
                    ->view('emails.pagamento');
    }
}
