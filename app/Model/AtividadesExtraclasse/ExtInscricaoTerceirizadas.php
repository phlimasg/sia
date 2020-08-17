<?php

namespace App\Model\AtividadesExtraclasse;

use App\Getnet\GetnetReturn;
use App\Model\Totvs_alunos;
use Illuminate\Database\Eloquent\Model;

class ExtInscricaoTerceirizadas extends Model
{
    public function ExtAtvTurma()
    {
        return $this->hasOne(ExtAtvTurma::class,'id','ext_atv_turmas_id');
    }
    public function aluno()
    {
        return $this->hasOne(Totvs_alunos::class,'RA','aluno_id')->select('NOME_ALUNO','RA','TURMA','RESPACAD','RESPACADEMAIL','RESPACADTEL1','RESPACADTEL2','RESPFIN','RESPFINEMAIL','RESPFINTEL1','RESPFINCEL');
    }
    public function getnet()
    {
        return $this->hasOne(GetnetReturn::class,'ext_inscricaos_id','id');
    }
}
