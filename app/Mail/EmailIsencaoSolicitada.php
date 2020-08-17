<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailIsencaoSolicitada extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = $this->url;
        return $this->view('mail.EmailIsencaoSolicitada', compact('url'))
        ->subject('La Salle Abel - Solicitação de Flexibilização de Parcelas')
        ->replyTo('atendimento.abel@lasalle.org.br');
    }
}
