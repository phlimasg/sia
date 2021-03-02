<?php

namespace App\Mail;

use App\Model\Comunicados\comunicado;
use App\Model\Totvs_alunos;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ComunicadoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(Totvs_alunos $totvs, comunicado $comunicado)
    {
        $this->totvs = $totvs;
        $this->comunicado = $comunicado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $comunicado = $this->comunicado;
        $totvs = $this->totvs;
        return $this->subject('La Salle Abel - '.$this->comunicado->titulo.' - '.$this->totvs->RA)
        ->replyTo('atendimento.abel@lasalle.org.br')
        ->view('mail.Comunicado')
        ->with(
            [
                'comunicado' => $comunicado,
                'totvs' => $totvs
            ]
        );
    }
}
