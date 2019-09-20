<?php

namespace App\Exports;

use App\Model\Catraca;
use App\Model\Totvs_alunos;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Illuminate\Support\Collection;

class CatracaExport implements FromCollection
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
        $turmas = ['A','B','C','D','E','F','G','H','I','J'];
        $escolaridade=[];
            if ($this->request->escolaridade == 'EFER') {
                for ($i=1; $i <=5; $i++) {
                    foreach ($turmas as $t) {
                        $escolaridade[] .= 'EFER0'.$i.'A.'.$t;                        
                    }                     
                }
                $totvs = Totvs_alunos::selectRaw('cast([RA] as bigint)')->whereIn('TURMA', $escolaridade)->get();
            }elseif($this->request->escolaridade == 'EFERII'){
                for ($i=6; $i <=9; $i++) {
                    foreach ($turmas as $t) {
                        $escolaridade[] .= 'EFER0'.$i.'A.'.$t;                        
                    }                     
                }
                $totvs = Totvs_alunos::selectRaw('cast([RA] as bigint)')->whereIn('TURMA', $escolaridade)->get();                
            }
            else {
                $totvs = Totvs_alunos::selectRaw('cast([RA] as bigint)')->where('TURMA','like',$this->request->escolaridade.'%')->get();
            }
            
           $dateini =  date('d/m/Y', strtotime($this->request->dt_ini)).' '.date('H:i:s', strtotime($this->request->hr_ini));
           $datefim =  date('d/m/Y', strtotime($this->request->dt_fim)).' '.date('H:i:s', strtotime($this->request->hr_fim));
           
           $relatorio = Totvs_alunos::select('RA','NOME_ALUNO','ANO','TURMA')
           ->whereIn(DB::raw('cast([RA] as bigint)'),
                Catraca::whereBetween('mov_datahora',[$dateini,$datefim])
                ->select('PES_NUMERO')
                ->whereRaw('LEN(PES_NUMERO) = 5')
                ->where('MOV_ENTRADASAIDA',1)
                ->whereIn('PES_NUMERO',$totvs)
                ->get()
           )
           ->orderBy('ANO')
           ->orderBy('TURMA')
           ->orderBy('NOME_ALUNO')           
           ->get();
           $catraca = Catraca::whereBetween('mov_datahora',[$dateini,$datefim])
                ->select('MOV_DATAHORA','PES_NUMERO')
                ->whereRaw('LEN(PES_NUMERO) = 5')
                ->where('MOV_ENTRADASAIDA',1)
                ->whereIn('PES_NUMERO',$totvs)
                ->orderBy('MOV_DATAHORA')
                ->get();
            //dd($catraca);

            $collArray[] = ['RA','NOME_ALUNO','ANO','TURMA','HORA_DA_ENTRADA'];            
            
            foreach ($relatorio as $i) {
                foreach ($catraca as $c) {
                    if($i->RA == $c->PES_NUMERO)
                    $collArray[] = [
                        'RA' =>$i->RA,
                        'NOME_ALUNO' => $i->NOME_ALUNO,
                        'ANO' => $i->ANO,
                        'TURMA' =>$i->TURMA,
                        'MOV_DATAHORA' => date("d/m/Y H:i:s", strtotime($c->MOV_DATAHORA)),

                    ];
                }
            }
            $collection = new Collection($collArray);
            return $collection;
        
    }
}
