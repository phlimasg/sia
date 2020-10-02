<?php

namespace App\Mail;

use App\Model\Inscricao\Candidato;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InscricaoListaDeEsperaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Candidato $candidato)
    {
        $this->candidato = $candidato;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('La Salle Abel - Lista de espera')
        ->replyTo('atendimento.abel@lasalle.org.br')
        ->view('mail.EmailListaDeEspera',[
            'candidato' => $this->candidato
        ]);
    }
}
