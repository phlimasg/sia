<?php

namespace App\Mail;

use App\Model\AtividadesExtraclasse\ExtAtvEsperaAutorizada;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AutorizaListaDeEspera extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ExtAtvEsperaAutorizada $autoriza)
    {
        $this->autoriza = $autoriza;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $autoriza = $this->autoriza;
        return $this->from('sendmail@abel.org.br')
        ->subject('Lista de Espera: '.$this->autoriza->ExtAtvListaDeEspera->ExtAtvTurma->ExtAtv->atividade)->view('mail.AutorizaEspera',compact('autoriza'));
    }
}
