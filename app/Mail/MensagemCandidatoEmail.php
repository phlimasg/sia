<?php

namespace App\Mail;

use App\Model\Inscricao\Candidato;
use App\Model\Inscricao\Mensagem;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MensagemCandidatoEmail extends Mailable
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
        return $this->view('mail.EmailMensagemCandidato',[
            'candidato' => $this->candidato,
        ])->replyTo('secretaria.abel@lasalle.org.br')->subject('La Salle Abel - Falta de documento');
    }
}
