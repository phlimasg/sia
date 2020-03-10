<?php

namespace App\Model\AtividadesExtraclasse;

use App\Model\Totvs_alunos;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ExtAtvListaDeEspera extends Model
{
    public function ExtAtvTurma()
    {
        return $this->hasOne(ExtAtvTurma::class,'id','ext_atv_turmas_id');
    }
    public function aluno()
    {
        return $this->hasOne(Totvs_alunos::class,'RA','aluno_id')->select('NOME_ALUNO','RA','TURMA','RESPACAD','RESPACADEMAIL','RESPACADTEL1','RESPACADTEL2','RESPFIN','RESPFINEMAIL','RESPFINTEL1','RESPFINCEL');
    }
    public function ExtAtvListaDeEsperaAutorizada()
    {
        return $this->hasOne(ExtAtvEsperaAutorizada::class,'ext_atv_lista_de_esperas_id','id')->orderBy('created_at','desc');
    }
    public function User()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
