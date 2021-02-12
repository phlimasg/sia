<?php

namespace App\Observers;


use App\Jobs\SendMailJob;
use App\Model\Comunicados\comunicado;

class ComunicadosObserver
{
    /**
     * Handle the comunicado "created" event.
     *
     * @param  \App\Comunicados\comunicado  $comunicado
     * @return void
     */
    public function creating(comunicado $comunicado)
    {        
        //dd($comunicado->turmas);

        //SendMailJob::dispatch($comunicado);
    }

    /**
     * Handle the comunicado "updated" event.
     *
     * @param  \App\Comunicados\comunicado  $comunicado
     * @return void
     */
    public function updated(comunicado $comunicado)
    {
        //
    }

    /**
     * Handle the comunicado "deleted" event.
     *
     * @param  \App\Comunicados\comunicado  $comunicado
     * @return void
     */
    public function deleted(comunicado $comunicado)
    {
        //
    }

    /**
     * Handle the comunicado "restored" event.
     *
     * @param  \App\Comunicados\comunicado  $comunicado
     * @return void
     */
    public function restored(comunicado $comunicado)
    {
        //
    }

    /**
     * Handle the comunicado "force deleted" event.
     *
     * @param  \App\Comunicados\comunicado  $comunicado
     * @return void
     */
    public function forceDeleted(comunicado $comunicado)
    {
        //
    }
}
