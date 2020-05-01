<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailIsencaoTrocaStatus extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg,$isencao)
    {
        $this->msg = $msg;
        $this->isencao = $isencao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        $msg = $this->msg;
        $isencao = $this->isencao;
        return $this->view('mail.EmailIsencaoTrocaStatus', compact('msg','isencao'))
        ->subject('La Salle Abel - Atualização | Solicitação de Flexibilização de Parcelas')
        ->replyTo('atendimento.abel@lasalle.org.br');
    }
}
