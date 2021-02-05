<?php

namespace App\Exports;

use App\Model\Totvs_alunos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class GerarLeads implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $cabecalho =  Totvs_alunos::selectRaw('respacademail,count(*) as QTD')->groupBy('respacademail')->orderBy('QTD', 'desc')->first();
        $leads = Totvs_alunos::select('RA', 'NOME_ALUNO', 'ANO', 'TURMA', 'RESPACAD', 'RESPACADEMAIL', 'RESPFIN', 'RESPFINEMAIL', 'EMAIL_ALUNO', 'TURNO_ALUNO')
            ->whereNotNull('RESPACADEMAIL')
            ->orderBy('RESPACADEMAIL')
            //->limit(100)
            ->get();

        $export[] = ['NOME', 'EMAIL', 'FIN_NOME', 'FIN_EMAIL', 'ANO_VIGENTE'];
        for ($i = 1; $i <= $cabecalho->QTD; $i++) {
            array_push(
                $export[0],
                'ALUNO_' . $i . '_RA',
                'ALUNO_' . $i . '_NOME',
                'ALUNO_' . $i . '_EMAIL',
                'ALUNO_' . $i . '_TURMA',
                'ALUNO_' . $i . '_ANO',
                'ALUNO_' . $i . '_TURNO'
            );
        }

        $last_email = null;
        $last_i = 0;
        $aux = 1;

        for ($i = 0; $i < sizeof($leads); $i++) {
            if (strcmp($last_email, $leads[$i]->RESPACADEMAIL) != 0 && $i != 0)
                $last_i++;
            //echo strcmp($last_email, $leads[$i]->RESPACADEMAIL) . ' -  Last I: ' . $last_i . ' - Last Email: ' . $last_email . ' - Atual ' . $leads[$i]->RESPACADEMAIL . '<br/>';

            if (strcmp($last_email, $leads[$i]->RESPACADEMAIL) != 0) {
                $dados[] = [
                    'NOME' => $leads[$i]->RESPACAD,
                    'EMAIL' => $leads[$i]->RESPACADEMAIL,
                    'FIN_NOME' => $leads[$i]->RESPFIN,
                    'FIN_EMAIL'  => $leads[$i]->RESPFINEMAIL,
                    'ANO_VIGENTE' => date('Y')
                ];
                $last_email = $leads[$i]->RESPACADEMAIL;
                $aux = 1;
            }

            if (strcmp($last_email, $leads[$i]->RESPACADEMAIL) == 0) {
                $turma = strlen($leads[$i]->TURMA)-1;
                $dados[$last_i] += [
                    'ALUNO_' . $aux . '_RA' => $leads[$i]->RA,
                    'ALUNO_' . $aux . '_NOME' => $leads[$i]->NOME_ALUNO,
                    'ALUNO_' . $aux . '_EMAIL' => $leads[$i]->EMAIL_ALUNO,
                    'ALUNO_' . $aux . '_TURMA' => $leads[$i]->TURMA[$turma],
                    'ALUNO_' . $aux . '_ANO' => $leads[$i]->ANO,
                    'ALUNO_' . $aux . '_TURNO' => strstr($leads[$i]->TURMA,'TC') ? 'COMPLEMENTAR' : $leads[$i]->TURNO_ALUNO
                ];
                $aux++;
            }
            //dd($dados);
            //$last_email = $leads[$i]->RESPACADEMAIL;
        }
        //dd($dados);

        $export+= $dados;
        //dd($export);
        $export = new Collection($export);
        return $export;
    }
}
