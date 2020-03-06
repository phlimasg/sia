<?php

namespace App\Exports;

use App\Model\AtividadesExtraclasse\ExtAtvListaDeEspera;
use App\Model\Totvs_alunos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class ListaDeEspera implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //$espera = ExtAtvListaDeEspera::whereNotin('aluno_id',Totvs_alunos::select('RA')->get())->get();
        


        $espera =  ExtAtvListaDeEspera::orderBy('ext_atv_turmas_id','asc')->orderBy('created_at','asc')->get();        
        $export[] = ['POSICAO','RA','NOME_ALUNO','ATIVIDADE','TURMA','HORA DA INSCRICAO'];
        $posicao = 1;
        $aux = null;
        foreach ($espera as $i) {
            
            if($i->ext_atv_turmas_id != $aux){
                $posicao = 1;
            }
            //dd($i->aluno->NOME_ALUNO);
            $export[]=[
                'POSICAO' => $posicao,
                'RA' => $i->aluno_id,
                'NOME_ALUNO' => $i->aluno->NOME_ALUNO,
                'ATIVIDADE' => $i->ExtAtvTurma->ExtAtv->atividade,
                'TURMA' => $i->ExtAtvTurma->descricao_turma,
                'HORA DA INSCRICAO' => $i->created_at,
            ];
            
            $aux = $i->ext_atv_turmas_id;
            $posicao++;

        }        
        $export = new Collection($export);
        return $export;
    }
}
