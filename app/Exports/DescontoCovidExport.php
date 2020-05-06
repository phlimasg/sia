<?php

namespace App\Exports;

use App\Model\Portal\PortalDescontoAutorizado;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class DescontoCovidExport implements FromCollection
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
        $desconto = PortalDescontoAutorizado::whereBetween('portal_desconto_autorizados.updated_at',[$dt_ini.' 00:00:00',$dt_fim.' 23:59:59'])
        ->join('portal_isencaos','portal_desconto_autorizados.portal_isencao_id','portal_isencaos.id')
        ->select('ra','percentual','status','portal_desconto_autorizados.updated_at')
        ->where('status','Deferido')
        ->orderBy('portal_desconto_autorizados.updated_at','asc')->get();
        $export[] = ['RA','NOME_ALUNO','TURMA','DESCONTO TOTAL DEFERIDO','RESPFIN'];
        
        foreach ($desconto as $i) {           
            $export[]=[                
                'RA' => $i->aluno->RA,
                'NOME_ALUNO' => $i->aluno->NOME_ALUNO,                
                'TURMA' => $i->aluno->TURMA,
                'DESCONTO TOTAL DEFERIDO' => $i->percentual.'%',
                'RESPFIN'=> $i->aluno->RESPFIN,                
            ];
        }
        $export = new Collection($export);
        return $export;
    }
}
