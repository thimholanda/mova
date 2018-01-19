<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolicitacaoStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $email;
    public $mensagem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $email, $mensagem)
    {
        $this->nome = $nome;
        $this->email = $email;
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
                    ->subject($this->nome . ', temos novidades sobre a solicitação')
                    ->view('emails.status-solicitacao');
    }
}
