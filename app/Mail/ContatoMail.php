<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\ContatoMail;

class ContatoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $email;
    public $assunto;
    public $mensagem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $email, $assunto, $mensagem)
    {
        $this->nome = $nome;
        $this->email = $email;
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
                    ->subject('Nova mensagem de ' . $this->nome)
                    ->view('emails.contato');
    }
}
