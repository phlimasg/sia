<?php

namespace App\Exports;

use App\Model\AtividadesExtraclasse\ExtInscricao;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class InscritosExtTurmaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($turma)
    {
        $this->turma = $turma;
    }
    public function collection()
    {
        
        $inscricao = ExtInscricao::where('ext_atv_turmas_id', $this->turma)
        ->orderBy('ext_atv_turmas_id','asc')->orderBy('created_at','asc')->get();
        $export[] = ['RA','NOME_ALUNO','ATIVIDADE','TURMA','TURMA DO ALUNO','HORA DA INSCRICAO','VALOR','RESPONSAVEL','EMAIL'];
        
        foreach ($inscricao as $i) {           
            $export[]=[                
                'RA' => $i->aluno_id,
                'NOME_ALUNO' => $i->aluno->NOME_ALUNO,
                'ATIVIDADE' => $i->ExtAtvTurma->ExtAtv->atividade,
                'TURMA' => $i->ExtAtvTurma->descricao_turma,
                'TURMA DO ALUNO' => $i->aluno->TURMA,
                'HORA DA INSCRICAO' => $i->created_at,
                'VALOR' => 'R$ '.substr_replace($i->amount,',',-2,0),
                'RESPONSAVEL'=> $i->aluno->RESPACAD,
                'EMAIL'=> $i->aluno->RESPACADEMAIL,
            ];
        }
        $export = new Collection($export);
        return $export;
    }
}
