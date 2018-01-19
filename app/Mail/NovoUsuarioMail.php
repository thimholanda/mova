<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovoUsuarioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $senha;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $senha)
    {
        $this->user = $user;
        $this->senha = $senha;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@ziitbusiness.com.br')
                    ->subject('Olá '.$this->user->name.', utilize estes dados para acessar o painel do Mova')
                    ->view('emails.novo-usuario');
    }
}
