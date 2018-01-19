<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RespostaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $mensagem_original;
    public $assunto;
    public $mensagem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $mensagem_original, $assunto, $mensagem)
    {
        $this->nome = $nome;
        $this->mensagem_original = $mensagem_original;
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
                    ->subject('Olá '.$this->nome.', respondemos sua mensagem!')
                    ->view('emails.resposta');
    }
}
