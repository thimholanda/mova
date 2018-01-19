<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DefinePasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $token;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $token, $email)
    {
        $this->nome = $nome;
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@ziitbusiness.com.br')
                    ->subject($this->nome . ', bem-vindo(a) ao Mova')
                    ->view('emails.define-password');
    }
}
