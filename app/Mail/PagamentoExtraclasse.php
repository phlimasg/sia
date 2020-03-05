<?php

namespace App\Mail;

use App\Model\AtividadesExtraclasse\ExtInscricao;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class PagamentoExtraclasse extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ExtInscricao $inscricao)
    {
        $this->inscricao = $inscricao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        //dd($this->inscricao->ExtAtvTurma->ExtAtv);
        $inscricao = $this->inscricao;
        return $this->from('sendmail@abel.org.br')
        ->subject('Inscrição na atividade: '.$this->inscricao->ExtAtvTurma->ExtAtv->atividade)->view('mail.MailPagamento',compact('inscricao'));
    }
}
