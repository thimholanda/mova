<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Mail\SolicitacaoStatusMail;

class SolicitacaoStatus extends Notification
{
    use Queueable;

    public $nome;
    public $email;
    public $mensagem;

    /**
     * Create a new notification instance.
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
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {        
        return ( new SolicitacaoStatusMail($this->nome, $this->email, $this->mensagem) )->to($this->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
