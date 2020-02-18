<?php

namespace App\Exports;

use App\Model\AtividadesExtraclasse\ExtInscricao;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class InscricaoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function collection()
    {
        $dt_ini = date('Y-m-d', strtotime(str_replace('/','-',$this->request->ini)));
        $dt_fim = date('Y-m-d', strtotime(str_replace('/','-',$this->request->fim)));
        $inscricao = ExtInscricao::whereBetween('created_at',[$dt_ini.' 00:00:00',$dt_fim.' 23:59:59'])
        ->orderBy('ext_atv_turmas_id','asc')->orderBy('created_at','asc')->get();
        $export[] = ['RA','NOME_ALUNO','ATIVIDADE','TURMA','HORA DA INSCRICAO','VALOR'];
        
        foreach ($inscricao as $i) {           
            $export[]=[                
                'RA' => $i->aluno_id,
                'NOME_ALUNO' => $i->aluno->NOME_ALUNO,
                'ATIVIDADE' => $i->ExtAtvTurma->ExtAtv->atividade,
                'TURMA' => $i->ExtAtvTurma->descricao_turma,
                'HORA DA INSCRICAO' => $i->created_at,
                'VALOR' => 'R$ '.substr_replace($i->amount,',',-2,0),
            ];
        }
        $export = new Collection($export);
        return $export;
    }
}
