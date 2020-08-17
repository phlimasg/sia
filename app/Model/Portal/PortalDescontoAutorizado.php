<?php

namespace App\Model\Portal;

use App\Model\Totvs_alunos;
use Illuminate\Database\Eloquent\Model;

class PortalDescontoAutorizado extends Model
{
    protected $fillable = ['ra', 
        'percentual',
        'portal_isencao_id',
        'user_id',
    ];

    public function aluno()
    {
        return $this->hasOne(Totvs_alunos::class, 'RA','ra')->select('RA','NOME_ALUNO','RESPFIN','TURMA');
    }
}
