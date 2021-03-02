<?php

namespace App\Jobs;

use App\Mail\AutorizaListaDeEspera;
use App\Mail\ComunicadoMail;
use App\Model\Comunicados\comunicado;
use App\Model\Totvs_alunos;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     private $totvs;
     private $comunicado;

    public function __construct(Totvs_alunos $totvs, comunicado $comunicado)
    {
        $this->totvs = $totvs;
        $this->comunicado = $comunicado;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->totvs->RESPFINEMAIL)
            ->cc($this->totvs->RESPACADEMAIL)            
            //Mail::to('raphael.oliveira@lasalle.org.br')
            ->send(new ComunicadoMail($this->totvs, $this->comunicado));
    }
}
